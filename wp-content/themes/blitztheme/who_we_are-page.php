<?php
/**
 * Template Name: Who we are
 *
 *
 *The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blitztheme
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 nopadding">

				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					 <div class="carousel-inner" role="listbox" >
							<?php
				                $query = new WP_Query(array(
				                  'post_type' => 'slider',
				                  'orderby' => 'ASC'
				                  ));

				                if ( $query->have_posts() ) : 
				                  $ctr = 0;
				                  while ( $query->have_posts() ) : $query->the_post();  
				                      $image = '';  
				                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				                         $image = get_the_post_thumbnail();
				                      }  
				                      $active = ($ctr == 0)? 'active' : '';
				                      echo '<div class="item '.$active.'" > 
						                        <div class="carousel-caption">  
						                          <div class="caption">
							                          <h1>'.get_the_title().'</h1>
							                          <p>'.get_the_content().'</p>
							                         
						                          </div>

						                        </div>
						                        '.$image.'
						                      </div>';

				                  		$ctr++;   
				                  endwhile;   
				                endif; 
				                wp_reset_postdata();
			              ?>
			              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				              <span class="sr-only">Previous</span>
			            </a>
			            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			              	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			              	<span class="sr-only">Next</span>
			            </a>
					</div>
				</div>
			</div>	



	</div>
	 <div class="row">
		 <div class="col-md-12 footer-menu-wrap nopadding"> 
	    	<nav class="navbar navbar-default nav-top tertiary-nav">
	        
	              <?php
	                    wp_nav_menu( array(
	                        'menu'              => 'who are we',
	                        'theme_location'    => 'tertiary',
	                        'depth'             => 2,
	                        'container'         => 'div',
	                        'container_id'      => 'navbar',
	                        'menu_class'        => 'nav navbar-nav tertiary',
	                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	                        'walker'            => new wp_bootstrap_navwalker())
	                    );
	                ?> 
	                
	        </nav>
        </div>
    </div>
	<div class="row">
		
		<?php 
			$query = new WP_Query(array(
					                  'post_type' => 'who_we_are',
					                  'order' => 'ASC',
					                  'posts_per_page' => 3,
					                  ));

			if ( $query->have_posts() ) : 
				 $ctr = 0;
                  while ( $query->have_posts() ) : $query->the_post();  
                      $image = '';  
                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                         $image = get_the_post_thumbnail();
                      }  
                      //$active = ($ctr == 0)? 'active' : '';
                      echo '<div class="col-md-4 nopadding index-post" > 
		                        <a href="'.get_permalink().'"> '.$image.'
		                          <div class="col-md-12">
			                          <h1 class="text-center pots-title">'.get_the_title().'</h1>
			                          <p>'. get_the_excerpt()/*//get_the_content()*/.'</p>           
		                          </div></a>
		                      </div>';

                  		$ctr++;   
                  endwhile;   
                endif; 
                wp_reset_postdata();

               ?>

	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<h1 class="explore">Explore Who We Are</h1>
		</div>
	</div>
	<div class="row">
		<?php 
			$query = new WP_Query(array(
					                  'post_type' => 'who_we_are',
					                  'order' => 'ASC',
					                  'posts_per_page' => 1,
					                  'category_name' => 'featured'
					                  ));

			if ( $query->have_posts() ) : 
				 $ctr = 0;
                  while ( $query->have_posts() ) : $query->the_post();  
                      $image = '';  
                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                         $image = get_the_post_thumbnail();
                      }  
                      //$active = ($ctr == 0)? 'active' : '';
                      echo '<div class="col-md-8 nopadding revitalize" > 
		                        <a href="'.get_permalink().'"> '.$image.'
		                          <div class="revitalize-text">
			                          <h1 class="text-center pots-title">'.get_the_title().'</h1>
			                          <p>'. get_the_excerpt()/*//get_the_content()*/.'</p>           
		                          </div></a>
		                      </div>';

                  		$ctr++;   
                  endwhile;   
                endif; 
                wp_reset_postdata();

                $query = new WP_Query(array(
					                  'post_type' => 'who_we_are',
					                  'order' => 'ASC',
					                  'posts_per_page' => 5,
					                  'category_name' => 'explore'
					                  ));

			if ( $query->have_posts() ) : 
				 $ctr = 0;
                  while ( $query->have_posts() ) : $query->the_post();  
                      $image = '';  
                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                         $image = get_the_post_thumbnail();
                      }  
                      //$active = ($ctr == 0)? 'active' : '';
                      echo '<div class="col-md-4 nopadding index-post" > 
		                        <a href="'.get_permalink().'"> '.$image.'
		                          <div class="col-md-12">
			                          <h1 class="text-center pots-title">'.get_the_title().'</h1>
			                          <p>'. get_the_excerpt()/*//get_the_content()*/.'</p>           
		                          </div></a>
		                      </div>';

                  		$ctr++;   
                  endwhile;   
                endif; 
                wp_reset_postdata();

        $query = new WP_Query(array(
		                  'post_type' => 'who_we_are',
		                  'order' => 'ASC',
		                  'posts_per_page' => 1,
		                  'category_name' => 'location'
		                  ));

			if ( $query->have_posts() ) : 
				 $ctr = 0;
                  while ( $query->have_posts() ) : $query->the_post();  
                      $image = '';  
                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                         $image = get_the_post_thumbnail();
                      }  
                      //$active = ($ctr == 0)? 'active' : '';
                      echo '<div class="col-md-8 nopadding revitalize" > 
		                          <div class="col-md-12 map">
		                          	'. get_the_content().'
		                          </div>
	                            <div class="col-md-12">
			                          <h1 class="text-center pots-title">' .get_the_title().'</h1>
			                             
		                          </div>
		                      </div>';

                  		$ctr++;   
                  endwhile;   
                endif; 
                wp_reset_postdata();

           ?>

	</div>

	<div class="row">
		<div class="col=md-12 also-explore">
			<h1>Also Explore</h1>
			<div class="col-md-4 nopadding">
			<?php	
		        $query = new WP_Query(array(
	        					 'post_type' => 'what_we_do',
				                  'name' => 'what-we-do',
				                  ));

					if ( $query->have_posts() ) : 
						 $ctr = 0;
		                  while ( $query->have_posts() ) : $query->the_post();  
		                      $image = '';  
		                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		                         $image = get_the_post_thumbnail();
		                      }  
		                      //$active = ($ctr == 0)? 'active' : '';
		                      echo '<div class="col-md-8 what-we-do nopadding ">
				                          	'. $image /*//get_the_content()*/.'      
				                          </div>
			                            <div class="col-md-4">
					                          <h4>'.get_the_title().'</h4>
					                             <p> '.get_the_excerpt().'</p>
				                          </div>';

		                  		$ctr++;   
		                  endwhile;   
		                endif; 
	                wp_reset_postdata();

		           ?>

			</div>
			<div class="col-md-4 nopadding">
				<?php	
		        $query = new WP_Query(array(
	        					 'post_type' => 'our_thinking',
				                  'name' => 'our-thinking',
				                  ));

					if ( $query->have_posts() ) : 
						 $ctr = 0;
		                  while ( $query->have_posts() ) : $query->the_post();  
		                      $image = '';  
		                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		                         $image = get_the_post_thumbnail();
		                      }  
		                      //$active = ($ctr == 0)? 'active' : '';
		                      echo '<div class="col-md-8 what-we-do nopadding ">
				                          	'. $image /*//get_the_content()*/.'      
				                          </div>
			                            <div class="col-md-4">
					                          <h5>'.get_the_title().'</h5>
					                              <p>'.get_the_excerpt().'</p>
				                          </div>';

		                  		$ctr++;   
		                  endwhile;   
		                endif; 
	                wp_reset_postdata();

		           ?>

			</div>
			<div class="col-md-4">
				
				
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>