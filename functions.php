<?php
/**
 * justg functions and definitions
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$justg_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/customizer.php',                      // Customizer.
	'/welcome.php',                      	// Welcome page.
	'/deprecated.php',                      // Load deprecated functions.
	'/shortcode.php',						// load shortcode functions.
	'/builder-part.php',                    // Load kirki.
	'/kirki/kirki.php',                     // Load kirki.
	'/kirki.php',							// Setup Kirki.
	'/aq_resizer.php',						// load aq_resizer functions.
);

foreach ( $justg_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}
