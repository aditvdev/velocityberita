<?php
/**
 * Theme basic setup
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function justg_the_footer_content() {
    // if ( ! function_exists( 'justg_the_footer_content' ) ) :
    ?>
    
        <div class="wrapper bg-dark text-white" id="wrapper-footer">
        
        	<div class="container">
        
        		<div class="row">
        
        			<div class="col-md-12">
        
        				<footer class="site-footer" id="colophon">
        
        					<div class="site-info">
        
        						<div class="text-center">© <?php echo date("Y"); ?> <?php echo get_bloginfo('name');?>. All Rights Reserved.</div>
        
        					</div><!-- .site-info -->
        
        				</footer><!-- #colophon -->
        
        			</div><!--col end -->
        
        		</div><!-- row end -->
        
        	</div><!-- container end -->
        
        </div><!-- wrapper end -->
        
    <?php
    // endif;
}
add_action( 'justg_do_footer', 'justg_the_footer_content' );