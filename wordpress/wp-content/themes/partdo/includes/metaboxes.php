<?php

/*************************************************
## partdo Metabox
*************************************************/

if ( ! function_exists( 'rwmb_meta' ) ) {
  function rwmb_meta( $key, $args = '', $post_id = null ) {
   return false;
  }
 }

add_filter( 'rwmb_meta_boxes', 'partdo_register_page_meta_boxes' );

function partdo_register_page_meta_boxes( $meta_boxes ) {
	
$prefix = 'klb_';
$meta_boxes = array();

/* ----------------------------------------------------- */
// Blog Post Slides Metabox
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-gallery',
	'title'		=> esc_html__('Blog Post Image Slides','partdo'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> esc_html__('Blog Post Slider Images','partdo'),
			'desc'	=> esc_html__('Upload unlimited images for a slideshow - or only one to display a single image.','partdo'),
			'id'	=> $prefix . 'blogitemslides',
			'type'	=> 'image_advanced',
		)
		
	)
);

/* ----------------------------------------------------- */
// Blog Audio Post Settings
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'klb-blogmeta-audio',
	'title' => esc_html('Audio Settings','partdo'),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> esc_html('Audio Code','partdo'),
			'id'		=> $prefix . 'blogaudiourl',
			'desc'		=> esc_html__('Enter your Audio URL(Oembed) or Embed Code.','partdo'),
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> '',
			'sanitize_callback' => 'none'
		),
	)
);



/* ----------------------------------------------------- */
// Blog Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-video',
	'title'		=> esc_html__('Blog Video Settings','partdo'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> esc_html__('Video Type','partdo'),
			'id'		=> $prefix . 'blog_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> esc_html__('Youtube','partdo'),
				'vimeo'			=> esc_html__('Vimeo','partdo'),
				'own'			=> esc_html__('Own Embed Code','partdo'),
			),
			'multiple'	=> false,
			'std'		=> array( 'no' ),
			'sanitize_callback' => 'none'
		),
		array(
			'name'	=> partdo_sanitize_data(__('Embed Code<br />(Audio Embed Code is possible, too)','partdo')),
			'id'	=> $prefix . 'blog_video_embed',
			'desc'	=> partdo_sanitize_data(__('Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong>','partdo')),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

return $meta_boxes;
}
