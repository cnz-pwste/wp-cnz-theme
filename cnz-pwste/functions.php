<?php
/**
 * CNZ_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CNZ_Theme
 */

$current_theme = wp_get_theme( 'cnz-pwste' );

define( 'CNZ_THEME_VERSION', $current_theme->get( 'Version' ) );

if ( ! function_exists( 'cnz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cnz_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on CNZ_Theme, use a find and replace
		 * to change 'cnz-pwste' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'CNZ_Theme', get_template_directory() . '/languages' );

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
		add_image_size( 'cnz-pwste-thumbnail-extra-large', 800, 600, true );
		add_image_size( 'cnz-pwste-thumbnail-large', 800, 450, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary Menu', 'cnz-pwste' ),
			'menu-2' => esc_html__( 'Secondary Menu', 'cnz-pwste' ),
			'menu-3' => esc_html__( 'Top Header Menu', 'cnz-pwste' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'cnz_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(

			'height'      => 250,
			'width'       => 70,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cnz_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cnz_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cnz_content_width', 640 );
}
add_action( 'after_setup_theme', 'cnz_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function cnz_scripts() {

	wp_enqueue_style( 'cnz-pwste-style', get_stylesheet_uri() );

	wp_enqueue_style( 'cnz-pwste-fonts', cnz_lite_fonts_url() );

	wp_enqueue_style( 'cnz-pwste-boxicons', get_template_directory_uri() . '/assets/fonts/boxicons/boxicons.css' , array(), CNZ_THEME_VERSION, 'all' );

	wp_enqueue_style( 'cnz-pwste-fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/fontawesome.css' , array(), CNZ_THEME_VERSION, 'all' );

	if( is_rtl() ) {

		wp_enqueue_style( 'cnz-pwste-main-style-rtl', get_template_directory_uri() . '/assets/dist/css/main-style-rtl.css' , array(), CNZ_THEME_VERSION, 'all');

		wp_add_inline_style( 'cnz-pwste-main-style-rtl', cnz_dynamic_style() );
	} else {

		wp_enqueue_style( 'cnz-pwste-main-style', get_template_directory_uri() . '/assets/dist/css/main-style.css' , array(), CNZ_THEME_VERSION, 'all' );

		wp_add_inline_style( 'cnz-pwste-main-style', cnz_dynamic_style() );
	}
	
	wp_register_script( 'cnz-pwste-bundle', get_template_directory_uri() . '/assets/dist/js/bundle.min.js', array('jquery'), CNZ_THEME_VERSION, true );

	$script_obj = array();

	$script_obj['scroll_top'] = cnz_get_option( 'display_scroll_top_button' );


	wp_localize_script( 'cnz-pwste-bundle', 'cnz_obj', $script_obj );

	wp_enqueue_script( 'cnz-pwste-bundle' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cnz_scripts' );


/**
 * Enqueue scripts and styles for admin.
 */
function cnz_admin_enqueue( $hook ) {

	wp_enqueue_script( 'media-upload' );

	wp_enqueue_media();

	wp_enqueue_style( 'cnz-pwste-admin-style', get_template_directory_uri() . '/admin/css/admin-style.css' );

	wp_enqueue_script( 'cnz-pwste-admin-script', get_template_directory_uri() . '/admin/js/admin-script.js', array( 'jquery' ), CNZ_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'cnz_admin_enqueue' );

if( defined( 'ELEMENTOR_VERSION' ) ) {

	add_action( 'elementor/editor/before_enqueue_scripts', 'cnz_admin_enqueue' );
}


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
require get_template_directory() . '/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load breadcrumb trails.
 */
require get_template_directory() . '/third-party/breadcrumbs.php';

/**
 * Load TGM plugin activation.
 */
require get_template_directory() . '/third-party/class-tgm-plugin-activation.php';

/**
 * Load plugin recommendations.
 */
require get_template_directory() . '/inc/plugin-recommendation.php';

/**
 * Load custom hooks necessary for theme.
 */
require get_template_directory() . '/inc/custom-hooks.php';


/**
 * Load function that enhance theme functionality.
 */
require get_template_directory() . '/inc/theme-functions.php';


/**
 * Load option choices.
 */
require get_template_directory() . '/inc/option-choices.php';


/**
 * Load widgets and widget areas.
 */
require get_template_directory() . '/widget/widgets-init.php';


/**
 * Load custom fields.
 */
require get_template_directory() . '/inc/custom-fields.php';

/**
 * Load theme dependecies
 */
require get_template_directory() . '/vendor/autoload.php';

if( ! function_exists( 'cnz_admin_notice' ) ) {

	function cnz_admin_notice() {
// tu mozna dodac do panelu prtzy uzyciu WPTRT
	}
}  
cnz_admin_notice();