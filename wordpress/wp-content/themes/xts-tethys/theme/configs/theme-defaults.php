<?php
/**
 * Default values for theme settings dashboard options.
 *
 * @version 1.0
 * @package xts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return apply_filters(
	'xts_theme_default_values_array',
	array(
		'blog_spacing' => '30',
		'page_title_design' => 'centered',
		'page_title_size' => 's',
		'page_title_bg'           => array(
			'color' => '#e8f0f3',
			'url'        => '',
			'id'         => '',
			'repeat'     => '',
			'size'       => '',
			'attachment' => '',
			'position'   => '',
			'position_x' => '',
			'position_y' => '',
			'css_output' => '1',
		),
		'single_post_social_buttons_args'       => array(
			'style'                 => 'bordered',
			'align'                 => 'center',
			'size'                  => 'm',
			'wrapper_extra_classes' => 'xts-single-post-social',
		),
		'meta_post_author_args'                 => array(
			'avatar' => false,
			'label'  => true,
			'name'   => true,
		),
		'tooltip_left_selector'                 => '.xts-prod-design-summary .xts-product-actions > div, .xts-prod-design-btn .xts-product-actions > div, .xts-prod-design-img-btn .xts-product-actions > div, .xts-prod-design-mask .xts-product-actions > div, .xts-prod-design-simple .xts-product-actions > div',
		'hover_product_btn_actions_classes'     => 'xts-style-icon',
		'hover_product_img_btn_actions_classes' => 'xts-style-icon',
		'hover_product_icons_actions_classes'   => 'xts-style-icon',
		'hover_product_summary_actions_classes' => 'xts-style-icon',
		// Theme settings.
		'alt_typography'                        => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => '',
				'font-weight'    => '500',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'line-height'    => '',
				'tablet'         => array(
					'line-height' => '',
				),
				'mobile'         => array(
					'line-height' => '',
				),
			),
		),
		'blog_excerpt_length'                   => '400',
		'content_typography'                    => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => 'Jost',
				'font-weight'    => '400',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'font-size'      => '',
				'tablet'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'mobile'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'line-height'    => '',
				'color'          => '',
			),
		),
		'entities_typography'                   => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => '',
				'font-weight'    => '500',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'line-height'    => '',
				'tablet'         => array(
					'line-height' => '',
				),
				'mobile'         => array(
					'line-height' => '',
				),
				'color'          => '#333333',
				'hover'          => array(
					'color' => '',
				),
			),
		),
		'footer_color_scheme'                   => 'dark',
		'header_typography'                     => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => '',
				'font-weight'    => '500',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'font-size'      => '',
				'tablet'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'mobile'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'line-height'    => '',
				'color'          => '',
				'hover'          => array(
					'color' => '',
				),
				'active'         => array(
					'color' => '',
				),
			),
		),
		'links_color'                           => array(
			'idle'       => '#7cbff0',
			'hover'      => '#6ba5ce',
			'css_output' => '1',
		),
		'primary_color'                         => array(
			'idle'       => '#212121',
			'css_output' => '1',
		),
		'secondary_color'                       => array(
			'idle'       => '#ff5558',
			'css_output' => '1',
		),
		'site_width'                            => '1420',
		'title_typography'                      => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => '',
				'font-weight'    => '500',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'line-height'    => '',
				'tablet'         => array(
					'line-height' => '',
				),
				'mobile'         => array(
					'line-height' => '',
				),
				'color'          => '',
			),
		),
		'widget_title_typography'               => array(
			0 => array(
				'custom'         => '',
				'google'         => '0',
				'font-family'    => '',
				'font-weight'    => '500',
				'font-style'     => '',
				'font-subset'    => '',
				'text-transform' => '',
				'font-size'      => '',
				'tablet'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'mobile'         => array(
					'font-size'   => '',
					'line-height' => '',
				),
				'line-height'    => '',
				'color'          => '',
			),
		),
	)
);
