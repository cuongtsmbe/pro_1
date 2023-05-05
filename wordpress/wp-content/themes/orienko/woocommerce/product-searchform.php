<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 7.6.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$real_id = orienko_make_id();
global $orienko_opt;
?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<?php if(!empty($orienko_opt['enable_ajaxsearch'])){ ?>
	<div class="orienko-autocomplete-search-wrap">
	<?php } ?>
	<input type="search" autocomplete="off" id="woocommerce-product-search-field-<?php echo esc_attr($real_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'orienko' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'orienko' ); ?>" />
	<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'orienko' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
	<?php if(!empty($orienko_opt['enable_ajaxsearch'])){ ?>
	<div class="orienko-autocomplete-search-results"></div>
	<div class="orienko-autocomplete-search-loading"><img src="<?php echo get_template_directory_uri() . '/images/small-loading.gif'; ?>" alt="Loading"/></div>
	</div>
	<?php } ?>
</form>
