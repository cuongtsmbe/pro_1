<article id="post-<?php the_ID(); ?>" <?php post_class('klb-article single-post'); ?>>
	<div class="entry-header"> 
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>
	<div class="entry-footer">
		<div class="entry-meta">
			<div class="meta-item">
				<span><?php esc_html_e( 'Date', 'partdo' ); ?></span>
				<a href="<?php the_permalink(); ?>"> <?php echo get_the_date(); ?></a>
			</div>
			<?php if(has_category()){ ?>
				<div class="meta-item">
					<span><?php esc_html_e( 'Category', 'partdo' ); ?></span>
					<div class="entry-category">
						<?php the_category(', '); ?>
					</div><!-- entry-category -->
				</div>
			<?php } ?>

			<?php the_tags( '<div class="meta-item entry-tags"><span>' . esc_html__( 'Tags', 'partdo' ).'</span>', ', ', ' </div>'); ?>
		
			<?php if ( is_sticky()) {
				printf( '<div class="meta-item sticky-post"><i class="klbth-icon-star-empty"></i> %s</div>', esc_html__('Featured', 'partdo' ) );
			} ?>
		</div>
	</div>
	
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
	<?php  
	$att=get_post_thumbnail_id();
	$image_src = wp_get_attachment_image_src( $att, 'full' );
	$image_src = $image_src[0]; 
	?>
		<div class="entry-media"> 
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>"></a>
		</div>
	<?php } ?>
	<div class="entry-content">
		<div class="klb-post">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'partdo' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
		</div>
	</div><!-- entry-content -->
	
</article><!-- post -->

