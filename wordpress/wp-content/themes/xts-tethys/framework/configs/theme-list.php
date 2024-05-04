<?php
/**
 * Theme list
 *
 * @version 1.0
 * @package xts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return apply_filters(
	'xts_theme_list',
	array(
		'tethys' => array(
			'name'        => 'Tethys',
			'slug'        => 'tethys',
			'version'     => '1.3.1',
			'woocommerce' => true,
			'categories'  => 'ecommerce,multipurpose',
		),
		
	)
);