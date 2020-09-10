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
function get_post_view() {
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
        echo get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'mjlah_posts_column_views' );
add_action( 'manage_posts_custom_column', 'mjlah_posts_custom_column_views' );
add_filter( 'manage_page_posts_columns', 'mjlah_posts_column_views' );
add_action( 'manage_page_posts_custom_column', 'mjlah_posts_custom_column_views' );

/*
*get content of post
*/
function getexcerpt($count=150,$idpost=null){
    global $post;
    $html = $idpost=null?get_the_content():get_post_field('post_content',$idpost);
    $html = strip_tags($html);
    $html = substr($html, 0, $count);
    $html = substr($html, 0, strripos($html, " "));
    $html = ''.$html.'...';
    return $html;
}

/*
*generated schema content of post
*/
function generated_schema($idpost=null){
    $schema = '';
    if($idpost!=null):
        $author_id  = get_post_field( 'post_author', $idpost );

        $schema     .= '<meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage" itemid="'.get_permalink($idpost).'" content="'.get_the_title($idpost).'">';
        $schema     .= '<meta itemprop="datePublished" content="'.get_the_date( 'Y-m-d', $idpost ).'">';
        $schema     .= '<meta itemprop="dateModified" content="'.get_the_modified_date('Y-m-d', $idpost).'">';
        $schema     .= '<div itemprop="publisher" itemscope="" itemtype="https://schema.org/Organization">';
            $schema .= '<meta itemprop="name" content="'.get_bloginfo( 'name' ).'">';
        $schema     .= '</div>';
        $schema     .= '<div itemscope="" itemprop="author" itemtype="https://schema.org/Person">';
            $schema .= '<meta itemprop="url" content="'.get_the_author_meta( 'url', $author_id ).'">';
            $schema .= '<meta itemprop="name" content="'.get_the_author_meta( 'nicename', $author_id ).'">';
        $schema     .= '</div>';
        $schema     .= '<div itemscope="" itemprop="image" itemtype="https://schema.org/ImageObject">';
            $schema .= '<meta itemprop="url" content="'.get_the_post_thumbnail_url($idpost,'full').'">';
            $schema .= '<meta itemprop="width" content="790">';
            $schema .= '<meta itemprop="height" content="536">';
        $schema     .= '</div>';
        $schema     .= '<div itemprop="interactionStatistic" itemscope="" itemtype="https://schema.org/InteractionCounter">';
            $schema .= '<meta itemprop="interactionType" content="https://schema.org/CommentAction">';
            $schema .= '<meta itemprop="userInteractionCount" content="'.wp_count_comments($idpost)->total_comments.'">';
        $schema     .= '</div>';
    endif;
    return $schema;
}