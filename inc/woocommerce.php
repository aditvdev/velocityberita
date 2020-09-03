<?php
/**
 * Add WooCommerce support
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'justg_woocommerce_support' );
if ( ! function_exists( 'justg_woocommerce_support' ) ) {
	/**
	 * Declares WooCommerce theme support.
	 */
	function justg_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		// Add Product Gallery support.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add Bootstrap classes to form fields.
		add_filter( 'woocommerce_form_field_args', 'justg_wc_form_field_args', 10, 3 );
	}
}

// First unhook the WooCommerce content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Then hook in your own functions to display the wrappers your theme requires.
add_action( 'woocommerce_before_main_content', 'justg_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'justg_woocommerce_wrapper_end', 10 );

if ( ! function_exists( 'justg_woocommerce_wrapper_start' ) ) {
	/**
	 * Display the theme specific start of the page wrapper.
	 */
	function justg_woocommerce_wrapper_start() {
		$container = get_theme_mod( 'justg_container_type' );
		echo '<div class="wrapper" id="woocommerce-wrapper">';
		echo '<div class="' . esc_attr( $container ) . '" id="content" tabindex="-1">';
		// echo '<div class="row">';
		// get_template_part( 'global-templates/left-sidebar-check' );
		echo '<main class="site-main" id="main">';
	}
}

if ( ! function_exists( 'justg_woocommerce_wrapper_end' ) ) {
	/**
	 * Display the theme specific end of the page wrapper.
	 */
	function justg_woocommerce_wrapper_end() {
		echo '</main><!-- #main -->';
		// get_template_part( 'global-templates/right-sidebar-check' );
		// echo '</div><!-- .row -->';
		echo '</div><!-- Container end -->';
		echo '</div><!-- Wrapper end -->';
	}
}

if ( ! function_exists( 'justg_wc_form_field_args' ) ) {
	/**
	 * Filter hook function monkey patching form classes
	 * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
	 *
	 * @param string $args Form attributes.
	 * @param string $key Not in use.
	 * @param null   $value Not in use.
	 *
	 * @return mixed
	 */
	function justg_wc_form_field_args( $args, $key, $value = null ) {
		// Start field type switch case.
		switch ( $args['type'] ) {
			// Targets all select input type elements, except the country and state select input types.
			case 'select':
				/*
				 * Add a class to the field's html element wrapper - woocommerce
				 * input types (fields) are often wrapped within a <p></p> tag.
				 */
				$args['class'][] = 'form-group';
				// Add a class to the form input itself.
				$args['input_class'] = array( 'form-control' );
				// Add custom data attributes to the form input itself.
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			/*
			 * By default WooCommerce will populate a select with the country names - $args
			 * defined for this specific input type targets only the country select element.
			 */
			case 'country':
				$args['class'][] = 'form-group single-country';
				break;
			/*
			 * By default WooCommerce will populate a select with state names - $args defined
			 * for this specific input type targets only the country select element.
			 */
			case 'state':
				$args['class'][] = 'form-group';
				$args['custom_attributes'] = array(
					'data-plugin'      => 'select2',
					'data-allow-clear' => 'true',
					'aria-hidden'      => 'true',
				);
				break;
			case 'password':
			case 'text':
			case 'email':
			case 'tel':
			case 'number':
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
			case 'textarea':
				$args['input_class'] = array( 'form-control' );
				break;
			case 'checkbox':
				// Add a class to the form input's <label> tag.
				$args['label_class'] = array( 'custom-control custom-checkbox' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			case 'radio':
				$args['label_class'] = array( 'custom-control custom-radio' );
				$args['input_class'] = array( 'custom-control-input' );
				break;
			default:
				$args['class'][]     = 'form-group';
				$args['input_class'] = array( 'form-control' );
				break;
		} // End of switch ( $args ).
		return $args;
	}
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
	/**
	 * Check if reviews are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_reviews_enabled() {
		return 'yes' === get_option( 'woocommerce_enable_reviews' );
	}

	/**
	 * Check if reviews ratings are enabled.
	 *
	 * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
	 *
	 * @return bool
	 */
	function wc_review_ratings_enabled() {
		return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
	}
}

if ( ! function_exists( 'justg_woocommerce_breadcrumbs' ) ) {

	add_filter( 'woocommerce_breadcrumb_defaults', 'justg_woocommerce_breadcrumbs' );
	function justg_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' &#47; ',
				'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'justg' ),
			);
	}
}

if ( ! function_exists( 'justg_append_cart_icon' ) && class_exists( 'WooCommerce' ) ) {
	// Add cart in menu 
	add_filter( 'wp_nav_menu_items', 'justg_append_cart_icon', 10, 2 );
	function justg_append_cart_icon( $items, $args ) {
		$cart_item_count = is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0';

		$cart_count_span = '<span class="counter" id="cart-count">'.$cart_item_count.'</span>';

		$cart_link = '<li class="cart menu-item menu-item-type-post_type menu-item-object-page menu-item-57 nav-item">';
		$cart_link .= '<a class="nav-link" href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '"><i class="fa fa-shopping-bag"></i>'.$cart_count_span.'</a>';
		$cart_link .= '</li>';

		// Add the cart link to the end of the menu.
		$items = $items . $cart_link;
		
		return $items;
	}
}

if ( ! function_exists( 'justg_refresh_cart_count' ) && class_exists( 'WooCommerce' ) ) {
	// Add refresh cart count
	add_filter( 'woocommerce_add_to_cart_fragments', 'justg_refresh_cart_count', 50, 1 );
	function justg_refresh_cart_count( $fragments ){
		$cart_item_count = is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0';
		$fragments['#cart-count'] = '<span class="counter" id="cart-count">'.$cart_item_count.'</span>';
		return $fragments;
	}
}

if ( ! function_exists( 'justg_override_checkout_fields' ) && class_exists( 'WooCommerce' ) ) {
	//Unset checkout fields
	add_filter( 'woocommerce_checkout_fields' , 'justg_override_checkout_fields' );
	function justg_override_checkout_fields( $fields ) {
		unset($fields['billing']['billing_company']);
		return $fields;
	}
}

/**
 * Change the checkout city field to a dropdown field.
 */
function justg_city_dropdown( $fields ) {

	// Helpers to define the $url path
    //$protocol = is_ssl() ? 'https' : 'http';
	$directory = trailingslashit( get_template_directory_uri() );
	
	// Get the contents of the JSON file 
	$getJsonCity = file_get_contents("{$directory}woocommerce/data/city.json");
	// Convert to array 
	$arrayCity = json_decode($getJsonCity, true);

	$cities = array();
	foreach($arrayCity as $city){
		$cities[$city['city_id']] = $city['city_name'];
	}

	$city_args = wp_parse_args( array(
		'type' => 'select',
		'options' => array_combine( $cities, $cities ),
	), $fields['shipping']['shipping_city'] );

	$fields['shipping']['shipping_city'] = $city_args;
	$fields['billing']['billing_city'] = $city_args;

	return $fields;

}
add_filter( 'woocommerce_checkout_fields', 'justg_city_dropdown' );