<?php
/**
 * mjlah functions and definitions
 *
 * @package mjlah
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Creating the widget 
class mjlah_bigposts_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'mjlah_bigposts_widget', 

            // Widget name will appear in UI
            __('Widget Big Posts', 'mjlah'), 

            // Widget description
            array( 'description' => __( 'Tampilkan Big Post widget', 'mjlah' ), ) 
        );
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        $idwidget   = uniqid();
        $title      = apply_filters( 'widget_title', $instance['title'] );

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="widget-'.$idwidget.' posts-widget-'.$instance['layout'].'">';

        if ( ! empty( $title ) ):

            if($instance['kategori']) {
                $title = '<a href="'.get_category_link($instance['kategori']).'">'.$title.'</a>';
                $title .= '<a href="'.get_category_link($instance['kategori']).'feed" class="feed-cat float-right h5 mt-2" target="_blank" title="Technology RSS Feed"><i class="fa fa-rss"></i></a>';
            }             
            echo $args['before_title'] . $title . $args['after_title'];

        endif;
            // This is where you run the code and display the output
            //The Query args
            $query_args                         = array();
            $query_args['post_type']            = 'post';
            $query_args['cat']                  = $instance['kategori'];
            $query_args['order']                = $instance['order'];

            ///urutkan berdasarkan view
            if ($instance['orderby']=="view") {                
                $query_args['orderby']          = 'meta_value';
                $query_args['meta_key']         = 'post_views_count';
            }

            //jumlah post
            if($instance['layout']=="layout1") {
                $query_args['posts_per_page']   = 5;
            }

            // The Query
            $the_query = new WP_Query( $query_args );
            
            // The Loop
            $i = 1;
            if ( $the_query->have_posts() ) {

                echo '<div class="list-posts" data-count="'.$the_query->post_count.'">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                            $this->layoutpost($instance['layout'],$instance,$i,$the_query->post_count);
                        $i++;
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

    //widget Layout Post
    public function layoutpost( $layout='layout1',$instance,$i=null,$count) {

        //Layout 1
        if($layout=='layout1'):

            if($i==1) {
                echo '<div class="row">';
                echo '<div class="col-md-6">';
            }

            if($i==2) {
                echo '</div>';
                echo '<div class="col-md-6">';
            }

            echo '<div class="list-post list-post-'.$i.'">'; 
                echo mjlah_generated_schema(get_the_ID());

                //first loop
                if($i == 1) :
                ?>    

                    <div class="row">
                        <div class="col-12 thumb-post">
                            <?php echo mjlah_thumbnail( get_the_ID(),array(300,200), array( 'class' => 'w-100 img-fluid','class-link' => 'd-block' ) );?>
                        </div>
                        <div class="col-12 content-post">
                            <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                            
                            <small class="d-block text-muted meta-post">
                                <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                                <span class="mx-1 separator">/</span>
                                <span class="view-post"><?php echo mjlah_get_post_view(); ?> views</span>
                            </small>
                            <div class="exceprt-post"><?php echo mjlah_getexcerpt(100,get_the_ID()); ?></div>
                        </div>
                    </div>

                <?php else : ?>

                    <div class="row mb-3">
                        <div class="col-4 pr-0 thumb-post">
                            <?php echo mjlah_thumbnail( get_the_ID(),array(125,70), array( 'class' => 'w-100 img-fluid','class-link' => 'd-block' ) );?>
                        </div>
                        <div class="col-8 content-post">
                            <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                            
                            <small class="d-block text-muted meta-post">
                                <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                                <span class="mx-1 separator">/</span>
                                <span class="view-post"><?php echo mjlah_get_post_view(); ?> views</span>
                            </small>
                        </div>
                    </div> 

                <?php endif; ?>

            <?php
            
            echo '</div>';

            if($i==$count) {
                echo '</div>';
                echo '</div>';
            }

        //Endif layout    
        endif;
    }

    // Widget Backend 
    public function form( $instance ) {
        //widget data
        $title          = isset( $instance[ 'title' ])?$instance[ 'title' ]:'New Post';
        $layout         = isset( $instance[ 'layout' ])?$instance[ 'layout' ]:'';
        $kategori       = isset( $instance[ 'kategori' ])?$instance[ 'kategori' ]:'';
        $orderby        = isset( $instance[ 'orderby' ])?$instance[ 'orderby' ]:'';
        $order          = isset( $instance[ 'order' ])?$instance[ 'order' ]:'';

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Judul:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'layout' ); ?>">Layout:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'layout' ); ?>">
                <option value="layout1"<?php selected($layout, "layout1"); ?>>Layout 1</option>
                <option value="layout2"<?php selected($layout, "layout2"); ?>>Layout 2</option>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'kategori' ); ?>">Kategori:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'kategori' ); ?>">
            <option value="">Semua Kategori</option>
                <?php
                $categories = get_terms( array(
			        'taxonomy'      => 'category',
					'orderby'       => 'name',
					'parent'        => 0,
                    'hide_empty'    => 0,
                    'exclude'       => 1,
				) );
				foreach($categories as $category): ?>

                    <option value="<?php echo $category->term_id;?>" <?php selected($kategori, $category->term_id); ?>><?php echo $category->name;?> (<?php echo $category->count;?>)</option>

                    <?php
                    $taxonomies = array( 
                        'taxonomy' => 'category'
                    );
                    $args = array(
                         'child_of'      => $category->term_id,
                         'hide_empty'    => 0,
                    ); 
                    $terms = get_terms($taxonomies, $args);
                    ?>
                    <?php foreach($terms as $term): ?>
                        <option value="<?php echo $term->term_id;?>" <?php selected($kategori, $term->term_id); ?>>&nbsp;&nbsp;&nbsp;<?php echo $term->name;?> (<?php echo $term->count;?>)</option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Urutkan Berdasarkan:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <option value="date"<?php selected($orderby, "date"); ?>>Tanggal</option>
                <option value="view"<?php selected($orderby, "view"); ?>>Populer</option>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>">Urutan:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'order' ); ?>">
                <option value="DESC"<?php selected($order, "DESC"); ?>>DESC</option>
                <option value="ASC"<?php selected($order, "ASC"); ?>>ASC</option>
            </select>
		</p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['layout']         = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';
        $instance['kategori']       = ( ! empty( $new_instance['kategori'] ) ) ? strip_tags( $new_instance['kategori'] ) : '';
        $instance['orderby']        = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
        $instance['order']          = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
        return $instance;
    }

// Class mjlah_bigposts_widget ends here
} 
     
     
// Register and load the widget
function mjlah_bigposts_load_widget() {
    register_widget( 'mjlah_bigposts_widget' );
}
add_action( 'widgets_init', 'mjlah_bigposts_load_widget' );