<?php
/**
 * Standard content post
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
 
	$orienko_opt = get_option( 'orienko_opt' );
	$blogcolumn = (isset($orienko_opt['blogcolumn'])) ? $orienko_opt['blogcolumn'] : '';
	if(is_single()) $blogcolumn = '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($blogcolumn); ?>>
	<div class="post-wrapper">
		<?php if ( ! post_password_required() && ! is_attachment() ) : ?>
		<?php 
			if ( is_single() ) { ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
						<span class="date-post">
							<span class="month"><?php echo get_the_date( esc_html__('M', 'orienko'), get_the_ID() ); ?></span>
							<span class="day"><?php echo get_the_date( esc_html__('d', 'orienko'), get_the_ID() ); ?></span>
						</span>
					</div>
				<?php } ?>
			<?php }
		?>
		<?php if ( !is_single() ) { ?>
			<?php if ( has_post_thumbnail() ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('orienko-post-thumb'); ?></a>
				
			</div>
			<?php } ?>
		<?php } ?>
		<?php endif; ?>
		
		<div class="post-info<?php if ( !has_post_thumbnail() ) { echo ' no-thumbnail';} ?>">
			<header class="entry-header">
				
					<?php if ( !is_single() ) { ?>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h3>
					<?php }else{ ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
				
				<ul class="post-entry-data">
					<li class="post-date"><?php echo get_the_date( get_option( 'date_format' ), get_the_ID() ) ?></li>
					<li class="post-comments"><?php echo sprintf(esc_html__('%d Comment(s)', 'orienko'), get_comments_number( $post->ID )) ?></li>
				</ul>
			</header>

			
			<?php if (is_search()) { // Only display Excerpts for Search ?> 
			<div class="entry-summary">
				<?php the_excerpt(); ?> 
				<div class="clearfix"></div>
			</div><!-- .entry-summary -->
			<?php } else { ?> 
				<?php if ( is_single() ) : ?>
					<div class="entry-content">
						<?php the_content( esc_html__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'orienko' ) ); ?>
						<?php wp_link_pages(array(
							'before' => '<div class="page-links"><span>' . esc_html__('Pages:', 'orienko') . '</span><ul class="pagination">',
							'after'  => '</ul></div>',
							'separator' => ''
						)); ?>
					</div>
				<?php else : ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>
			<?php } //endif; ?> 

			<?php if ( is_single() ){ ?>
			<footer class="entry-meta">
				<?php if ('post' == get_post_type()) { // Hide category and tag text for pages on Search ?> 
				<div class="entry-meta-category-tag">
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list(esc_html__(', ', 'orienko'));
						if (!empty($categories_list)) {
					?> 
					<span class="cat-links">
						<?php echo orienko_bootstrap_categories_list($categories_list); ?> 
					</span>
					<?php } // End if categories ?> 

					<?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list('', esc_html__(', ', 'orienko'));
						if ($tags_list) {
					?> 
					<span class="tags-links">
						<?php echo orienko_bootstrap_tags_list($tags_list); ?> 
					</span>
					<?php } // End if $tags_list ?> 
				</div>
				<?php } // End if 'post' == get_post_type() ?> 
				
				<div class="entry-counter">
					<div class="post-comments" title="<?php echo esc_html__('Total Comments', 'orienko') ?>" data-toggle="tooltip"><i class="fa fa-comments"></i><?php echo get_comments_number( get_the_ID() ) ?></div>
					<div class="post-views" title="<?php echo esc_html__('Total Views', 'orienko') ?>" data-toggle="tooltip">
						<i class="fa fa-eye"></i><?php echo orienko_get_post_viewed(get_the_ID()); ?>
					</div>
					<?php do_action( 'lionthemes_like_button' , get_the_ID()); ?>
				</div>
				
				<?php if( function_exists('orienko_blog_sharing') && is_single()) { ?>
					<div class="social-sharing"><?php orienko_blog_sharing(); ?></div>
				<?php } ?>
			</footer>
			<?php } ?>
		</div>
	</div>
</article><!-- #post-## -->