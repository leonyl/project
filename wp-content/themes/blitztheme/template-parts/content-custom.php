<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blitztheme
 */

?>
		<div class="row">
			<div class="col-md-12 nopadding breadcrumb">
				<h4><?php echo get_the_title(); ?></h4>
			</div>
		</div>
		<div class="row">
		<div class="col-md-8 nopadding">
		
			<div class="col-md-12 nopadding">
					<?php 
						 $image = '';  
	                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	                         $image = get_the_post_thumbnail();
	                      } 
					?>
					<div class="single-page-image">
						<?php echo $image; ?>
					</div>
			</div>

		
	
		<div class="col-md-12 nopadding">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="custom-entry-header">
					<?php the_title( '<h1 class="custom-entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php //blitztheme_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="col-md-10 custom-entry-content nopadding">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="custom-page-links">' . esc_html__( 'Pages:', 'blitztheme' ),
							'after'  => '</div>',
						) );
					?>


					<?php	
								 


						 $query = new WP_Query(array(
								                  'post_type' => get_post_type( get_the_ID() ),
								                  'order' => 'ASC',
								                  'posts_per_page' => 3,
								                  'post__not_in' => array(get_the_ID()),
								                  //'paged' => get_query_var('paged'),
								                  ));
						
						if ( $query->have_posts() ) : 
							 $ctr = 0;
					          while ( $query->have_posts() ) : $query->the_post();  
					              $image = '';  
					              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					                 $image = get_the_post_thumbnail();
					              }  
					              //$active = ($ctr == 0)? 'active' : '';
					              echo '<div class="col-md-12 nopadding" > 
					                        <a href="'.get_permalink().'">
					                          <div class="col-md-12 nopadding">
						                          <h1>'.get_the_title().'</h1>
						                          <p>'.get_the_excerpt().'</p>           
					                          </div></a>
					                      </div>';

					          		$ctr++;   
					          endwhile;  
					         
					        endif; 
					        // wp_pagenavi( array( 'query' => $query ) );  

					        wp_reset_postdata();


					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php //blitztheme_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

	</div>
		
		</div>
		
		<div class="col-md-4 nopadding">
		
				<div class="col-md-12 nopadding"></div>
				
				<div class="col-md-6 link_posts_left nopadding"></div>
				<div class="col-md-6 link_posts_right nopadding"></div>
			
	
				<div class="col-md-12 single-page-sidebar nopadding">
				<div class="col-md-12">
					<?php  
							//echo //$post->ID().'<br>';

							 //echo get_post_type(get_the_ID());

					 ?>
				</div>
				<?php	
					 


					 $query = new WP_Query(array(
							                  'post_type' => get_post_type( get_the_ID() ),
							                  'order' => 'ASC',
							                  'posts_per_page' => 3,
							                  'post__not_in' => array(get_the_ID()),
							                  ));
					
					if ( $query->have_posts() ) : 
						 $ctr = 0;
		                  while ( $query->have_posts() ) : $query->the_post();  
		                      $image = '';  
		                      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
		                         $image = get_the_post_thumbnail();
		                      }  
		                      //$active = ($ctr == 0)? 'active' : '';
		                      echo '<div class="col-md-12 nopadding index-post" > 
				                        <a href="'.get_permalink().'"> '.$image.'
				                          <div class="col-md-12 ">
					                          <h1>'.get_the_title().'</h1>
					                          <p>'.get_the_excerpt().'</p>           
				                          </div></a>
				                      </div>';

		                  		$ctr++;   
		                  endwhile;  
		

		                endif; 
		                wp_reset_postdata();
				?>
				</div>
			
			
			</div>
		</div>