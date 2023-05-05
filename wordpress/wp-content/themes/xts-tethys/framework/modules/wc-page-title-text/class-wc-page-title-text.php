<?php
/**
 * Product sale countdown
 *
 * @package xts
 */

namespace XTS\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'No direct script access allowed' );
}

use XTS\Framework\Module;
use XTS\Framework\Options;

/**
 * Login to see product price
 *
 * @since 1.0.0
 */
class WC_Page_Title_Text extends Module {
	/**
	 * Basic initialization class required for Module class.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		add_action( 'init', array( $this, 'hooks' ) );
		add_action( 'init', array( $this, 'add_options' ) );
	}

	/**
	 * Hooks
	 *
	 * @since 1.0.0
	 */
	public function hooks() {
		add_action( 'xts_after_shop_page_title', array( $this, 'print_text' ), 10 );
	}

	/**
	 * Get shop text
	 *
	 * @since 1.0.0
	 */
	public function print_text() {
		if ( ! xts_is_shop_archive() || ! xts_get_opt( 'page_title_shop_text' ) ) {
			return;
		}

		?>
			<div class="xts-page-title-text xts-reset-all-last">
				<?php echo do_shortcode( xts_get_opt( 'page_title_shop_text' ) ); ?>
			</div>
		<?php
	}

	/**
	 * Add options
	 *
	 * @since 1.0.0
	 */
	public function add_options() {
		Options::add_field(
			array(
				'id'          => 'page_title_shop_text',
				'type'        => 'textarea',
				'wysiwyg'     => true,
				'name'        => esc_html__( 'Promo text', 'xts-theme' ),
				'description' => esc_html__( 'Write some short text that will be displayed before the categories in the page title.', 'xts-theme' ),
				'section'     => 'product_archive_page_title_section',
				'default'     => '',
				'priority'    => 100,
			)
		);
	}
}
