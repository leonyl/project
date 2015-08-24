<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blitztheme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header> 
		<div class="container">
			<div class="row" >
				<div class="col-md-2"><a href="<?php echo home_url(); ?>"><h1 class="site-name"><?php bloginfo( 'name' ); ?></h1></a></div>


                <div class="nav-wrapper col-md-4 nopadding" >
	                <div class="row">
	                	<div class="padding40"></div>
	                </div>
	                <div class="row">
	                	<nav class="navbar navbar-default nav-top">
				       
				           <div class="navbar-header"> 
				              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".rd-primary-toggle-menu" aria-expanded="false" aria-controls="navbar">
				                <span class="sr-only">Toggle navigation</span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				              </button> 
				          <!--     <a class="navbar-brand" href="<?php //bloginfo('url'); ?>" >
				                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				              </a> -->
				            </div>
				              <?php
				                    wp_nav_menu( array(
				                        'menu'              => 'primary',
				                        'theme_location'    => 'primary',
				                        'depth'             => 2,
				                        'container'         => 'div',
				                        'container_class'   => 'navbar-collapse collapse rd-primary-toggle-menu',
				                        'container_id'      => 'navbar',
				                        'menu_class'        => 'nav navbar-nav',
				                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                        'walker'            => new wp_bootstrap_navwalker())
				                    );
				                ?> 
				                
				        </nav>
	                </div>
			        
		        </div>
		        <div class="nav-wrapper2 col-md-6" >
		        	<div class="row">
		        		<div class="col-md-12 social-wraper">
		        		<?php get_search_form(); ?>
		        			<ul id="navlist" class=" pull-right">
		        				<li class="social twitter"><a href=""></a></li>
		        				<li class="social in"><a href=""></a></li>
		        				<li class="social gplus"><a href=""></a></li>
		        				<li class="social ytube"><a href=""></a></li>
		        			</ul>
		        			
		        			
		        		</div>
		        	</div>

		        	<div class="row">

		        		<div class="col-md-12 second-nav-wrap">
		        			<nav class="navbar navbar-default secondary">
			       
					           <div class="navbar-header"> 
					              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".rd-primary-toggle-menu" aria-expanded="false" aria-controls="navbar">
					                <span class="sr-only">Toggle navigation</span>
					                <span class="icon-bar"></span>
					                <span class="icon-bar"></span>
					                <span class="icon-bar"></span>
					              </button> 
					            </div>
					              <?php
					                    wp_nav_menu( array(
					                        'menu'              => 'secondary',
					                        'theme_location'    => 'primary',
					                        'depth'             => 2,
					                        'container'         => 'div',
					                        'container_class'   => 'navbar-collapse collapse rd-primary-toggle-menu',
					                        'container_id'      => 'navbar',
					                        'menu_class'        => 'nav navbar-nav',
					                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					                        'walker'            => new wp_bootstrap_navwalker())
					                    );
					                ?> 
					                
					        </nav>
		        		</div>
		        		
		        	</div>
			        
		        </div>
			</div> 
		</div>  
        
    </header>

	   
<!-- 


	<div id="content" class="site-content">
 -->