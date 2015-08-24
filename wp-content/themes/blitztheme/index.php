<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blitztheme
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div class="col-md-8 nopadding">

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
		
	
		<?php 
				$query = new WP_Query(array(
						                  'post_type' => 'our_thinking',
						                  'order' => 'ASC',
						                  'posts_per_page' => 8
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
				                          <h1 class="text-center">'.get_the_title().'</h1>
				                          <p>'. get_the_excerpt()/*//get_the_content()*/.'</p>           
			                          </div></a>
			                      </div>';

	                  		$ctr++;   
	                  endwhile;   
	                endif; 
	                wp_reset_postdata();

                $query = new WP_Query(array(
					                  'post_type' => 'what_we_do',
					                  'posts_per_page' => 1,
					                  'order' => 'ASC'
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
			                        '.$image.'
			                          <div class="revitalize-text">
				                          <h1>'.get_the_title().'</h1>
				                          <p>'.get_the_content().'</p>           
			                          </div>
			                      </div>';

	                  		$ctr++;   
	                  endwhile;   
	                endif; 
	                wp_reset_postdata();
          ?>

	</div>
	<div class="row">
		<div class="col-md-4 twitts">
			
		</div>

		<div class="col-md-4 popular">
			<h4>Most Popular Videos</h4>
			<span class="popular-next pop-slider-nav" data-dir="next"></span>
			<span class="popular-prev pop-slider-nav" data-dir="prev"></span>
			<div class="popular-slider">
				<?php 
					if (function_exists('wpp_get_mostpopular'))
        			wpp_get_mostpopular('post_type="our_thinking" thumbnail_width=390&thumbnail_height=332');


	        	?>

			</div>
			
		</div>
	
		<div class="col-md-4">
			
		</div>
	</div>
		

	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
