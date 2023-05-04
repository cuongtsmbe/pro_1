<?php

/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package WordPress
* @subpackage Partdo
* @since 1.0.0
*/

	remove_action( 'partdo_main_header', 'partdo_main_header_function', 10 );
	remove_action( 'partdo_main_footer', 'partdo_main_footer_function', 10 );

    get_header();

    while ( have_posts() ) : the_post();
        the_content();
    endwhile;

    get_footer();
?>
