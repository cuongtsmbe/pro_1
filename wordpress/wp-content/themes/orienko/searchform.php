<?php
/**
 * Template for displaying search form in orienko theme
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
 
?>
<form method="get" class="search-form form" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="form-search-input" class="sr-only"><?php _ex('Search for', 'label', 'orienko'); ?></label>
	<div class="input-group">
		<input type="search" id="form-search-input" class="form-control" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'orienko'); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label', 'orienko'); ?>">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default"><?php esc_html_e('Search', 'orienko'); ?></button>
		</span>
	</div>
</form>