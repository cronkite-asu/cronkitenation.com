<?php
/**
 * Cronkite News theme functions and definitions
 *
 */

// If BuddyPress is not activated, switch back to the default WP theme and bail out
if ( ! function_exists( 'bp_is_active' ) ) {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	return;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */


if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


if ( ! function_exists( 'cronkitenation_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress and BuddyPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 */
function cronkitenation_theme_setup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'cronkitenation_theme_setup' );
endif;

function cronkitenation_login_logo() {
    echo '<style type="text/css">';
	echo 'h1 a {';
	echo 'background-image:url(';
	echo get_stylesheet_directory_uri() . '/_inc/images/cronkite.png';
	echo ') !important;';
	echo 'background-size: auto !important;';
	echo 'width: initial !important;';
	echo '}';
    echo '</style>';
}
add_action('login_head', 'cronkitenation_login_logo');

function loginpage_custom_link() {
	return home_url();
}
add_filter('login_headerurl','loginpage_custom_link');

function change_title_on_logo() {
	return 'New Media Innovation Lab | Walter Cronkite School of Journalism and Mass Communication at Arizona State University';
}
add_filter('login_headertitle', 'change_title_on_logo');

function cronkitenation_add_scripts() {
    wp_register_script( 'html5shiv', 'https://html5shiv.googlecode.com/svn/trunk/html5.js', array(), null, true );
    wp_register_script( 'googel_maps_api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true', array(), null, true );

	wp_register_script('d3_script', get_stylesheet_directory_uri() . '/blogs/d3.v2.min.js', array( 'jquery' ), '2.0', true);
	wp_register_script('d3_geo_script', get_stylesheet_directory_uri() . '/blogs/world_files/d3.geo.js', array( 'jquery', 'd3_script' ), '1.1', true);
	wp_register_script('cn_map', get_stylesheet_directory_uri() . '/blogs/world_files/cn_map.js', array( 'jquery', 'd3_geo_script' ), '1.1', true);
	wp_register_script('infowindow_script', get_stylesheet_directory_uri() . '/blogs/infowindow.js', array( 'googel_maps_api' ), '1.1', true);
	wp_register_script('asu_header', 'https://www.asu.edu/asuthemes/4.0/js/asu_header.min.js', array(), '4.0', true);
	wp_register_script('jsapi', 'http://www.google.com/jsapi', array(), null, true);

	wp_enqueue_script('jquery');
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-mouse' );
    wp_enqueue_script( 'jquery-ui-slider' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-resize' );
    wp_enqueue_script( 'jquery-ui-button' );

	wp_enqueue_script('html5shiv');
	wp_enqueue_script('googel_maps_api');
	wp_enqueue_script('infowindow_script');
	wp_enqueue_script('asu_header');

	if ( is_page_template( 'page-2d.php' ) ) {
		wp_enqueue_script('jsapi');
	}	
}
add_action( 'wp_enqueue_scripts', 'cronkitenation_add_scripts' ); 

function cronkitenation_add_styles() {
	// Setup font arguments
	$query_args = array(
		'family' => 'Roboto:400,300,500,700,900'
	);
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'cronkitenation-style', get_stylesheet_uri() );
 
 	// A safe way to register a CSS style file for later use
	wp_register_style( 'google-fonts', add_query_arg( $query_args, $protocol . "://fonts.googleapis.com/css" ) );
    wp_register_style( 'font-awesome', $protocol . '://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' ); 
	
	// A safe way to add/enqueue a CSS style file to a WordPress generated page
	wp_enqueue_style( 'cronkitenation-style' );
	wp_enqueue_style( 'google-fonts' );
    wp_enqueue_style('font-awesome'); 
}
add_action( 'wp_enqueue_scripts', 'cronkitenation_add_styles' );

function cronkitenation_hide_admin_bar() {
	if ( ! is_admin() )
		add_filter( 'show_admin_bar', '__return_false' );
}
add_action( 'after_setup_theme', 'cronkitenation_hide_admin_bar' );

function cronkitenation_adjust_post_types() {
	// remove some default post types
	$remove_types = array('post');
	global $wp_post_types;
	foreach($remove_types as $post_type) {
		if ( isset( $wp_post_types[ $post_type ] ) ) {
			unset( $wp_post_types[ $post_type ] );
		}
	}
}
add_action( 'after_setup_theme', 'cronkitenation_adjust_post_types' );

function cronkitenation_adjust_admin_menu() {
	// remove some default post types' admin menus
	$remove_types = array('post');
	$slug_base = 'edit.php';
	// in admin AJAX requests, the menu list can be empty, causing errors.
	global $menu; if(empty($menu)) return;
	foreach($remove_types as $post_type) {
		$slug = ( $post_type == 'post' ) ? $slug_base : $slug_base . '?post_type=' . $post_type;
		remove_menu_page( $slug );
	}
}
add_action( 'admin_init', 'cronkitenation_adjust_admin_menu' );

function cronkitenation_adjust_new_content_menu() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('new-post');
}
add_action( 'wp_before_admin_bar_render', 'cronkitenation_adjust_new_content_menu' );

?>
