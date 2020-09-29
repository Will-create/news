<?php
/**
 * Grace Mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Grace_Mag
 */

if ( ! function_exists( 'grace_mag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function grace_mag_setup() {
        
        /* Theme Prefix Define */
		global $grace_mag_theme_prefix;

		$grace_mag_theme_prefix = 'grace_mag';
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Grace Mag, use a find and replace
		 * to change 'grace-mag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'grace-mag', get_template_directory() . '/languages' );

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
        
        add_image_size( 'grace-mag-thumbnail-one', 600, 400, true );
        add_image_size( 'grace-mag-thumbnail-two', 300, 200, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'grace-mag' ),
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
		add_theme_support( 'custom-background', apply_filters( 'grace_mag_custom_background_args', array(
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
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
        
         /**
         * Add editor CSS to style to the WordPress visual post / page editor.
         *
         * pulls in all of our front-end css.
         */
         add_editor_style('/everestthemes/assets/css/editor-style.css');
        
        // Add support for gutenberg
		add_theme_support( 'align-wide' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'grace_mag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
 
function grace_mag_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'grace_mag_content_width', 640 );
}
add_action( 'after_setup_theme', 'grace_mag_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function grace_mag_widgets_init() {
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'grace-mag' ),
		'id'            => 'grace-mag-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h2>',
		'after_title'   => '</h2></div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Header Advertisement', 'grace-mag' ),
		'id'            => 'grace-mag-header-advertisement',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s" class="top-ad-area widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h2>',
		'after_title'   => '</h2></div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Canvas Sidebar', 'grace-mag' ),
		'id'            => 'grace-mag-canvas-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h2>',
		'after_title'   => '</h2></div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Fullwidth Top News Area', 'grace-mag' ),
		'id'            => 'grace-mag-fullwidth-top-news-area',
		'description'   => esc_html__( 'Add fullwidth widget here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Middle News Area', 'grace-mag' ),
		'id'            => 'grace-mag-middle-news-area',
		'description'   => esc_html__( 'Add halfwidget widget here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Fullwidth Bottom News Area', 'grace-mag' ),
		'id'            => 'grace-mag-fullwidth-bottom-news-area',
		'description'   => esc_html__( 'Add fullwidth widget here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'grace-mag' ),
		'id'            => 'grace-mag-footer-left',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title foot-tittle"><h2 class="wid-title">',
		'after_title'   => '</h2></div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Middle', 'grace-mag' ),
		'id'            => 'grace-mag-footer-middle',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title foot-tittle"><h2 class="wid-title">',
		'after_title'   => '</h2></div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'grace-mag' ),
		'id'            => 'grace-mag-footer-right',
		'description'   => esc_html__( 'Add widgets here.', 'grace-mag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title foot-tittle"><h2 class="wid-title">',
		'after_title'   => '</h2></div>',
	) );
}
add_action( 'widgets_init', 'grace_mag_widgets_init', 20 );

/**
 * Enqueue scripts and styles.
 */

function grace_mag_admin_enqueue_script() {
    
    wp_enqueue_style('grace-mag-admin-style', get_template_directory_uri().'/everestthemes/admin/css/gm-admin-style.css');
    
    wp_enqueue_script( 'grace-mag-admin-script', get_template_directory_uri() . '/everestthemes/admin/js/gm-admin-script.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
}
add_action('admin_enqueue_scripts', 'grace_mag_admin_enqueue_script');

/**
 * Enqueue scripts and styles.
 */
function grace_mag_scripts() {
    
	wp_enqueue_style( 'grace-mag-style', get_stylesheet_uri() );
    
    wp_enqueue_style( 'grace-mag-google-fonts', grace_mag_fonts_url() );
    
    wp_enqueue_style( 'grace-mag-reset', get_template_directory_uri() . '/everestthemes/assets/css/reset.css' );
    
    if ( is_rtl() ) {
        
        wp_enqueue_style(  'bootstrap-rtl',  get_template_directory_uri() . '/everestthemes/assets/css/bootstrap-min-rtl.css');
    } else {
        
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/everestthemes/assets/css/bootstrap.min.css');
    }

    wp_enqueue_script( 'grace-mag-theia-sticky-sidebar', get_template_directory_uri() . '/everestthemes/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/everestthemes/assets/css/font-awesome.min.css' );
    
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/everestthemes/assets/css/slick.css' );
    
	wp_enqueue_style( 'webticker', get_template_directory_uri() . '/everestthemes/assets/css/webticker.css' );

	wp_enqueue_style( 'grace-mag-custom', get_template_directory_uri() . '/everestthemes/assets/css/custom.css' );

	wp_enqueue_style( 'grace-mag-default-style', get_template_directory_uri() . '/everestthemes/assets/css/default-style.css' );
    
	wp_enqueue_style( 'grace-mag-responsive', get_template_directory_uri() . '/everestthemes/assets/css/responsive.css' );
    
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/everestthemes/assets/js/bootstrap.min.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    
    wp_enqueue_script( 'webticker', get_template_directory_uri() . '/everestthemes/assets/js/webticker.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
    
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/everestthemes/assets/js/slick.min.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	wp_enqueue_script( 'grace-mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'grace-mag-custom', get_template_directory_uri() . '/everestthemes/assets/js/custom.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'grace_mag_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load welcome section to admin.
 */
if ( is_admin() ) {
    require get_template_directory().'/inc/welcome/welcome-config.php';
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Load TGM plugin activation.
 */
require get_template_directory() . '/third-party/class-tgm-plugin-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load options for theme.
 */
require get_template_directory() . '/inc/option-choices.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load breadcrumbs.
 */
require get_template_directory() . '/third-party/breadcrumbs.php';

/**
 * Functions which hooks into the theme functions.
 */
require get_template_directory() . '/inc/theme-hooks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load widgets for theme
 */
require get_template_directory() . '/widgets/widgets.php';

/**
 * Post Meta Sidebar Position for this theme.
 */
require get_template_directory() . '/inc/custom-fields/sidebar-position.php';

