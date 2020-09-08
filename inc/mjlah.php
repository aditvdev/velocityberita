<?php
/**
 * Theme customizer
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
* Add function for counter viewer in single
*/
function mjlah_viewer_post() {
    //if single or page
    if (is_single() || is_page()):
        $key        = 'post_views_count';

        $post_id    = get_the_ID();
        $count      = (int) get_post_meta( $post_id, $key, true );    
        $count++;  

        update_post_meta( $post_id, $key, $count );
    endif;
}
add_action('wp_head', 'mjlah_viewer_post');
///function get viewer
function mjlah_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    $count = $count > 0 ? $count : 0 ;
    return $count;
}
///set column to dashboard
function mjlah_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function mjlah_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo mjlah_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'mjlah_posts_column_views' );
add_action( 'manage_posts_custom_column', 'mjlah_posts_custom_column_views' );
add_filter( 'manage_page_posts_columns', 'mjlah_posts_column_views' );
add_action( 'manage_page_posts_custom_column', 'mjlah_posts_custom_column_views' );