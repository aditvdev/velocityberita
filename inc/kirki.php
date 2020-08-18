<?php
/**
 * justg functions kirki
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function justg_justg_configuration() {
    return array( 'url_path'     => get_stylesheet_directory_uri() . '/inc/kirki/' );
}

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( 'panel_id', array(
    'priority'    => 10,
    'title'       => esc_html__( 'My Panel', 'kirki' ),
    'description' => esc_html__( 'My panel description', 'kirki' ),
) );

Kirki::add_section( 'section_id', array(
    'title'          => esc_html__( 'My Section', 'kirki' ),
    'description'    => esc_html__( 'My section description.', 'kirki' ),
    'panel'          => 'panel_id',
    'priority'       => 160,
) );