<?php
/**
 * Theme customizer
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function mjlah_head(){   
    $link_setting   = get_theme_mod( 'link_setting' );
    $link_color     = isset($link_setting['link']) ? $link_setting['link'] : '#333';
    $hover_color    = isset($link_setting['hover']) ? $link_setting['hover'] : '#000';
    $active_color   = isset($link_setting['active']) ? $link_setting['active'] : '#333';
    
    $link_footer    = get_theme_mod( 'link_footer' );
    $link_color_f   = isset($link_footer['link']) ? $link_footer['link'] : '#fff';
    $hover_color_f  = isset($link_footer['hover']) ? $link_footer['hover'] : '#f5f5f5';
    $active_color_f = isset($link_footer['active']) ? $link_footer['active'] : '#fff';
    
    ?>
    <style>
    a, a:link, a:visited {
        color: <?php echo $link_color; ?>;
    }
    a:hover {
        color: <?php echo $hover_color; ?>;
    }
    a:active {
        color: <?php echo $active_color; ?>;
    }
    #wrapper-footer a, #wrapper-footer a:link, #wrapper-footer a:visited {
        color: <?php echo $link_color_f; ?>;
    }
    #wrapper-footer a:hover {
        color: <?php echo $hover_color_f; ?>;
    }
    #wrapper-footer a:active {
        color: <?php echo $active_color_f; ?>;
    }
    .btn-primary {
        background-color: <?php echo $link_color; ?>;
        border-color: <?php echo $link_color; ?>;
    }
    .btn-primary:hover {
        background-color: <?php echo $hover_color; ?>;
        border-color: <?php echo $hover_color; ?>;
    }
    .btn-primary:active {
        background-color: <?php echo $active_color; ?>;
        border-color: <?php echo $active_color; ?>;
    }
    </style>
    <?php
}
add_action( 'wp_head', 'mjlah_head' );