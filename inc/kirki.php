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

/**
 * Create our panels and sections.
 *
 * For this example we'll be creating 2 panels (1 for default WordPress controls and another for our custom controls)
 * and then a separate section for each control type.
 */
function kirki_demo_panels_sections( $wp_customize ) {
	/**
	 * Add panels
	 */

	$wp_customize->add_panel( 'global_controls', array(
		'priority'    => 10,
		'title'       => __( 'Pengaturan Global', 'justg' ),
		'description' => __( '', 'justg' ),
	) );

	/**
	 * Add sections
	 */
	$wp_customize->add_section( 'global_section', array(
		'title'       => __( 'Icon ', 'justg' ),
		'priority'    => 10,
		'panel'       => 'global_controls',
		'description' => __( 'Pengaturan Umum Website', 'justg' ),
	) );

}
add_action( 'customize_register', 'kirki_demo_panels_sections' );

function justg_demo_controls( $controls ) {
	$controls[] = array(
		'type'        => 'image',
		'setting'     => 'favicon',
		'label'       => __( 'Favicon', 'justg' ),
		'description' => __( 'Ikon di navbar browser', 'justg' ),
		'help'        => __( '', 'justg' ),
		'section'     => 'global_section',
		'default'     => '',
		'priority'    => 10,
		// 'output'      => array(
		// 	array(
		// 		'element'  => 'link',
		// 		'property' => 'href',
		// 	),
		// ),
    );
    
	$controls[] = array(
		'type'        => 'slider',
		'setting'     => 'container',
		'label'       => __( 'Lebar Container', 'kirki' ),
		'description' => __( 'Lebar umum website', 'kirki' ),
		'help'        => __( '', 'kirki' ),
		'section'     => 'global_section',
		'default'     => 1170,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 0,
			'max'  => 2000,
			'step' => 1
        ),
		'output'      => array(
			array(
				'element'  => '.container',
				'property' => 'max-width',
				'units'    => ' !important'
			),
		),
	);
	return $controls;

}
add_filter( 'kirki/controls', 'justg_demo_controls' );