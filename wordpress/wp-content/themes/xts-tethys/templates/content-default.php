<?php
/**
 * Template used to display post content.
 *
 * @package xts
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( xts_get_post_classes() ); ?>>

	<?php if ( xts_has_post_thumbnail( get_the_ID() ) ) : ?>
		<div class="xts-post-thumb">
			<?php xts_post_thumbnail( array( 'video', 'audio', 'gallery' ) ); ?>

			<?php xts_meta_post_labels(); ?>

			<div class="xts-post-hover xts-fill">
				<?php if ( xts_get_loop_prop( 'blog_post_read_more' ) ) : ?>
					<div class="xts-post-read-more-hover">
						<span>
							<?php echo esc_html__( 'Continue reading', 'xts-theme' ); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
			<a class="xts-post-link xts-fill" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"></a>
		</div>
	<?php endif; ?>

	<div class="xts-post-content">
		<?php if ( xts_get_loop_prop( 'blog_post_meta' ) || xts_get_loop_prop( 'blog_post_categories' ) ) : ?>
			<div class="xts-post-header">
				<?php if ( xts_get_loop_prop( 'blog_post_categories' ) ) : ?>
					<?php xts_meta_post_categories(); ?>
				<?php endif; ?>

				<?php if ( xts_get_loop_prop( 'blog_post_meta' ) ) : ?>
					<div class="xts-post-actions xts-top">

						<?php if ( xts_is_social_buttons_enable( 'share' ) ) : ?>
							<div class="xts-post-share xts-action-btn xts-style-icon xts-tooltip-init">
								<a></a>

								<div class="xts-tooltip tooltip bs-tooltip-top">
									<div class="arrow"></div>
									<div class="tooltip-inner">
										<?php xts_social_buttons_template( xts_get_default_value( 'post_social_buttons_args' ) ); ?>
									</div>
								</div>
							</div>
						<?php endif; ?>

						<?php xts_meta_post_comments(); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( xts_get_loop_prop( 'blog_post_title' ) ) : ?>
			<h3 class="xts-post-title xts-entities-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h3>
		<?php endif; ?>

		<?php if ( is_search() && xts_get_loop_prop( 'blog_post_text' ) ) : ?>
			<div class="xts-post-desc">
				<?php the_excerpt(); ?>
			</div>
		<?php elseif ( xts_get_loop_prop( 'blog_post_text' ) ) : ?>
			<div class="xts-post-desc xts-reset-all-last">
				<?php xts_the_content(); ?>
			</div>
		<?php endif; ?>

		<?php if ( xts_get_loop_prop( 'blog_post_meta' ) ) : ?>
			<div class="xts-post-meta">
				<?php xts_meta_post_author(); ?>
				<?php xts_meta_post_date(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>
