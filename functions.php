<?php
/**
 * wpfamous functions and definitions
 *
 * @package wpfamous
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'wpfamous_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wpfamous_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wpfamous, use a find and replace
	 * to change 'wpfamous' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'wpfamous', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'wpfamous' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wpfamous_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // wpfamous_setup
add_action( 'after_setup_theme', 'wpfamous_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function wpfamous_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'wpfamous' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'wpfamous_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wpfamous_scripts() {
	wp_enqueue_style( 'wpfamous-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wpfamous-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'wpfamous-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
   
    // module loader
    wp_register_script( 'requirejs', '//code.famo.us/lib/require.js', array(), '', false );
    
    //adding scripts file in the footer
    wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', false );
        
    // famo.us shims for backwards compatibility
    wp_register_script( 'famous-prototypeBind', '//code.famo.us/lib/functionPrototypeBind.js', array(), '', false );
    wp_register_script( 'famous-classList', '//code.famo.us/lib/classList.js', array(), '', false );
    wp_register_script( 'famous-requestAnimationFrame', '//code.famo.us/lib/requestAnimationFrame.js', array(), '', false );

    // famous

    wp_register_style( 'famous-stylesheet', '//code.famo.us/famous/0.2/famous.css', array(), '', 'all' );
    wp_register_style( 'famous-stylesheet', get_stylesheet_directory_uri() . '/css/app.css', array(), '', 'all' );


    wp_register_script( 'famous', '//code.famo.us/famous/0.2/famous.min.js', array(), '', false );

    // enqueue styles and scripts
    wp_enqueue_script( 'requirejs' );

    wp_enqueue_script( 'famous-prototypeBind' );
    wp_enqueue_script( 'famous-classList' );
    wp_enqueue_script( 'famous-requestAnimationFrame' );


    wp_enqueue_style( 'famous-stylesheet' );
    wp_enqueue_script( 'famous' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpfamous_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
