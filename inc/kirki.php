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


// Add field to global section
Kirki::add_section( 'global_section', array(
	'title'    => __( 'Pengaturan Umum', 'mjlah' ),
	'priority' => 10,
) );
Kirki::add_field( 'mjlah_config', [
	'type'        => 'slider',
	'settings'    => 'lebar_website',
	'label'       => esc_html__( 'Lebar Website', 'mjlah' ),
	'section'     => 'global_section',
	'default'     => 1100,
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
		'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif',
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
    'settings'    => 'colortheme_setting',
    'label'       => esc_html__( 'Warna Utama Website', 'mjlah' ),
    'section'     => 'global_section',
    'priority'    => 10,
    'choices'     => [
		'primary' => esc_html__( 'Primary', 'mjlah' ),
		'light'	  => esc_html__( 'Light', 'mjlah' ),
    ],
    'default'     => [
        'primary' => '#000000',
        'light'   => '#333333',
	],	
	'output'    => [
		[
			'choice'    => 'primary',
			'element'   => ':root',
			'property'  => '--primary',
		],
		[
			'choice'    => 'light',
			'element'   => ':root',
			'property'  => '--light',
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
	'output'    => [
		[
			'choice'    => 'link',
			'element'   => 'a',
			'property'  => 'color',
		],
		[
			'choice'    => 'hover',
			'element'   => 'a:hover',
			'property'  => 'color',
		],
		[
			'choice'    => 'active',
			'element'   => 'a:active',
			'property'  => 'color',
		],
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
Kirki::add_section( 'header_section', array(
	'title'    => __( 'Pengaturan Header', 'mjlah' ),
	'priority' => 10,
) );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'select',
	'settings'    => 'lebar_container_header',
	'label'       => esc_html__( 'Lebar Konten Header', 'mjlah' ),
	'section'     => 'header_section',
	'default'     => 'fixed',
	'description' => esc_html__( 'lebar header', 'mjlah' ),
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'fixed' => esc_html__( 'Fixed', 'mjlah' ),
		'full' 	=> esc_html__( 'Full', 'mjlah' ),
	],
] ); 

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_block_header',
	'label'       => esc_html__( 'Background Block header', 'mjlah' ),
	'description' => esc_html__( 'Atur background header', 'mjlah' ),
	'section'     => 'header_section',
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
			'element' => array('.block-header'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'typography',
	'settings'    => 'menu_setting',
	'label'       => esc_html__( 'Menu Typography', 'mjlah' ),
	'section'     => 'header_section',
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '16px',
		'line-height'    => '1.5',
		'letter-spacing' => '0',
		'color'          => '#ffffff',
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

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_menu_header',
	'label'       => esc_html__( 'Background Menu header', 'mjlah' ),
	'description' => esc_html__( 'Atur background Menu header', 'mjlah' ),
	'section'     => 'header_section',
	'default'     => [
		'background-color'      => '#333333',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => array('.header-menu'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
    'type'        => 'multicolor',
    'settings'    => 'link_menu_header_setting',
    'label'       => esc_html__( 'Warna Link Menu Header', 'mjlah' ),
    'section'     => 'header_section',
    'priority'    => 10,
    'choices'     => [
        'link'    => esc_html__( 'Color', 'mjlah' ),
        'hover'   => esc_html__( 'Hover', 'mjlah' ),
        'active'  => esc_html__( 'Active', 'mjlah' ),
    ],
    'default'     => [
        'link'    => '#ffffff',
        'hover'   => '#f00000',
        'active'  => '#ffffff',
	],	
	'output'    => [
		[
			'choice'    => 'link',
			'element'   => '.header-menu a',
			'property'  => 'color',
		],
		[
			'choice'    => 'hover',
			'element'   => '.header-menu a:hover',
			'property'  => 'color',
		],
		[
			'choice'    => 'active',
			'element'   => '.header-menu a:active',
			'property'  => 'color',
		],
	],
] );

// Add field to block section
Kirki::add_section( 'block_section', array(
	'title'    => __( 'Pengaturan Block', 'mjlah' ),
	'priority' => 10,
) );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_main_block_setting',
	'label'       => esc_html__( 'Background Main Block', 'mjlah' ),
	'description' => esc_html__( 'Atur background Block Konten Utama', 'mjlah' ),
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
			'element' => array('#wrapper-main > .wrapper > #content'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'dimensions',
	'settings'    => 'dimensions_main_block_setting',
	'label'       => esc_html__( 'Margin Main Block', 'mjlah' ),
	'description' => esc_html__( 'Atur Jarak Block Utama', 'mjlah' ),
	'section'     => 'block_section',
	'default'     => [
		'padding-top'    => '1em',
		'padding-bottom' => '1em',
		'padding-left'   => '1em',
		'padding-right'  => '1em',

		'margin-top'    => '0em',
		'margin-bottom' => '0em',
		// 'margin-left'   => '0em',
		// 'margin-right'  => '0em',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => array('#wrapper-main > .wrapper > #content'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_block_setting',
	'label'       => esc_html__( 'Background Block', 'mjlah' ),
	'description' => esc_html__( 'Atur background (widget, heading, article, dll)', 'mjlah' ),
	'section'     => 'block_section',
	'default'     => [
		'background-color'      => 'rgba(255,255,255,0)',
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
	'label'       => esc_html__( 'Margin Block', 'mjlah' ),
	'description' => esc_html__( 'Atur Jarak Block (widget, heading, article, dll)', 'mjlah' ),
	'section'     => 'block_section',
	'default'     => [
		'padding-top'    => '0em',
		'padding-bottom' => '0em',
		'padding-left'   => '0em',
		'padding-right'  => '0em',

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

//add field to footer section
Kirki::add_section( 'footer_section', array(
	'title'    => __( 'Pengaturan Footer', 'mjlah' ),
	'priority' => 10,
) );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'select',
	'settings'    => 'reg_widget_footer',
	'label'       => esc_html__( 'Widget Footer', 'mjlah' ),
	'section'     => 'footer_section',
	'default'     => '3',
	'description' => esc_html__( 'Jumlah Widget footer', 'mjlah' ),
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'1' => esc_html__( '1', 'mjlah' ),
		'2' => esc_html__( '2', 'mjlah' ),
		'3' => esc_html__( '3', 'mjlah' ),
		'4' => esc_html__( '4', 'mjlah' ),
		'5' => esc_html__( '5', 'mjlah' ),
	],
] ); 

Kirki::add_field( 'mjlah_config', [
	'type'        => 'select',
	'settings'    => 'lebar_container_footer',
	'label'       => esc_html__( 'Lebar Konten Footer', 'mjlah' ),
	'section'     => 'footer_section',
	'default'     => 'fixed',
	'description' => esc_html__( 'lebar footer', 'mjlah' ),
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'fixed' => esc_html__( 'Fixed', 'mjlah' ),
		'full' 	=> esc_html__( 'Full', 'mjlah' ),
	],
] ); 

Kirki::add_field( 'mjlah_config', [
	'type'        => 'background',
	'settings'    => 'background_block_footer',
	'label'       => esc_html__( 'Background Block Footer', 'mjlah' ),
	'description' => esc_html__( 'Atur background Footer', 'mjlah' ),
	'section'     => 'footer_section',
	'default'     => [
		'background-color'      => '#333333',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => array('.block-footer'),
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'typography',
	'settings'    => 'typography_footer',
	'label'       => esc_html__( 'Typography Footer', 'mjlah' ),
	'section'     => 'footer_section',
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '',
		'line-height'    => '',
		'letter-spacing' => '',
		'color'          => '#ffffff',
		'text-transform' => 'none',
		'text-align'     => 'left',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '#wrapper-footer',
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
    'type'        => 'multicolor',
    'settings'    => 'link_footer',
    'label'       => esc_html__( 'Warna Link footer', 'mjlah' ),
    'section'     => 'footer_section',
    'priority'    => 10,
    'choices'     => [
        'link'    => esc_html__( 'Color', 'mjlah' ),
        'hover'   => esc_html__( 'Hover', 'mjlah' ),
        'active'  => esc_html__( 'Active', 'mjlah' ),
    ],
    'default'     => [
        'link'    => '#ffffff',
        'hover'   => '#f5f5f5',
        'active'  => '#ffffff',
	],
	'output'    => [
		[
			'choice'    => 'link',
			'element'   => '#wrapper-footer a',
			'property'  => 'color',
		],
		[
			'choice'    => 'hover',
			'element'   => '#wrapper-footer a:hover',
			'property'  => 'color',
		],
		[
			'choice'    => 'active',
			'element'   => '#wrapper-footer a:active',
			'property'  => 'color',
		],
	],
] );

Kirki::add_field( 'mjlah_config', [
	'type'        => 'select',
	'settings'    => 'scrolltotop_footer',
	'label'       => esc_html__( 'Tampilkan Tombol Scroll ke atas', 'mjlah' ),
	'section'     => 'footer_section',
	'default'     => 'ya',
	'description' => esc_html__( 'Tampilkan Tombol Scroll ke atas', 'mjlah' ),
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'ya' 		=> esc_html__( 'Ya', 'mjlah' ),
		'tidak' 	=> esc_html__( 'Tidak', 'mjlah' ),
	],
] );