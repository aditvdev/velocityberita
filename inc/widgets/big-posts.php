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

            if ( ! empty( $title ) )
            $title = $instance['kategori']?'<a href="'.get_category_link($instance['kategori']).'">'.$title.'</a>':$title;
            echo $args['before_title'] . $title . $args['after_title'];

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

            // The Query
            $the_query = new WP_Query( $query_args );
            
            // The Loop
            $i = 1;
            if ( $the_query->have_posts() ) {
                $class  = ($instance['layout']=='gallery')?'row px-2':'';
                echo '<div class="list-posts '.$class.'">';
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

        echo $args['after_widget'];
    }

    //widget Layout Post
    public function layoutpost( $layout='layout1',$instance,$i=null) {

        $class      = ($layout=='gallery')?'col-md-6 col-12 p-2 pt-0':'';

        echo '<div class="list-post list-post-'.$i.' '.$class.'">';        
        echo mjlah_generated_schema(get_the_ID());

            //Layout 1
            if($layout=='layout1'):
                ?>            
                <div class="d-flex border-bottom pb-2 mb-2">
                    <div class="thumb-post">
                        <?php echo mjlah_thumbnail( get_the_ID(),'thumbnail', array( 'class' => 'w-100 img-fluid','class-link' => 'd-block mr-3' ) );?>
                    </div>
                    <div class="content-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                        <small class="d-block text-muted meta-post">

                            <?php if($viewdate == 'ya'): ?>
                                <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya' && $viewdate == 'ya'): ?>
                                <span class="mx-1 separator">/</span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya'): ?>
                                <span class="view-post"><?php echo mjlah_get_post_view(); ?> views</span>
                            <?php endif; ?>

                        </small>
                        <?php if($kutipan != 0): ?>
                            <div class="exceprt-post"><?php echo mjlah_getexcerpt($kutipan,get_the_ID()); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
            //Layout 2    
            elseif($layout=='layout2'):
                ?>            
                <div class="border-bottom pb-2 mb-2">
                    <div class="thumb-post">
                        <?php echo mjlah_thumbnail( get_the_ID(),'thumbnail', array( 'class' => 'w-100 img-fluid','class-link' => 'd-block' ) );?>                           
                    </div>
                    <div class="content-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                        <small class="d-block text-muted meta-post">

                            <?php if($viewdate == 'ya'): ?>
                                <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya' && $viewdate == 'ya'): ?>
                                <span class="mx-1 separator">/</span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya'): ?>
                                <span class="view-post"><?php echo mjlah_get_post_view(); ?> views</span>
                            <?php endif; ?>

                        </small>
                        <?php if($kutipan != 0): ?>
                            <div class="exceprt-post"><?php echo mjlah_getexcerpt($kutipan,get_the_ID()); ?></div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php
            //Layout gallery    
            elseif($layout=='gallery'): ?>

                <div class="gallery-posts position-relative">
                        <?php echo mjlah_thumbnail( get_the_ID(),array($lebar_img,$tinggi_img), array( 'class' => 'w-100 img-fluid','class-link' => 'd-block' ) );?>
                        <a href="<?php echo get_the_permalink(); ?>" class="mask-post"><span><?php echo get_the_title(); ?></span></a>
                </div>

           <?php
            //Layout list    
            elseif($layout=='list'): ?>

                <div class="d-flex align-items-baseline border-bottom pb-2 mb-2">
                    <i class="fa fa-file-text-o text-muted mr-2" aria-hidden="true"></i>
                    <a href="<?php echo get_the_permalink(); ?>" class="d-inline-block">
                        <?php echo get_the_title(); ?>
                    </a>                            
                </div>

            
            <?php
            //Layout 3    
            elseif($layout=='layout3'):
                ?>            
                <div class="border-bottom pb-2 mb-2">
                    <?php if($i==1):?>
                    <div class="thumb-post"> 
                        <?php echo mjlah_thumbnail( get_the_ID(),'medium', array( 'class' => 'w-100 img-fluid','class-link' => 'd-block' ) );?>                         
                    </div>
                    <?php endif;?>
                    <div class="content-post">
                        <a href="<?php echo get_the_permalink(); ?>" class="title-post font-weight-bold h4 d-block"><?php echo get_the_title(); ?></a>
                        <small class="d-block text-muted meta-post">

                            <?php if($viewdate == 'ya'): ?>
                                <span class="date-post"><?php echo get_the_date('F j, Y'); ?></span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya' && $viewdate == 'ya'): ?>
                                <span class="mx-1 separator">/</span>
                            <?php endif; ?>

                            <?php if($viewers == 'ya'): ?>
                                <span class="view-post"><?php echo mjlah_get_post_view(); ?> views</span>
                            <?php endif; ?>

                        </small>
                        <?php if($kutipan != 0): ?>
                            <div class="exceprt-post"><?php echo mjlah_getexcerpt($kutipan,get_the_ID()); ?></div>
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
        $lebar_img      = isset( $instance[ 'lebar_img' ])?$instance[ 'lebar_img' ]:'70';
        $tinggi_img     = isset( $instance[ 'tinggi_img' ])?$instance[ 'tinggi_img' ]:'70';
        $kutipan        = isset( $instance[ 'kutipan' ])?$instance[ 'kutipan' ]:'50';
        $orderby        = isset( $instance[ 'orderby' ])?$instance[ 'orderby' ]:'';
        $order          = isset( $instance[ 'order' ])?$instance[ 'order' ]:'';
        $viewers        = isset( $instance[ 'viewers' ])?$instance[ 'viewers' ]:'';
        $viewdate       = isset( $instance[ 'viewdate' ])?$instance[ 'viewdate' ]:'ya';

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
                <option value="layout3"<?php selected($layout, "layout3"); ?>>Layout 3</option>
                <option value="gallery"<?php selected($layout, "gallery"); ?>>Gallery</option>
                <option value="list"<?php selected($layout, "list"); ?>>List</option>
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