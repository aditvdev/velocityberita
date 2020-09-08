<?php
/**
 * Theme customizer
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function justg_head(){
    $favicon = get_theme_mod( 'favicon_url', '' );
    echo "<link rel='shortcut icon' href='$favicon' sizes='32x32' type='image/x-icon'>";
   
    $link_setting = get_theme_mod( 'link_setting' );
    $link_color   = isset($link_setting['link']) ? $link_setting['link'] : '#333';
    $hover_color  = isset($link_setting['hover']) ? $link_setting['hover'] : '#000';
    $active_color = isset($link_setting['active']) ? $link_setting['active'] : '#333';
    $dark_color   = isset($link_setting['dark']) ? $link_setting['dark'] : '#000';
    $light_color  = isset($link_setting['light']) ? $link_setting['light'] : '#ccc';
    ?>
    <style>
    :root {
      --dark: <?php echo $dark_color; ?>;
      --light: <?php echo $light_color; ?>;
      --link-color : <?php echo $link_color; ?>;
      --hover-color : <?php echo $hover_color; ?>;
      --active-color : <?php echo $active_color; ?>;
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
    .bg-primary {
        background-color: var(--dark);
    }
    .btn-primary {
        background-color: var(--dark);
        border-color: var(--dark);
        color: var(--light);
    }
    .btn-primary:hover {
        background-color: var(--hover-color );
        border-color: var(--hover-color );
    }
    .btn-primary:active {
        background-color: var(--active-color );
        border-color: var(--active-color );
    }
    a.cart-contents {
        color: var(--dark);
    }
    .site-header-cart .widget_shopping_cart a {
        color: var(--light);
    }
    .site-header-cart .widget_shopping_cart, 
    .site-header-cart .product_list_widget li .quantity {
        color: var(--light);
    }
    .site-header-cart .widget_shopping_cart {
        background-color: var(--dark);
        padding: 20px
    }
    .site-header-cart .cart-contents {
        padding: 5px 20px;
        border: 1px solid var(--dark);
    }
    .woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total {
        margin-top:10px;
        border-top : 1px solid var(--light);
    }

    </style>
    <?php
}
add_action( 'wp_head', 'justg_head' );