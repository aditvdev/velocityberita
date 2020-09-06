<?php
/**
 * Template Hook
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Header
 *
 * @see justg_header_open()
 * @see justg_header_logo()
 * @see justg_header_menu()
 * @see justg_header_cart()
 * @see justg_header_close()
 */
add_action( 'justg_header', 'justg_header_open', 20 );
add_action( 'justg_header', 'justg_header_logo', 40 );
add_action( 'justg_header', 'justg_header_menu', 40 );
add_action( 'justg_header', 'justg_header_cart', 60 );
add_action( 'justg_header', 'justg_header_close', 70 );
