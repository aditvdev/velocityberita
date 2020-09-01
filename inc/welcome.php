<?php
/**
 * justg functions and definitions
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', 'justg_welcome' );
function justg_welcome() {
    if( isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url('admin.php?page=justg-welcome') );
        exit;
    }
}

/**
 * Register welcome page.
 */
function justg_register_welcome_page(){
    add_submenu_page(
        'themes.php',
        __( 'Selamat Datang Di Theme Just G', 'justg' ),
        'Justg Option',
        'manage_options',
        'justg-welcome',
        'welcome_page',
        6
    ); 
}
add_action( 'admin_menu', 'justg_register_welcome_page' );
 
/**
 * Display welcome page.
 */
function welcome_page(){
    esc_html_e( 'Admin Page Test', 'justg' );  
}