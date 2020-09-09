<?php
/**
 * Theme customizer
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function justg_head(){
    $link_setting = get_theme_mod( 'link_setting' );
    $link_color   = isset($link_setting['link']) ? $link_setting['link'] : '#333';
    $hover_color  = isset($link_setting['hover']) ? $link_setting['hover'] : '#000';
    $active_color = isset($link_setting['active']) ? $link_setting['active'] : '#333';
    $primary_color   = isset($link_setting['primary']) ? $link_setting['primary'] : '#000';
    ?>
    <style type="text/css">
    :root {
      --link-color : <?php echo $link_color; ?>;
      --hover-color : <?php echo $hover_color; ?>;
      --active-color : <?php echo $active_color; ?>;
      --primary : <?php echo $primary_color; ?>;;
    }
    a, a:link, a:visited {
        color: var(--link-color);
    }
    a:hover {
        color: var(--hover-color );
    }
    a:active {
        color: var(--active-color );
    }
    a.cart-contents {
        color: var(--primary);
    }
    .site-header-cart .widget_shopping_cart a {
        color: var(--light);
    }
    .site-header-cart .widget_shopping_cart, 
    .site-header-cart .product_list_widget li .quantity {
        color: var(--light);
    }
    .site-header-cart .widget_shopping_cart {
        background-color: var(--primary);
        padding: 20px
    }
    .site-header-cart .cart-contents {
        padding: 5px 20px;
        border: 1px solid var(--primary);
    }
    .woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
        margin-top:10px;
        border-top : 1px solid var(--light);
    }

    </style>
    <?php
}
add_action( 'wp_head', 'justg_head' );