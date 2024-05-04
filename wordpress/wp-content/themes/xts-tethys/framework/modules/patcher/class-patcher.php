<?php
/**
 * The main patcher class.
 *
 * @package XTS
 */

namespace XTS\Modules;

use XTS\Framework\Module;
use XTS\Modules\Patcher\Patch;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

/**
 * The main patcher class.
 */
class Patcher extends Module {
	/**
	 * Register hooks.
	 */
	public function init() {
		$this->include_files();

		add_action( 'wp_ajax_xts_patch_action', array( $this, 'patch_process' ) );
	}

	/**
	 * Include files.
	 */
	public function include_files() {
		require_once XTS_THEME_DIR . '/framework/modules/patcher/class-client.php';
		require_once XTS_THEME_DIR . '/framework/modules/patcher/class-patch.php';
	}

	/**
	 * Patch process.
	 */
	public function patch_process() {
		check_ajax_referer( 'patcher_nonce', 'security' );

		if ( empty( $_GET['id'] ) ) {
			wp_send_json(
				array(
					'message' => esc_html__( 'Empty path ID, please, try again.', 'xts-theme' ),
					'status'  => 'error',
				)
			);
		}

		$patch_id          = sanitize_text_field( $_GET['id'] ); //phpcs:ignore
		$patches_installed = get_option( 'xts_successfully_installed_patches' );
		$theme_version     = XTS_VERSION;

		if ( isset( $patches_installed[ $theme_version ][ $patch_id ] ) ) {
			wp_send_json(
				array(
					'message' => esc_html__( 'The patch is already applied.', 'xts-theme' ),
					'status'  => 'success',
				)
			);
		}

		new Patch( $patch_id );
	}
}
