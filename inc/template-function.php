<?php
/**
 * Template Function
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if( ! function_exists( 'justg_header_open' )) {
    /**
     * Display header open
     * 
     */
    function justg_header_open() {
        ?>
        <header class="py-2 bg-white">
            <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
                <div class=" container mx-auto d-flex">
        <?php
    }
}

if( ! function_exists( 'justg_header_logo' ) ) {
    /**
     * Display header logo
     * 
     */
    function justg_header_logo() {
        $logo = get_theme_mod( 'logo', '' );
        if($logo) {
            $title = '<img src="'.$logo.'">';
        } else {
            $title = get_bloginfo( 'name' );
        }
        
        echo '<a class="navbar-brand" rel="home" href="'.get_site_url().'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" itemprop="url">'.$title.'</a>';
    }
}
if( ! function_exists( 'justg_header_menu') ) {
    /**
     * Display Header Menu
     * 
     */
    function justg_header_menu(){
        ?>
        <nav class="navbar navbar-expand-md ml-auto">
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'justg'); ?>">
                <i class="fa fa-align-right" aria-hidden="true"></i>
            </button>

            <!-- The WordPress Menu goes here -->
            <?php wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id'    => 'navbarNavDropdown',
                    'menu_class'      => 'navbar-nav ml-auto',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 2,
                    'walker'          => new justg_WP_Bootstrap_Navwalker(),
                )
            ); ?>
        </nav><!-- .site-navigation -->
        <?php
    }
}

if ( ! function_exists( 'justg_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 */
	function justg_header_cart() {
		if ( justg_is_woocommerce_activated() ) {
            $cart_item_count = is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0';

            $cart_count_span = '<span class="counter" id="cart-count">'.$cart_item_count.'</span>';
    
            echo '<li class="cart menu-item menu-item-type-post_type menu-item-object-page menu-item-57 nav-item">';
                echo '<a class="nav-link" href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '"><i class="fa fa-shopping-bag"></i>'.$cart_count_span.'</a>';
            echo '</li>';
			the_widget( 'WC_Widget_Cart', 'title=' );
		}
	}
}

if( ! function_exists( 'justg_header_close' )) {
    /**
     * Display header close
     * 
     */
    function justg_header_close() {
        echo '</div></div></header>';
    }
}