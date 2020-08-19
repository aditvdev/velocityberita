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


// Add our config to differentiate from other themes/plugins 
// that may use Kirki at the same time.
Kirki::add_config( 'justg_config', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

// Add Section.
Kirki::add_section( 'global_section', array(
	'title'    => __( 'Pengaturan Umum', 'justg' ),
	'priority' => 10,
) );

// Add Field (setting & control defined as one).
Kirki::add_field( 'justg_config', [
	'type'        => 'image',
	'settings'    => 'favicon_url',
	'label'       => esc_html__( 'Favicon', 'justg' ),
	'description' => esc_html__( '', 'justg' ),
	'section'     => 'global_section',
	'default'     => '',
] );

Kirki::add_field( 'justg_config', [
	'type'        => 'slider',
	'settings'    => 'lebar_website',
	'label'       => esc_html__( 'Lebar Website', 'justg' ),
	'section'     => 'global_section',
	'default'     => 1140,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 600,
		'max'  => 2300,
		'step' => 1,
	],
    'output' => array(
        array(
            'element'  => '.container',
            'property' => 'max-width',
            'units'    => 'px',
        ),
    ),
] );

Kirki::add_field( 'justg_config', [
	'type'        => 'typography',
	'settings'    => 'typography_setting',
	'label'       => esc_html__( 'Typography Umum', 'justg' ),
	'section'     => 'global_section',
	'default'     => [
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '14px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#333333',
		'text-transform' => 'none',
		'text-align'     => 'left',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'body',
		],
	],
] );

Kirki::add_field( 'justg_config', [
    'type'        => 'multicolor',
    'settings'    => 'link_setting',
    'label'       => esc_html__( 'Warna Link', 'justg' ),
    'section'     => 'global_section',
    'priority'    => 10,
    'choices'     => [
        'link'    => esc_html__( 'Color', 'justg' ),
        'hover'   => esc_html__( 'Hover', 'justg' ),
        'active'  => esc_html__( 'Active', 'justg' ),
    ],
    'default'     => [
        'link'    => '#1e73be',
        'hover'   => '#333333',
        'active'  => '#1e73be',
    ],
] );

Kirki::add_field( 'justg_config', [
	'type'        => 'background',
	'settings'    => 'background_setting',
	'label'       => esc_html__( 'Background Website', 'justg' ),
	'description' => esc_html__( '', 'justg' ),
	'section'     => 'global_section',
	'default'     => [
		'background-color'      => 'rgba(255,255,255,1)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'body',
		],
	],
] );
