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

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo '<div class="widget-'.$idwidget.' posts-widget-'.$instance['layout'].'">';

            if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

            // This is where you run the code and display the output
            //The Query args
            $query_args                         = array();
            $query_args['post_type']            = 'post';
            $query_args['posts_per_page']       = $instance['jumlah'];
            $query_args['cat']                  = $instance['kategori'];
            $query_args['order']                = $instance['order'];

            ///urutkan berdasarkan view
            if ($instance['orderby']=="view") {                
                $query_args['orderby']          = 'meta_value';
                $query_args['meta_key']         = 'post_views_count';
            }

            // The Query
            $the_query = new WP_Query( $query_args );
            
            // The Loop
            $i = 1;
            if ( $the_query->have_posts() ) {
                echo '<div class="list-posts">';
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                        $this->layoutpost($instance['layout'],$instance,$i);
                    $i++;
                }
                echo '</div>';
            } else {
                // no posts found
            }
            /* Restore original Post Data */
            wp_reset_postdata();

        echo '</div>';
        
        //Style for widget
        if($instance['layout']=='layout1'):
        ?>
        <style>
            .widget-<?php echo $idwidget;?> .thumb-post a {
                width: <?php echo $instance['lebar_img'];?>px;
            }
            .widget-<?php echo $idwidget;?> .thumb-post img {
                height: <?php echo $instance['tinggi_img'];?>px;
                object-fit: cover;
            }
        </style>
        <?php
        endif;

        echo $args['after_widget'];
    }

    //widget Layout Post
    public function layoutpost( $layout='layout1',$instance,$i=null) {

        $kutipan    = $instance['kutipan']?$instance['kutipan']:'';
        $lebar_img  = $instance['lebar_img']?$instance['lebar_img']:70;
        $tinggi_img = $instance['tinggi_img']?$instance['tinggi_img']:70;        
        $viewers    = $instance['viewers']?$instance['viewers']:'tidak';

        $thumbnail  = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');
        
        echo '<div class="list-post list-post-'.$i.'">';        
        echo generated_schema(get_the_ID());
        
            //Layout 1
            if($layout=='layout1'):
                ?>            
                <div class="d-flex border-bottom pb-2 mb-2">
                    <div class="thumb-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="d-inline-block mr-2">
                        <img src="<?php echo $thumbnail;?>" class="img-fluid w-100"/>
                        </a>                            
                    </div>
                    <div class="content-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                        <small class="d-block text-muted">
                            <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php if($viewers == 'ya'): ?>
                            <span class="view-post"> / <?php echo get_post_view(); ?> views</span>
                            <?php endif; ?>
                        </small>
                        <?php if($kutipan != 0): ?>
                            <div class="exceprt-post"><?php echo getexcerpt($kutipan,get_the_ID()); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php

            //Layout 2    
            elseif($layout=='layout2'):
                ?>            
                <div class="border-bottom pb-2 mb-2">
                    <div class="thumb-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="d-block">
                        <?php echo get_the_post_thumbnail( get_the_ID(),'medium', array( 'class' => 'w-100 img-fluid' ) );?>
                        </a>                            
                    </div>
                    <div class="content-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                        <small class="d-block text-muted">
                            <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php if($viewers == 'ya'): ?>
                            <span class="view-post"> / <?php echo get_post_view(); ?> views</span>
                            <?php endif; ?>
                        </small>
                        <?php if($kutipan != 0): ?>
                            <div class="exceprt-post"><?php echo getexcerpt($kutipan,get_the_ID()); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
            //Endif layout    
            endif;
        
        echo '</div>';
    }

    // Widget Backend 
    public function form( $instance ) {
        //widget data
        $title          = isset( $instance[ 'title' ])?$instance[ 'title' ]:'New Post';
        $layout         = isset( $instance[ 'layout' ])?$instance[ 'layout' ]:'';
        $kategori       = isset( $instance[ 'kategori' ])?$instance[ 'kategori' ]:'';
        $jumlah         = isset( $instance[ 'jumlah' ])?$instance[ 'jumlah' ]:'5';
        $lebar_img      = isset( $instance[ 'lebar_img' ])?$instance[ 'lebar_img' ]:'70';
        $tinggi_img     = isset( $instance[ 'tinggi_img' ])?$instance[ 'tinggi_img' ]:'70';
        $kutipan        = isset( $instance[ 'kutipan' ])?$instance[ 'kutipan' ]:'50';
        $orderby        = isset( $instance[ 'orderby' ])?$instance[ 'orderby' ]:'';
        $order          = isset( $instance[ 'order' ])?$instance[ 'order' ]:'';
        $viewers        = isset( $instance[ 'viewers' ])?$instance[ 'viewers' ]:'';

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Judul:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'layout' ); ?>">Layout:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'layout' ); ?>">
                <option value="layout1"<?php selected($orderby, "layout1"); ?>>Layout 1</option>
                <option value="layout2"<?php selected($orderby, "layout2"); ?>>Layout 2</option>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'kategori' ); ?>">Urutkan Berdasarkan:</label>        
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

                    <option value="<?php echo $category->term_id;?>" <?php selected($kategori, $category->term_id); ?>><?php echo $category->name;?></option>

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
                        <option value="<?php echo $term->term_id;?>" <?php selected($kategori, $term->term_id); ?>>&nbsp;&nbsp;&nbsp;<?php echo $term->name;?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
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
        <p>
            <label for="<?php echo $this->get_field_id( 'kutipan' ); ?>">Panjang Kutipan:</label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'kutipan' ); ?>" name="<?php echo $this->get_field_name( 'kutipan' ); ?>" type="number" value="<?php echo esc_attr( $kutipan ); ?>" />
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
        <p>
            <label for="<?php echo $this->get_field_id( 'viewers' ); ?>">Tampilkan views:</label>        
            <select class="widefat" name="<?php echo $this->get_field_name( 'viewers' ); ?>">
                <option value="tidak"<?php selected($order, "tidak"); ?>>Tidak</option>
                <option value="ya"<?php selected($order, "ya"); ?>>Ya</option>
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
        $instance['jumlah']         = ( ! empty( $new_instance['jumlah'] ) ) ? strip_tags( $new_instance['jumlah'] ) : '';
        $instance['lebar_img']      = ( ! empty( $new_instance['lebar_img'] ) ) ? strip_tags( $new_instance['lebar_img'] ) : '';
        $instance['tinggi_img']     = ( ! empty( $new_instance['tinggi_img'] ) ) ? strip_tags( $new_instance['tinggi_img'] ) : '';
        $instance['kutipan']        = ( ! empty( $new_instance['kutipan'] ) ) ? strip_tags( $new_instance['kutipan'] ) : '';
        $instance['orderby']        = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
        $instance['order']          = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
        $instance['viewers']        = ( ! empty( $new_instance['viewers'] ) ) ? strip_tags( $new_instance['viewers'] ) : '';
        return $instance;
    }

// Class mjlah_posts_widget ends here
} 
     
     
// Register and load the widget
function mjlah_posts_load_widget() {
    register_widget( 'mjlah_posts_widget' );
}
add_action( 'widgets_init', 'mjlah_posts_load_widget' );