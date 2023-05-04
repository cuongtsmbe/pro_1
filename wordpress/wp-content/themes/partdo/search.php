<?php
/**
 * search.php
 * @package WordPress
 * @subpackage Partdo
 * @since Partdo 1.0
 * 
 */
 ?>

<?php get_header(); ?>

<div class="klb-blog container page-container">

		<?php if( get_theme_mod( 'partdo_blog_layout' ) == 'left-sidebar') { ?>
		
			<h2 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'partdo' ), get_search_query() ); ?></h2>
			
			<div class="row content-wrapper sidebar-left">
				<div id="sidebar" class="col col-12 col-lg-3 sidebar-column sticky blog-sidebar">
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'blog-sidebar' ); ?>
					<?php } ?>
				</div>
				<div class="col col-12 col-md-9 col-lg-9 primary-column">
					<div class="blog-posts">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php get_template_part( 'post-format/pagination' ); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } elseif( get_theme_mod( 'partdo_blog_layout' ) == 'full-width') { ?>
			<div class="row content-wrapper">
				<div class="col col-12 col-lg-10 offset-lg-1 primary-column">
				
					<h2 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'partdo' ), get_search_query() ); ?></h2>
				
					<div class="blog-posts">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

						<?php endwhile; ?>
					
							<?php get_template_part( 'post-format/pagination' ); ?>
							
						<?php else : ?>

							<h2><?php esc_html_e('No Posts Found', 'partdo') ?></h2>

						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
			
				<h2 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'partdo' ), get_search_query() ); ?></h2>
			
				<div class="row content-wrapper sidebar-right">
					<div class="col col-12 col-lg-9 primary-column">
						<div class="blog-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php get_template_part( 'post-format/pagination' ); ?>
								
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
				<div class="row content-wrapper">
					<div class="col col-12 col-lg-10 offset-lg-1 primary-column">

						<h2 class="search-title"><?php printf( esc_html__( 'Search Results for: %s', 'partdo' ), get_search_query() ); ?></h2>
					
						<div class="blog-posts">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php  get_template_part( 'post-format/content', get_post_format() ); ?>

							<?php endwhile; ?>
						
								<?php get_template_part( 'post-format/pagination' ); ?>
								
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