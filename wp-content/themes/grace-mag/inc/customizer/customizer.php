<?php
/**
 * Grace Mag Theme Customizer
 *
 * @package Grace_Mag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function grace_mag_customize_register( $wp_customize ) {
    
    global $grace_mag_theme_prefix;
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
    /**
	 * Load custom customizer control for radio image control
	 */
	require get_template_directory() . '/inc/customizer/controls/class-customizer-radio-image-control.php';

	/**
	 * Load custom customizer control for toggle control
	 */
	require get_template_directory() . '/inc/customizer/controls/class-customizer-toggle-control.php';
    
    /**
	 * Load custom customizer control for slider control
	 */
	require get_template_directory() . '/inc/customizer/controls/class-customizer-slider-control.php';
    
    /**
	 * Load customizer functions for sanitization of input values of contol fields
	 */
	require get_template_directory() . '/inc/customizer/functions/sanitize-callback.php';
    
    /**
	 * Load customizer functions
	 */
	require get_template_directory() . '/inc/customizer/functions/customizer-functions.php';
    
    // Upspell
	require_once trailingslashit( get_template_directory() ) . '/inc/customizer/upgrade-to-pro/upgrade.php';

	$wp_customize->register_section_type( 'Grace_Mag_Customize_Section_Upsell' );
    
    $wp_customize->add_section(
        new Grace_Mag_Customize_Section_Upsell( $wp_customize, 'grace_mag_pro', 
            array(
                'title'         => esc_html__( 'Grace Mag Pro', 'grace-mag' ),
                'button_text'   => esc_html__( 'Buy Pro', 'grace-mag' ),
                'button_url'    => 'https://everestthemes.com/themes/grace-mag-pro/',
                'priority'      => 1,
                )
        )
    );
    
    /**
	 * Load customizer functions for loading control field's choices, declaration of panel, section 
	 * and control fields
	 */
	require get_template_directory() . '/inc/customizer/functions/customizer-fields.php';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'grace_mag_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'grace_mag_customize_partial_blogdescription',
		) );
	}
    
    /**
	 * Control Rearrange
	 */
    
    $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'grace-mag' );
    $wp_customize->get_control( 'background_color' )->section = 'background_image';
    $wp_customize->get_section( 'background_image' )->title = esc_html__( 'Site Background', 'grace-mag' );
    $wp_customize->get_control( 'header_image' )->priority = 30;
    $wp_customize->get_section( 'static_front_page' )->priority = 2;
   
    $wp_customize->get_control( 'custom_logo' )->section = 'grace_mag_site_logo_section';
    $wp_customize->get_control( 'blogname' )->section = 'grace_mag_site_logo_section';
    $wp_customize->get_control( 'blogdescription' )->section = 'grace_mag_site_logo_section';
    $wp_customize->get_control( 'header_textcolor' )->section = 'grace_mag_site_logo_section';
    $wp_customize->get_control( 'display_header_text' )->section = 'grace_mag_site_logo_section';
    $wp_customize->get_control( 'site_icon' )->section = 'grace_mag_site_favicon_section';
    $wp_customize->get_control( 'header_image' )->section = 'grace_mag_main_header_section';
}
add_action( 'customize_register', 'grace_mag_customize_register' );

/**
 * Load active callback functions.
 */
require get_template_directory() . '/inc/customizer/functions/active-callback.php';

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function grace_mag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function grace_mag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Function to load dynamic styles.
 *
 * @since  1.0.0
 * @access public
 * @return null
 */
function dynamic_style() {
    
    ?>
    <style type="text/css">  
    <?php
    
    $banner_bg_opacity = grace_mag_mod( 'banner_bg_opacity', 80 );
    
    $banner_opacity_value = $banner_bg_opacity/100;
    
    ?>
        
    .banner-slider:before {
        
        content: '';
        background-color: <?php echo esc_attr( 'rgb(0, 0, 0, ' . $banner_opacity_value . ')' ); ?>;
    }
        
    <?php
    
    /*-----------------------------------------------------------------------------
                                Theme Color
    -----------------------------------------------------------------------------*/
    
    $primary_color = grace_mag_mod( 'primary_color', '#e01212' );
    
    if( !empty( $primary_color ) ) {
        
        ?>
        .title-sec h2:after,
        .post-categories li a,
        .gm-slider .slick-arrow,
        .header-inner.layout2 button.hamburger.hamburger_nb
        {
            background-color: <?php echo esc_attr( $primary_color ); ?>;
        }
        
        a:focus, a:hover,
        .breadcrumbs .trail-items li a:hover, .recent-post-list .list-content h4 a:hover,
        .top-social-icon li a:hover,
        ul.newsticker li a:hover,
        .header-inner.layout2 .top-social-icon li a:hover,
        .header-inner.withbg .main_navigation ul li a:hover,
        .nt_title i,
        .copy-content a:hover
        {
            color: <?php echo esc_attr( $primary_color ); ?>;
        }
        
        .search-icon .search-form #submit {
            background: <?php echo esc_attr( $primary_color ); ?>;
        }
        <?php

    }
    
    $fonts = grace_mag_fonts_array();

    /*-----------------------------------------------------------------------------
                                Body Typo
    -----------------------------------------------------------------------------*/

    $global_font_family = grace_mag_mod( 'global_font_family', 'Roboto:400,400i,500,500i,700,700i' );
    $global_line_height = grace_mag_mod( 'global_line_height', '1.5' );
    $global_letter_spacing = grace_mag_mod( 'global_letter_spacing', '0px' );

     ?>
    body
    {

        <?php

        if( !empty( $global_font_family ) ) {

            ?>
            font-family: <?php echo esc_attr( $fonts[ $global_font_family ] ); ?>;
            <?php
        }

        if( !empty( $global_line_height ) ) {

            ?>
            line-height: <?php echo esc_attr( $global_line_height ); ?>;
            <?php

        }

        if( !empty( $global_letter_spacing ) ) {

            ?>
            letter-spacing: <?php echo esc_attr( $global_letter_spacing ); ?>;
            <?php

        }

        ?>
    }
    
    </style>
        
    <?php  
}
add_action( 'wp_head', 'dynamic_style' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function grace_mag_customize_preview_js() {
	wp_enqueue_script( 'grace-mag-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'grace_mag_customize_preview_js' );

/**
 * Enqueue Customizer Scripts and Styles
 */
function grace_mag_enqueues() {

	wp_enqueue_style( 'grace-mag-customizer-style', get_template_directory_uri() . '/inc/customizer/assets/css/customizer-style.css' );
    
    wp_enqueue_style( 'grace-mag-upgrade', get_template_directory_uri() . '/inc/customizer/assets/css/upgrade.css' );
    
    wp_enqueue_script( 'grace-mag-upgrade', get_template_directory_uri() . '/inc/customizer/assets/js/upgrade.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	// Register the script
    wp_register_script( 'grace-mag-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-script.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ) , true );

    // Localize the script with new data
    $title_array = array(
        'custom_logo' => esc_html__( 'Logo Setup', 'grace-mag' ),
        'top_header_display_today_date' => esc_html__( 'Top Header : Options', 'grace-mag' ),
        'top_header_news_ticker_category' => esc_html__( 'News Ticker Content', 'grace-mag' ),
        'header_image' => esc_html__( 'Header Image', 'grace-mag' ),
        'banner_category' => esc_html__( 'Banner Content', 'grace-mag' ),
        'post_single_display_featured_image' => esc_html__( 'Post Content', 'grace-mag' ),
        'post_single_display_author_section' => esc_html__( 'Author Section', 'grace-mag' ),
        'post_single_display_related_posts_section' => esc_html__( 'Related Posts Section', 'grace-mag' ),
        'page_single_display_featured_image' => esc_html__( 'Page Content', 'grace-mag' ),
        'blog_page_display_featured_image' => esc_html__( 'Post Content', 'grace-mag' ),
        'blog_page_sidebar_position' => esc_html__( 'Sidebar Position', 'grace-mag' ),
        'archive_page_display_featured_image' => esc_html__( 'Post Content', 'grace-mag' ),
        'archive_page_sidebar_position' => esc_html__( 'Sidebar Position', 'grace-mag' ),
        'search_page_display_featured_image' => esc_html__( 'Post Content', 'grace-mag' ),
        'search_page_sidebar_position' => esc_html__( 'Sidebar Position', 'grace-mag' ),
        'common_page_background_image' => esc_html__( 'Breadcrumb Image', 'grace-mag' ),
        'sticky_news_title' => esc_html__( 'Sticky News Content', 'grace-mag' ),
    );
    wp_localize_script( 'grace-mag-customizer-script', 'grace_mag', $title_array );

    // Enqueued script with localized data.
    wp_enqueue_script( 'grace-mag-customizer-script' );
}
add_action( 'customize_controls_enqueue_scripts', 'grace_mag_enqueues' );
