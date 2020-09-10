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
        <header class="py-2 bg-header">
            <div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
                <div class=" container mx-auto d-flex align-items-center">
        <?php
    }
}

if( ! function_exists( 'justg_header_logo' ) ) {
    /**
     * Display header logo
     * 
     */
    function justg_header_logo() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        if(!empty($logo[0])) {
            $title = '<img src="'.esc_url($logo[0]).'">';
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
	 */
	function justg_header_cart() {
		if ( justg_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
            <div id="site-header-cart" class="site-header-cart position-relative">
                <?php justg_cart_link(); ?>
                <div class="dropdown-cart pt-3">
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </div>
            </div>
            <?php
		}
	}
}

if ( ! function_exists( 'justg_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 */
	function justg_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		justg_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		ob_start();
		justg_handheld_footer_bar_cart_link();
		$fragments['a.footer-cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'justg_cart_link' ) ) {
	/**
	 * Cart Link
	 */
	function justg_cart_link() {
		if ( ! justg_woo_cart_available() ) {
			return;
        }
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'justg' ); ?>">
                <?php 
                // echo wp_kses_post( WC()->cart->get_cart_subtotal() ); 
                ?> 
                
                <span class="count">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                    <?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'justg' ), WC()->cart->get_cart_contents_count() ) ); ?>
                </span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'justg_handheld_footer_bar_cart_link' ) ) {
	/**
	 * The cart callback function for the handheld footer bar
	 */
	function justg_handheld_footer_bar_cart_link() {
		if ( ! justg_woo_cart_available() ) {
			return;
		}
		?>
			<a class="footer-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'justg' ); ?>">
				<span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'justg_widget_shopping_cart_button_view_cart') ) {
    /**
     * Replace View cart button in shoping cart header
     */
    function justg_widget_shopping_cart_button_view_cart() {
        echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn btn-sm btn-dark text-white">' . esc_html__( 'View cart', 'justg' ) . '</a>';
    }
}

if( ! function_exists( 'justg_widget_shopping_cart_proceed_to_checkout' )){
    /**
     * Replace Checkout button in shoping cart header
     */
    function justg_widget_shopping_cart_proceed_to_checkout() {
        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn btn-sm btn-dark text-white">' . esc_html__( 'Checkout', 'justg' ) . '</a>';
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