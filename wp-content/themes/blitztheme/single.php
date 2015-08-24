<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blitztheme
 */

get_header(); ?>

	<div class="container">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'custom' ); ?>

					<?php //the_post_navigation(); ?>

					 

				<?php endwhile; /* End of the loop. */ 

					 ?>	

		
	</div>
		<!-- #main -->
	<!-- #primary -->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
