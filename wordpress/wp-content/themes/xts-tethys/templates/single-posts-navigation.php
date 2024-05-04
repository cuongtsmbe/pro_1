<?php
/**
 * Single posts (blog portfolio) navigations template
 *
 * @package xts
 */

$prev_title        = '';
$next_title        = '';
$order_by          = 'date';
$next_post         = get_next_post();
$prev_post         = get_previous_post();
$is_scpo_installed = xts_is_scpo_installed();

if ( $is_scpo_installed ) {
	$order_by = 'menu_order';
}

if ( ( ! $next_post || ! $prev_post ) && $is_scpo_installed ) {
	add_action( 'pre_get_posts', 'xts_scpo_single_posts_navigation_fix', 5 );
}

if ( ! $next_post ) {
	$next_order = 'ASC';

	if ( $is_scpo_installed ) {
		$next_order = 'DESC';
	}

	$first = get_posts( 'numberposts=1&suppress_filters=0&orderby=' . $order_by . '&order=' . $next_order . '&post_type=' . get_post_type() );

	if ( isset( $first[0] ) && is_object( $first[0] ) ) {
		$next_post = $first[0];
	}
}

if ( ! $prev_post ) {
	$prev_order = 'DESC';

	if ( $is_scpo_installed ) {
		$prev_order = 'ASC';
	}

	$last = get_posts( 'numberposts=1&suppress_filters=0&orderby=' . $order_by . '&order=' . $prev_order . '&post_type=' . get_post_type() );

	if ( isset( $last[0] ) && is_object( $last[0] ) ) {
		$prev_post = $last[0];
	}
}

if ( 'post' === get_post_type() ) {
	$prev_title = esc_html__( 'Previous Post', 'xts-theme' );
	$next_title = esc_html__( 'Next Post', 'xts-theme' );
} elseif ( 'xts-portfolio' === get_post_type() ) {
	$prev_title = esc_html__( 'Previous Project', 'xts-theme' );
	$next_title = esc_html__( 'Next Project', 'xts-theme' );
}

?>

<div class="xts-page-nav row">
	<div class="col-md-6">
		<div class="xts-page-nav-btn xts-prev">
			<?php if ( has_post_thumbnail( $prev_post->ID ) ) : ?>
				<div class="xts-page-nav-image">
					<?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
				</div>
			<?php endif; ?>

			<div class="xts-page-nav-content">
				<div class="xts-page-nav-subtitle">
					<?php echo esc_html( $prev_title ); ?>
				</div>
				<h3 class="xts-page-nav-title xts-entities-title">
					<?php echo get_the_title( $prev_post->ID ); // phpcs:ignore ?>
				</h3>
			</div>

			<a class="xts-page-nav-link xts-fill" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"></a>
		</div>
	</div>

	<div class="col-md-6">
		<div class="xts-page-nav-btn xts-next">
			<div class="xts-page-nav-content">
				<div class="xts-page-nav-subtitle">
					<?php echo esc_html( $next_title ); ?>
				</div>
				<h3 class="xts-page-nav-title xts-entities-title">
					<?php echo get_the_title( $next_post->ID ); // phpcs:ignore ?>
				</h3>
			</div>

			<?php if ( has_post_thumbnail( $next_post->ID ) ) : ?>
				<div class="xts-page-nav-image">
					<?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
				</div>
			<?php endif; ?>

			<a class="xts-page-nav-link xts-fill" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"></a>
		</div>
	</div>
</div>
