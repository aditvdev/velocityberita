<?php
/**
 * Theme customizer
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function mjlah_head(){
    $favicon = get_site_icon_url();
    echo "<link rel='shortcut icon' href='$favicon' sizes='32x32' type='image/x-icon'>";
   
    $link_setting = get_theme_mod( 'link_setting' );
    $link_color   = isset($link_setting['link']) ? $link_setting['link'] : '#333';
    $hover_color  = isset($link_setting['hover']) ? $link_setting['hover'] : '#000';
    $active_color = isset($link_setting['active']) ? $link_setting['active'] : '#333';
    
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