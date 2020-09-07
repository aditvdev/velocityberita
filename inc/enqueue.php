<?php
/**
 * justg enqueue scripts
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'justg_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function justg_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'justg-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
		wp_enqueue_style( 'justg-woocomerce-styles', get_template_directory_uri() . '/css/woocommerce.min.css', array(), $css_version );
		wp_enqueue_style( 'justg-custom-styles', get_template_directory_uri() . '/css/custom.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'justg-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		wp_enqueue_script( 'justg-custom-scripts', get_template_directory_uri() . '/js/custom.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // End of if function_exists( 'justg_scripts' ).

add_action( 'wp_enqueue_scripts', 'justg_scripts' );
