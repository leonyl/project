<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blitztheme
 */

?>

	<!-- </div> --><!-- #content -->
<!-- 
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php //echo esc_url( __( 'https://wordpress.org/', 'blitztheme' ) ); ?>"><?php //printf( esc_html__( 'Proudly powered by %s', 'blitztheme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php //printf( esc_html__( 'Theme: %1$s by %2$s.', 'blitztheme' ), 'blitztheme', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
		</div><! .site-info 
	</footer>  #colophon -->
<!-- </div> --><!-- #page -->

	<div class="container">
		<div class="row">
			<div class="col-md-12 footer-menu-wrap"> 
				<nav class="navbar navbar-default footer-menu">
				 <?php
	                    wp_nav_menu( array(
	                        'menu'              => 'footer Menu',
	                        'theme_location'    => 'primary',
	                        'depth'             => 2,
	                        'container_id'      => 'navbar',
	                        'menu_class'        => 'nav navbar-nav ',
	                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                        'walker'            => new wp_bootstrap_navwalker())
	                    );
	                ?> 
					                
		        </nav>
		        <p class="copy-right">&copy Copyright 2015 Gdh corp., All Rights Reserved</p>
			</div>
			<!-- <div class="col-md-3 copy-right">
				
			</div> -->
		</div>
	</div>
	
<?php wp_footer(); ?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/browser-detection.js"></script>	
	
		<script type="text/javascript">
			
			(function($){
				$('.search-field').removeAttr('placeholder');
			})(jQuery);
				
				
			
		</script>

</body>
</html>
