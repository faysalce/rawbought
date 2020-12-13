<?php
/**
 * rawbought functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rawbought
 */

add_filter('ot_show_pages', '__return_false');
add_filter('ot_show_new_layout', '__return_false');
add_filter('ot_theme_mode', '__return_true');
require_once get_template_directory() . '/bootstrap-nav.php';
//include_once('includes/meta-boxes.php');

include_once( 'includes/theme-options.php' );
//include_once( 'includes/metabox.php' );
add_action( 'widgets_init', 'rawbought_widgets_init' );
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
  }
  add_filter('upload_mimes', 'cc_mime_types');
include_once( 'option-tree/ot-loader.php' );
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	//define( '_S_VERSION', '1.0.0' );
	define( '_S_VERSION', time() );
}

if ( ! function_exists( 'rawbought_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rawbought_setup() {

		
		add_filter('show_admin_bar', '__return_false');

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rawbought, use a find and replace
		 * to change 'rawbought' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rawbought', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'rawbought' ),
				'footer-contact' => esc_html__( 'Footer Contact', 'rawbought' ),
				'footer-customer' => esc_html__( 'Footer For Customer', 'rawbought' ),
				'footer-company' => esc_html__( 'Footer For Company', 'rawbought' ),
			)
		);
		function substrwords($text, $maxchar, $end='...') {
			if (strlen($text) > $maxchar || $text == '') {
				$words = preg_split('/\s/', $text);      
				$output = '';
				$i      = 0;
				while (1) {
					$length = strlen($output)+strlen($words[$i]);
					if ($length > $maxchar) {
						break;
					} 
					else {
						$output .= " " . $words[$i];
						++$i;
					}
				}
				$output .= $end;
			} 
			else {
				$output = $text;
			}
			return $output;
		}
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rawbought_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'rawbought_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rawbought_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rawbought_content_width', 640 );
}
add_action( 'after_setup_theme', 'rawbought_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rawbought_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'rawbought' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'rawbought' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/**
 * Enqueue scripts and styles.
 */
function get_details_desc(){
	global $post;


apply_filters('the_content',$post->post_content);
}
function rawbought_scripts() {
	
	wp_enqueue_style( 'rawbought-plugins-css', get_template_directory_uri().'/assets/plugins/plugin.css', array(), _S_VERSION );

	wp_enqueue_style( 'rawbought-bootstrap-css', get_template_directory_uri().'/assets/plugins/bootstrap/css/bootstrap.min.css', array('rawbought-plugins-css'), _S_VERSION );
	wp_enqueue_style( 'rawbought-style', get_template_directory_uri().'/assets/css/style.css', array('rawbought-bootstrap-css'), _S_VERSION );
	wp_enqueue_style( 'rawbought-style-custom', get_template_directory_uri().'/assets/css/custom.css', array('rawbought-style'), _S_VERSION );


	wp_enqueue_script( 'rawbought-jquery', get_template_directory_uri() . '/assets/plugins/jquery/jquery-3.5.1.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-bootstrap-js', get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.bundle.min.js', array('rawbought-jquery'), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-slick-js', get_template_directory_uri() . '/assets/plugins/slick/slick.min.js', array('rawbought-bootstrap-js'), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-metisMenu-js', get_template_directory_uri() . '/assets/plugins/metisMenu/metisMenu.min.js', array('rawbought-slick-js'), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-magnific-popup-js', get_template_directory_uri() . '/assets/plugins/magnific/jquery.magnific-popup.min.js', array('rawbought-metisMenu-js'), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-bootstrap-slider-js', get_template_directory_uri() . '/assets/plugins/range/bootstrap-slider.min.js', array('rawbought-magnific-popup-js'), _S_VERSION, true );
	wp_enqueue_script( 'rawbought-xzoom-js', get_template_directory_uri() . '/assets/plugins/zoom/jquery.zoom.min.js', array('rawbought-bootstrap-slider-js'), _S_VERSION, true );
	if(is_home()){
		wp_enqueue_script( 'rawbought-home-sloder-js', get_template_directory_uri() . '/assets/js/home-slider.js', array('rawbought-xzoom-js'), _S_VERSION, true );

	}
	wp_enqueue_script( 'rawbought-script-js', get_template_directory_uri() . '/assets/js/script.js', array('rawbought-xzoom-js'), _S_VERSION, true );
	
	wp_localize_script( 'rawbought-script-js', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'rawbought_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
