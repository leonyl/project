<?php

require_once('wp-bootstrap-navwalker/wp_bootstrap_navwalker.php');
require_once('lib/my_custom_post_widget.php');
/**
 * blitztheme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package blitztheme
 */

if ( ! function_exists( 'blitztheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blitztheme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blitztheme, use a find and replace
	 * to change 'blitztheme' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'blitztheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'blitztheme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blitztheme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // blitztheme_setup
add_action( 'after_setup_theme', 'blitztheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blitztheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blitztheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'blitztheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blitztheme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'blitztheme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blitztheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blitztheme_scripts() {
	wp_enqueue_style( 'blitztheme-bootstrap', get_stylesheet_directory_uri().'/css/css/bootstrap.min.css' );
	wp_enqueue_style( 'blitztheme-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'blitztheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'popular-post-slider-js', get_template_directory_uri() . '/js/popular-post-slider.js', array('jquery'), '', true );

	wp_enqueue_script( 'blitztheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blitztheme_scripts' );


register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'blitztheme' ),
) );

register_nav_menus( array(
    'secondary' => __( 'Secondary', 'blitztheme' ),
) );
register_nav_menus( array(
    'tertiary' => __( 'who we are', 'blitztheme' ),
) );

register_nav_menus( array(
    'footer' => __( 'footer Menu', 'blitztheme' ),
) );

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 40 );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


$custom_post = new Custom_Post; 
$custom_post->create_custom_post('our_thinking');
$custom_post->create_custom_post('who_we_are');
$custom_post->create_custom_post('what_we_do');

/* My First Custom Post Type */

function my_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'label' => __('Slides'), 
				'singular_label' => __('Slide', 'my_framework'),
				'_builtin' => false,
				'exclude_from_search' => true, // Exclude from Search Results
				'capability_type' => 'page',
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => array(
									'slug' => 'slide-view',
									'with_front' => FALSE,
								),
				'query_var' => "slide", // This goes to the WP_Query schema
				'menu_icon' => get_template_directory_uri() . '/inc/images/slides.png',
				'supports' => array(
									'title',
									'custom-fields',
									'editor',
			    					'thumbnail')
								) 
				);
}

add_action('init', 'my_post_type_slider');

add_action( 'init', 'mytheme_setup' );
add_theme_support( 'post-thumbnails' );

function mytheme_setup(){}