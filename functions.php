<?php
/**
 * Chocolita functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Chocolita
 */

if ( ! function_exists( 'chocolita_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function chocolita_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Chocolita, use a find and replace
	 * to change 'chocolita' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'chocolita', get_template_directory() . '/languages' );

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
	
	//Custom image size for events
	add_image_size( 'thumb-eventos', 388, 345, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'chocolita' ),
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
	add_theme_support( 'custom-background', apply_filters( 'chocolita_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'chocolita_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chocolita_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'chocolita_content_width', 640 );
}
add_action( 'after_setup_theme', 'chocolita_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecsl_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'About us section', 'chocolita' ),
		'id'            => 'home_about_us',
		'before_widget' => '<div class="columns column-12 text-center">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer left column', 'chocolita' ),
		'id'            => 'footer_left',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer center column', 'chocolita' ),
		'id'            => 'footer_center',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer right column', 'chocolita' ),
		'id'            => 'footer_right',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'ecsl_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chocolita_scripts() {
	wp_enqueue_style( 'chocolita-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'dashicons' );
	
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'chocolita-smooth', get_template_directory_uri() . '/js/smoothscroll.js', array(), '1.0.0', true );

	wp_enqueue_script( 'chocolita-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'chocolita-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'chocolita_scripts' );

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

/**
 * Include front page options in admin.
 */
include 'portada-options.php';

/**
 * Enqueuing Google Fonts.
 */
function chocolita_add_google_fonts() {

wp_enqueue_style( 'chocolita-google-fonts', 'http://fonts.googleapis.com/css?family=Abel', false ); 
}

add_action( 'wp_enqueue_scripts', 'chocolita_add_google_fonts' ); 

/**
 * Register Eventos custom post type.
 *
 */
function ecsl_event_posttype() {
	register_post_type( 'eventos',
		array(
			'labels' => array(
				'name' => esc_html__( 'Events', 'chocolita' ),
				'singular_name' => esc_html__( 'Event', 'chocolita' ),
				'add_new' => esc_html__( 'Add New Event', 'chocolita' ),
				'add_new_item' => esc_html__( 'Add New Event', 'chocolita' ),
				'edit_item' => esc_html__( 'Edit Event', 'chocolita' ),
				'new_item' => esc_html__( 'Add New Event', 'chocolita' ),
				'view_item' => esc_html__( 'View Event', 'chocolita' ),
				'search_items' => esc_html__( 'Search Event', 'chocolita' ),
				'not_found' => esc_html__( 'No Events Found', 'chocolita' ),
				'not_found_in_trash' => esc_html__( 'No Events Found in Trash', 'chocolita' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "eventos"), // Permalinks format
			'menu_position' => 5,
			'menu_icon' => 'dashicons-calendar-alt',
			'register_meta_box_cb' => 'add_events_metaboxes'
		)
	);
}

add_action( 'init', 'ecsl_event_posttype' );

// Add the Events Meta Boxes
function add_events_metaboxes() {
	add_meta_box('ecsl_events_location', esc_html__( 'Event Details', 'chocolita' ), 'ecsl_events_location', 'eventos', 'normal', 'high');
}

// The Event Location Metabox
function ecsl_events_location() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_location', true);
    $url = get_post_meta($post->ID, '_url', true);
	
	// Echo out the field
    echo '<p>'.esc_html__( 'Country and city of the event', 'chocolita' ).'</p>';
	echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';
    echo '<p>'.esc_html__( 'Event website URL', 'chocolita' ).'</p>';
    echo '<input type="text" name="_url" value="' . $url  . '" class="widefat" />';

}

// Save the Metabox Data
function ecsl_save_events_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$events_meta['_location'] = $_POST['_location'];
	$events_meta['_url'] = $_POST['_url'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'ecsl_save_events_meta', 1, 2); // save the custom fields
