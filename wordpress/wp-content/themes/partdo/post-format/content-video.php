<article id="post-<?php the_ID(); ?>" <?php post_class('klb-article post'); ?>>
	<figure class="entry-media embed-responsive embed-responsive-16by9">
		<?php  
		if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'vimeo') {  
		  echo '<iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" height="443" allowFullScreen></iframe>';  
		}  
		else if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'youtube') {  
		  echo '<iframe height="450" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" allowfullscreen></iframe>';  
		}  
		else {  
			echo ' '.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).' '; 
		}  
		?>
	</figure>
	<div class="entry-wrapper"> 
		<div class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
			<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'partdo' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
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
	</div>
</article><!-- post -->