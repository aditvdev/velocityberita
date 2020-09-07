<?php
/**
 * Shipping Function
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Define plugin constants.
define( 'JUSTG_FILE', __FILE__ );
define( 'JUSTH_PATH', plugin_dir_path( JUSTG_FILE ) );

// Load the helpers.
require_once JUSTH_PATH . 'includes/helpers.php';

// Register the class auto loader.
if ( function_exists( 'justg_autoload' ) ) {
	spl_autoload_register( 'justg_autoload' );
}

/**
 * Boot the plugin
 */
if ( justg_is_woocommerce_activated() && class_exists( 'justg' ) ) {
	// Initialize the justg class.
	justg::get_instance();
}
