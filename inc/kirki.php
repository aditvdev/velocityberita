<?php
/**
 * mjlah functions kirki
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function mjlah_mjlah_configuration() {
    return array( 'url_path'     => get_stylesheet_directory_uri() . '/inc/kirki/' );
}


// Add our config to differentiate from other themes/plugins 
// that may use Kirki at the same time.
Kirki::add_config( 'mjlah_config', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );

// Add Section.
Kirki::add_section( 'global_section', array(
	'title'    => __( 'Pengaturan Umum', 'mjlah' ),
	'priority' => 10,
) );
Kirki::add_section( 'header_section', array(
	'title'    => __( 'Pengaturan Header', 'mjlah' ),
	'priority' => 10,
) );
Kirki::add_section( 'block_section', array(
	'title'    => __( 'Pengaturan Block', 'mjlah' ),
	'priority' => 10,
) );

// Add field to global section
Kirki::add_field( 'mjlah_config', [
	'type'        => 'image',
	'settings'    => 'favicon_url',
	'label'       => esc_html__( 'Favicon', 'mjlah' ),
	'description' => esc_html__( '', 'mjlah' ),
	'section'     => 'global_section',
	'default'     => '',
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'slider',
	'settings'    => 'lebar_website',
	'label'       => esc_html__( 'Lebar Website', 'mjlah' ),
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

Kirki::add_field( 'mjlah_config', [
	'type'        => 'typography',
	'settings'    => 'typography_setting',
	'label'       => esc_html__( 'Typography Umum', 'mjlah' ),
	'section'     => 'global_section',
	'default'     => [
		'font-family'    => 'Poppins',
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

Kirki::add_field( 'mjlah_config', [
    'type'        => 'multicolor',
    'settings'    => 'link_setting',
    'label'       => esc_html__( 'Warna Link', 'mjlah' ),
    'section'     => 'global_section',
    'priority'    => 10,
    'choices'     => [
        'link'    => esc_html__( 'Color', 'mjlah' ),
        'hover'   => esc_html__( 'Hover', 'mjlah' ),
        'active'  => esc_html__( 'Active', 'mjlah' ),
    ],
    'default'     => [
        'link'    => '#1e73be',
        'hover'   => '#333333',
        'active'  => '#1e73be',
    ],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_setting',
	'label'       => esc_html__( 'Background Website', 'mjlah' ),
	'description' => esc_html__( '', 'mjlah' ),
	'section'     => 'global_section',
	'default'     => [
		'background-color'      => '#F5F5F5',
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

// Add field to header section
Kirki::add_field( 'mjlah_config', [
	'type'        => 'image',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Logo', 'mjlah' ),
	'description' => esc_html__( '', 'mjlah' ),
	'section'     => 'header_section',
	'default'     => '',
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'typography',
	'settings'    => 'menu_setting',
	'label'       => esc_html__( 'Menu Typography', 'mjlah' ),
	'section'     => 'header_section',
	'default'     => [
		'font-family'    => 'Poppins',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#333333',
		'text-transform' => 'uppercase',
		'text-align'     => 'left',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '#main-menu',
		],
	],
] );

// Add field to block section
Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_block_setting',
	'label'       => esc_html__( 'Background Block', 'mjlah' ),
	'description' => esc_html__( 'Atur background (widget, heading, article, dll)', 'mjlah' ),
	'section'     => 'block_section',
	'default'     => [
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => array('.block-customizer'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'dimensions',
	'settings'    => 'dimensions_block_setting',
	'label'       => esc_html__( 'Margin Block', 'kirki' ),
	'description' => esc_html__( 'Atur Jarak Block (widget, heading, article, dll)', 'kirki' ),
	'section'     => 'block_section',
	'default'     => [
		'padding-top'    => '2em',
		'padding-bottom' => '2em',
		'padding-left'   => '2em',
		'padding-right'  => '2em',

		'margin-top'    => '0em',
		'margin-bottom' => '2em',
		'margin-left'   => '0em',
		'margin-right'  => '0em',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => array('.block-customizer'),
		],
	],
] );