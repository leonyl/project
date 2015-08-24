<?php
/**
 *	LIST OF CREATED WP FUNCTIONS
 * 	1. Custom Post Type
 *	2. Taxonomies
 *	2. Meta boxes
 *	3. Custom widget for recent posts
 *
 */
 

/* HOW TO USE CUSTOM POST TYPE --------------------------------------------------------------------------	

	$custom_post = new Custom_Post;

	$custom_post->create_custom_post('news');   
	$custom_post->create_taxonomy('code', 'news' ); 
	$custom_post->create_taxonomy('language', 'news', array(
			'labels' => array('add_new_item' => 'Add New Language')
			)); 
 

	// GRABBING THE POST DATA ---------------------------------------------------------------------------

	$query = new WP_Query(array(
      'post_type' => 'news', 
      'posts_per_page' => 5, 
      'orderby' => 'ASC'
      ));

    if ( $query->have_posts() ) :  
      while ( $query->have_posts() ) : $query->the_post();  
          $image = '';  
          if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
             $image = get_the_post_thumbnail(); // return the img tag with src image
          }  

          echo '<div class="container">
	            	<div class="image">'.$image.'</div> 
	              	<h1>'.get_the_title().'</h1>
	              	<p>'.get_the_content().'</p>
	            </div>';
 
      endwhile;   
    endif;  

	 
 */


/* HOW TO USE META BOX ----------------------------------------------------------------------------------
	
	$custom_post = new Custom_Post; 
		
	$rd_config = array(
			'heading'   => 'Occupation',
			'id'        => 'rd_occu',
			'post_type' => 'news',
			'inputs'    => array( 
				'Company Name' => 'rd_company' 	// this is the input name 
				),
			'placement' => 'normal', 			// optional
			'priority'  => 'high' 				// optional
		);

	$custom_post->create_meta_box( $rd_config );

	
	// FOR SAVING META BOXES ---------------------------------------------------------------------------

	// Set all the input names in a single array

	$meta_box_input_names = array('rd_company');
	add_action('save_post', function() use($meta_box_input_names) {

		global $post;
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return; // to prevent autosave

		foreach ($meta_box_input_names as $input_name) {
			if(isset($_POST[$input_name])) {
				// post ID, input name, value 
				update_post_meta($post->ID,$input_name,$_POST[$input_name]); 
			}
		}  

	}); 

	// GRABBING THE META BOX DATA ----------------------------------------------------------------------

	Within the loop:
	
	Param 1 = post ID
	Param 2 = name of the input
	Param 3 = boolean | if true, the return value will be in a form of string otherwise array
	
	$metadata = get_post_meta(get_the_ID(), 'rd_url', true);

 */
   

 class Custom_Post
 {

	public function create_custom_post($post_type, $args = array()) 
	{  
		$post = new Custom_Post_Type; 
		$post->add_post_type($post_type, $args ); 
	}

	public function create_taxonomy($taxonomy, $post_type, $args = array()) 
	{  
		$post = new Custom_Post_Type; 
		$post->add_taxonomy($taxonomy, $post_type, $args ); 
	}


	public function create_meta_box( $config ) 
	{
		$meta_box = new Meta_Box;
		$meta_box->add_meta_box( $config );
	}


	public function active_custom_widget()
	{
		add_action('widgets_init', function(){
			register_widget('Custom_Recent_Posts');
		});
	}

 }




/**
 * WP CUSTOM POST TYPES ----------------------------------------------------------------------------------
 * Custom Post Types is a way to filter and group content together.
 * The custom post type create an extra menu in the Admin Panil that have a functionily like Post.
 *
 */
 

/**
 * get_terms( param ) - to get the list of data within a specific taxonomy
 * @param taxonomy - the name that you use for creating taxonomy
 * @return array
 */ 

/* HOW TO USE -------------------------------------------------------------

    $terms = get_terms('language'); 
	foreach ($terms as $term) {
		// $term->slug - like css, js, php 
		$href  = get_term_link($term->slug,'language'); // for href
		$label = $term->name; // for label or caption
		echo '<a href="''.$href." >'.$label.'</a>';
	}   

*/



class Custom_Post_Type
{
	/**
	 * This will create an extra menu where you can view the table list and add new.
	 * @param $name - the post type name.  
	 		  Note: The $name should be lowercase and without spacing in between otherwise it will be force 
	 		  		to become lowercase and replace all spaces to underscore. 
	 * @param $args - the custom options that you are going to have.
	 */

	public function add_post_type($post_type, $args = array()) 
	{
		$label = ucwords(str_replace('_', ' ', $post_type));
		$name  = strtolower(str_replace(' ', '_', $post_type));
		add_action('init', function() use($label, $name, $args) { 
			$args = array_merge( 
				array(
					'public' => true, // to make it viewable and searchable
					'label' => $label, // this will display at the admin panel menu
					'labels' => array(
						'add_new_item' => "Add New $label"
						),
					'supports' => array('title', 'editor', 'comments', 'excerpt','thumbnail'),
					'taxonomies' => array('category','post_tag')
				), 
				$args 
				);
			register_post_type($name,$args);
		});
	}


	/**
	 * This will create a menu like category and tag.
	 * @param $name - the taxonord name like category, tag, language, difficulty.
	  		  Note: The $name should be lowercase and without spacing in between otherwise it will be force 
	 		  		to become lowercase and replace all spaces to underscore. 
	 * @param $post_type - like post, page, attachment, custom post type like snippet.
	 * @param $args - the custom options that you are going to have.
	 */
	public function add_taxonomy($taxonomy, $post_type, $args = array() ) 
	{	
		$label = ucwords(str_replace('_', ' ', $taxonomy));
		$name  = strtolower(str_replace(' ', '_', $taxonomy));
		add_action('init', function() use($label, $name, $post_type, $args) { 
			$args = array_merge( 
				array( 'label' => $label ), 
				$args 
				);
			//name of taxonomy, asssociated post type, options
			register_taxonomy($name, $post_type, $args);
		});
	}


}




/**
 * WP META BOX -------------------------------------------------------------------------------------------
 * The meta box will display in the add/edit post page depending on the post_type.
 * This will create a sort of panel which you can include a form for your unique setting of 
 * that particular post.
 *
 */
 
class Meta_Box 
{     
   
	public function add_meta_box( $rd_new_config = array() )
	{ 	
		$rd_config = array(    
				'placement' => 'normal',
				'priority'  => 'high' 
			);

		$rd_final_config = array_merge($rd_config, $rd_new_config);

		add_action('add_meta_boxes', function() use($rd_final_config) { 
			 
			/** 
			 * @param id        - a unique ID that will be appended on you meta box 
			 * @param title     - the heading or label that will display on your meata box panel
			 * @param callback  - a function that will be call for creating the tmpl form for your meta box
			 * @param post_type - like post, page, attachment and a custom one like snippet and it should be lowercase.
			 * @param context   - normal|advanced|side where the meta box should be displayed
			 * @param priority  - high|core|default|low
			 */  
			$input_fields = $rd_final_config['inputs'];

			add_meta_box(
				$rd_final_config['id'], 
				$rd_final_config['heading'], 
				function() use( $input_fields ) { $this->meta_box_form_template( $input_fields ); }, 
				$rd_final_config['post_type'], 
				$rd_final_config['placement'],
				$rd_final_config['priority']
				);
		});

	}


	public function meta_box_form_template($input_fields) 
	{  
		global $post; 

		if(!empty($input_fields)) {
			foreach ($input_fields as $label =>  $input_name) {
				$input_name = trim(strtolower(str_replace(' ', '_', $input_name))); 
				/** 
				 * @param post id    - it is the ID of the current displayed post, where you can access through global variable $post
				 * @param input_name - the input name / reference id that you specified as ID in the input field.
				 * @param boolean    - true returns array | false returns string.
				 */ 
				$input_value = get_post_meta($post->ID, $input_name, true);
				?>
				<label for="<?php echo $input_name; ?>" ><?php echo $label.':'; ?></label>
				<input type="text" class="widefat" id="<?php echo $input_name; ?>" name="<?php echo $input_name; ?>" value="<?php echo $input_value; ?>" >
				<?php  

			} 
		} else {
			return;
		}

	}

 
}





/**
 * 	WP Widget 
 *	This process is about creating a widget, it is the one that you can drag and drop into the 
 *	widget container.
 */
 

class Custom_Recent_Posts extends WP_Widget 
{
	public function Custom_Recent_Posts() 
	{
		$options = array(
			'classname' => 'rd_widget_class', // for css
			'description' => 'Your site’s most recent Posts.'
			);
		$this->WP_Widget('rd_widget_id', 'Custom Recent Posts', $options); 

	}

	public function form($instance) {

		$default = array(
			'rd_title' => 'Custom Recent Posts',  
			'rd_post_type' => 'post',
			'rd_num_posts' => 5
			);
		$instance = wp_parse_args( (array) $instance, $default);

		$rd_title = $instance['rd_title'];
		$rd_post_type = $instance['rd_post_type'];
		$rd_num_posts = $instance['rd_num_posts'];

		$args = array(
		   'public'   => true,
		   '_builtin' => false // to exclude the built-in public post type
		);   
		$custom_public_post_types = get_post_types( $args, 'names', 'and' ); 
        $built_in_public_post_types = array('post'=>'post','page'=>'page');

        $public_post_types = array_merge($built_in_public_post_types, $custom_public_post_types);
 
		?>
		<p><label for="<?php echo $this->get_field_name('rd_title'); ?>">Title</label>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name('rd_title'); ?>"  value="<?php echo $rd_title; ?>" />
		</p>
		<p><label for="<?php echo $this->get_field_name('rd_post_type'); ?>">Post Type</label>
		<select class="widefat" name="<?php echo $this->get_field_name('rd_post_type'); ?>" >
		<?php
			foreach ($public_post_types as $post_type) {
				$selected = ($rd_post_type == $post_type)? 'selected' : ''; 
				echo '<option '.$selected.' value="'.$post_type.'" >'.ucwords( $post_type ).'</option>'; 
			} 
		?>
		</select> 
		</p>
		<p><label for="<?php echo $this->get_field_name('rd_num_posts'); ?>">Number of posts to show</label>
		<input type="number" min="1" max="10" class="widefat" name="<?php echo $this->get_field_name('rd_num_posts'); ?>"  value="<?php echo $rd_num_posts; ?>" />
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['rd_title'] = $new_instance['rd_title'];
		$instance['rd_post_type'] = $new_instance['rd_post_type'];
		$instance['rd_num_posts'] = $new_instance['rd_num_posts'];
		return $instance;
	}

	public function widget($args, $instance) { 

		extract($args);
		$title = apply_filters('widget_title',$instance['rd_title']);
		$post_type = $instance['rd_post_type'];
		$num_posts = $instance['rd_num_posts'];

		echo $before_widget;
		echo $before_title.$title.$after_title;

		$query = new WP_Query(array(
			'post_type' => $post_type, 
			'posts_per_page' => $num_posts, 
			'order' => 'DESC'
			));

		if ( $query->have_posts() ) : 
			echo '<ul>'; 
			while ( $query->have_posts() ) : $query->the_post(); 
				echo '<li><a href="'.get_the_permalink().'" >'.get_the_title().'</a></li>';
			endwhile;  
			echo '</ul>';
		else : 
 			echo '<p>No available results</p>';
		endif; 

		echo $after_widget;
		wp_reset_query(); 
	}

}

 

/**
 * WP FUNCTIONS
 * 
 	Note: To create a file with a single post and filter it out base on a specific post_type,
 		  you can make a file like single.php by making a single-{post_type}.php 
 		  e.g: single-snippet.php
 */
 

/**
 * 	wp_tag_cloud( param ) - to get all the tags specified.
 * 	@param unknown yet 
 */ 
/* HOW TO USE -------------------------------------------------------------

	wp_tag_cloud('format=list&smallest=9&largest=9');
*/	


/**
 * 	get_the_term_list( param, param, param, param ) - to get all the tags specified.
 * 	@param get_the_id() - retrieve the post ID of a particular base on the loop.
 * 	@param taxomony 
 * 	@param string - this character will display at the beginning of the list string.
 * 	@param string - this character will serve as a separator.
 * 	@return string, as display inline with a specific separator that you specified.
 */ 
/* HOW TO USE -------------------------------------------------------------

	echo get_the_term_list(get_the_id(), 'language','',', ');
*/	



/**
 * 	QUERY STRING IN WP  
 */ 
/* HOW TO USE -------------------------------------------------------------
	
	// Using query_post()

	query_posts('post_type=snippet'); 
	if ( have_posts() ) :  
		while ( have_posts() ) : the_post(); 
			get_template_part( 'content', get_post_format() ); 
		endwhile;  
	else :  
	 	get_template_part( 'content', 'none' ); 
	endif; 
	

	// Using WP_Query()

	$query = new WP_Query(array(
		'post_type' => 'news', 
		'posts_per_page' => 5, 
		'orderby' => 'ASC'
		));

	if ( $query->have_posts() ) : 
		while ( $query->have_posts() ) : $query->the_post();  
			echo '<a href="'.get_the_permalink().'" ><p>'.get_the_title().'</p></a>';
		endwhile;   
	endif;  

	wp_reset_postdata();


	the_tags(); // list of all the tags applied in a particular post

*/



/**
 *  In this particular function of filtering, will filter base only on the post_type of post and custom post type,
 *	when it is in the tag page. However you can also use the WP_Query to filter the output of the loop.
 */ 
/* HOW TO USE -------------------------------------------------------------

	add_filter('pre_get_posts', function($query){

		if( is_tag() & empty( $query->query_vars['suppress_filters'] ) ) {
			$query->set('post_type', array( 'post', 'snippet' ));
			return $query;
		}

	} );
*/



/**
 *  This function will extract the video id in a youtube url
 * 	@param url - the youtube video url like https://www.youtube.com/watch?v=nIjVuRTm-dc&index=3&list=PLFC4FEFE0BFAC492E
 *	@return string - the video id like nIjVuRTm-dc&index=3
 */ 

function get_youtube_video_id($url) {
	parse_str( parse_url($url, PHP_URL_QUERY), $result);
	return $result['v'];
}