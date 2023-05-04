<?php
/**
 * single.php
 * @package WordPress
 * @subpackage Partdo
 * @since Partdo 1.0
 * 
 */
 ?>

<?php get_header(); ?>

<div class="klb-blog-single container page-container">
	
		<?php if( get_theme_mod( 'partdo_blog_layout' ) == 'left-sidebar') { ?>
			<div class="row">
				<div id="sidebar" class="col col-12 col-lg-3 sidebar-column sticky blog-sidebar">
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					<?php } ?>
				</div>
				<div class="col col-12 col-lg-9 primary-column">
					<div class="post-single">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php comments_template(); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } elseif( get_theme_mod( 'partdo_blog_layout' ) == 'full-width') { ?>
			<div class="row">
				<div class="col-12 col-lg-10 primary-column">
					<div class="post-single">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php comments_template(); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
				<div class="row">
					<div class="col col-12 col-lg-9 primary-column">
						<div class="post-single">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php comments_template(); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

							<?php endif; ?>
						</div>
					</div>
					<div id="sidebar" class="col col-12 col-lg-3 sidebar-column sticky blog-sidebar">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="row">
					<div class="col col-12 col-lg-10 offset-lg-1 primary-column">
						<div class="post-single">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/single', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php comments_template(); ?>
								
							<?php else : ?>

								<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } ?>
			
		<?php } ?>
		
</div>

<?php get_footer(); ?>