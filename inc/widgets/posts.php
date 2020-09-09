<?php
/**
 * mjlah functions and definitions
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Creating the widget 
class mjlah_posts_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'mjlah_posts_widget', 

            // Widget name will appear in UI
            __('Widget Posts', 'mjlah'), 

            // Widget description
            array( 'description' => __( 'Tampilkan Post di widget', 'mjlah' ), ) 
        );
    }

    // Creating widget front-end

    public function widget( $args, $instance ) {
        $idwidget   = uniqid();
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $jumlah     = $instance['jumlah'];
        $lebar_img  = $instance['lebar_img']?$instance['lebar_img']:70;
        $tinggi_img = $instance['tinggi_img']?$instance['tinggi_img']:70;

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="widget-'.$idwidget.'">';

            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

            // This is where you run the code and display the output
            //The Query args
            $query_args = array(
                'post_type'      => 'post',
                'posts_per_page' => $jumlah,
            );
            // The Query
            $the_query = new WP_Query( $query_args );
            
            // The Loop
            if ( $the_query->have_posts() ) {
                echo '<div class="list-posts">';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    ?>
                    <div class="list-post">
                        <div class="d-flex border-bottom pb-2 mb-2">
                            <div class="thumb-post">
                                <a href="<?php echo get_the_permalink(); ?>" class="d-inline-block mr-2" style="width: <?php echo $lebar_img; ?>px;">
                                <?php echo get_the_post_thumbnail( get_the_ID(), array( $lebar_img, $tinggi_img), array( 'class' => 'img-fluid' ) );?>
                                </a>                            
                            </div>
                            <div class="content-post">
                                <a href="<?php echo get_the_permalink(); ?>" class="title-post"><?php echo get_the_title(); ?></a>
                                <small class="d-block text-muted date-post"><?php echo get_the_date('F j, Y'); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();

        echo '</div>';
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form( $instance ) {
        //widget data
        $title          = isset( $instance[ 'title' ])?$instance[ 'title' ]:'New Post';
        $jumlah         = isset( $instance[ 'jumlah' ])?$instance[ 'jumlah' ]:'5';
        $lebar_img      = isset( $instance[ 'lebar_img' ])?$instance[ 'lebar_img' ]:'70';
        $tinggi_img     = isset( $instance[ 'tinggi_img' ])?$instance[ 'tinggi_img' ]:'70';
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Judul:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'jumlah' ); ?>">Jumlah:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'jumlah' ); ?>" type="number" value="<?php echo esc_attr( $jumlah ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'lebar_img' ); ?>">Lebar Gambar:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'lebar_img' ); ?>" name="<?php echo $this->get_field_name( 'lebar_img' ); ?>" type="number" value="<?php echo esc_attr( $lebar_img ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'tinggi_img' ); ?>">Tinggi Gambar:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'tinggi_img' ); ?>" name="<?php echo $this->get_field_name( 'tinggi_img' ); ?>" type="number" value="<?php echo esc_attr( $tinggi_img ); ?>" />
        </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['jumlah']         = ( ! empty( $new_instance['jumlah'] ) ) ? strip_tags( $new_instance['jumlah'] ) : '';
        $instance['lebar_img']      = ( ! empty( $new_instance['lebar_img'] ) ) ? strip_tags( $new_instance['lebar_img'] ) : '';
        $instance['tinggi_img']     = ( ! empty( $new_instance['tinggi_img'] ) ) ? strip_tags( $new_instance['tinggi_img'] ) : '';
        return $instance;
    }

// Class mjlah_posts_widget ends here
} 
     
     
// Register and load the widget
function mjlah_posts_load_widget() {
    register_widget( 'mjlah_posts_widget' );
}
add_action( 'widgets_init', 'mjlah_posts_load_widget' );