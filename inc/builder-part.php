<?php
/**
 * Theme basic setup
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function justg_the_header_content() {
	$logo = get_theme_mod( 'logo', '' );
    ?>
        <header class="py-2 bg-white">	
        	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
        	    <div class=" container mx-auto row align-items-center">
        	        <div class="col-5 col-md-3">
					<?php if($logo) {
						$title = '<img src="'.$logo.'">';
					} else {
						$title = bloginfo( 'name' );
					}
					?>
                        <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php echo $title ?></a>
        	        </div>
        	        <div class="col-7 col-md-9">
                		<nav class="navbar navbar-expand-md">
                				<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'justg'); ?>">
									<i class="fa fa-align-right" aria-hidden="true"></i>
                				</button>
                
                				<!-- The WordPress Menu goes here -->
                				<?php wp_nav_menu(
                					array(
                						'theme_location'  => 'primary',
                						'container_class' => 'collapse navbar-collapse',
                						'container_id'    => 'navbarNavDropdown',
                						'menu_class'      => 'navbar-nav ml-auto',
                						'fallback_cb'     => '',
                						'menu_id'         => 'main-menu',
                						'depth'           => 2,
                						'walker'          => new justg_WP_Bootstrap_Navwalker(),
                					)
                				); ?>
                		</nav><!-- .site-navigation -->
        	        </div>
        	    </div>
        
        	</div><!-- #wrapper-navbar end -->
        </header>
    <?php
}
add_action( 'justg_do_header', 'justg_the_header_content' );

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