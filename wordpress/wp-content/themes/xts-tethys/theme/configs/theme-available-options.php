<?php
/**
 * Options for theme settings and elements.
 *
 * @version 1.0
 * @package xts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return apply_filters(
	'xts_theme_available_options_array',
	array(
		'items_gap'                                      => array(
			0  => array(
				'name'  => 0,
				'value' => 0,
			),
			2  => array(
				'name'  => 2,
				'value' => 2,
			),
			10 => array(
				'name'  => 10,
				'value' => 10,
			),
			20 => array(
				'name'  => 20,
				'value' => 20,
			),
			30 => array(
				'name'  => 30,
				'value' => 30,
			),
			40 => array(
				'name'  => 40,
				'value' => 40,
			),
		),

		'product_loop_design'           => array(
			'simple' => array(
				'name'  => esc_html__( 'Simple', 'xts-theme' ),
				'value' => 'simple',
			),
		),

		'product_loop_design_elementor' => array(
			'simple' => esc_html__( 'Simple', 'xts-theme' ),
		),

		'page_title_design'             => array(
			'inline-2' => array(
				'name'  => esc_html__( 'Inline', 'xts-theme' ),
				'value' => 'inline-2',
			),
		),

		'page_title_design_metabox'     => array(
			'inline-2' => array(
				'name'  => esc_html__( 'Inline', 'xts-theme' ),
				'value' => 'inline-2',
			),
		),
	)
);
