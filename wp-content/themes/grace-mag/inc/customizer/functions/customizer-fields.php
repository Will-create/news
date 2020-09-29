<?php
/**
 * Customizer Options Declaration
 *
 * @package Grace_Mag
 */

$categories = grace_mag_categories_array();
$sidebar_position = grace_mag_sidebar_position_array( 'image' );
$fonts = grace_mag_fonts_array();

/*-----------------------------------------------------------------------------
							GLOBAL COLOR PANEL OPTIONS 
-----------------------------------------------------------------------------*/

grace_mag_add_panel( 
    'global_color', //id
    esc_html__( 'Global Color', 'grace-mag' ), //title
    '', //desc
    5 //priority
);


/*-----------------------------------------------------------------------------
							THEME COLOR SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'theme_color_section', //id
    esc_html__( 'Theme Color', 'grace-mag' ), //title
    '', //desc
    'global_color', //panel
    10 //priority
);

grace_mag_add_field( 
    'primary_color', //id
    esc_html__( "Primary Color", 'grace-mag' ), //label
    '', //desc
    '', //type ( text, number, url, select, ios )
    'theme_color_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'color', //control ( image, toggle, slider, multiple, color, upload )
    '#e01212' //default
);


/*-----------------------------------------------------------------------------
							GLOBAL TYPO SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section(
    'global_typo_section', //id
    esc_html__( 'Global Typography', 'grace-mag' ), //title
    '', //desc
    '', //panel
    5 //priority
);

grace_mag_add_field(
    'global_font_family', //id
    esc_html__( "Font Family", 'grace-mag' ), //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'global_typo_section', //section
    $fonts, //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'select-font', //control ( image, toggle, slider, multiple, color, upload )
    'Roboto:400,400i,500,500i,700,700i' //default
);

grace_mag_add_field(
    'global_line_height', //id
    esc_html__( "Line Height", 'grace-mag' ), //label
    esc_html__( 'You can set line height in pixel or normal. Eg: 24px, 1.3 etc.', 'grace-mag' ), //desc
    'text', //type ( text, number, url, select, ios )
    'global_typo_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '1.5' //default
);

grace_mag_add_field(
    'global_letter_spacing', //id
    esc_html__( "Letter Spacing", 'grace-mag' ), //label
    esc_html__( 'You can set letter spacing in pixel. Eg: 1.8px.', 'grace-mag' ), //desc
    'text', //type ( text, number, url, select, ios )
    'global_typo_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '0px' //default
);


/*-----------------------------------------------------------------------------
							SITE PRELOADER SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'site_preloader_section', //id
    esc_html__( 'Site Preloader', 'grace-mag'), //title
    '', //desc
    '', //panel
    5 //priority
);

grace_mag_add_field( 
    'display_site_preloader', //id
    esc_html__( "Display Preloader", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'site_preloader_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							SITE HEADER PANEL OPTIONS 
-----------------------------------------------------------------------------*/

grace_mag_add_panel( 
    'site_header', //id
    esc_html__( 'Site Header', 'grace-mag' ), //title
    '', //desc
    10 //priority
);

/*-----------------------------------------------------------------------------
							SITE LOGO SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'site_logo_section', //id
    esc_html__( 'Site Logo', 'grace-mag'), //title
    '', //desc
    'site_header', //panel
    10 //priority
);

/*-----------------------------------------------------------------------------
							SITE FAVICON SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'site_favicon_section', //id
    esc_html__( 'Site Favicon', 'grace-mag'), //title
    '', //desc
    'site_header', //panel
    10 //priority
);

/*-----------------------------------------------------------------------------
							TOP HEADER SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'top_header_section', //id
    esc_html__( 'Top Header', 'grace-mag'), //title
    '', //desc
    'site_header', //panel
    10 //priority
);

grace_mag_add_field( 
    'display_top_header', //id
    esc_html__( 'Display Top Header', 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'top_header_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'top_header_display_today_date', //id
    esc_html__( "Display Today's Date", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'top_header_section', //section
    '', //choices
    'grace_mag_active_top_header', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'top_header_display_news_ticker', //id
    esc_html__( "Display News Ticker", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'top_header_section', //section
    '', //choices
    'grace_mag_active_top_header', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'top_header_news_ticker_category', //id
    esc_html__( 'Post Category', 'grace-mag'), //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'top_header_section', //section
    $categories, //choices
    'grace_mag_active_news_ticker', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'top_header_news_ticker_post_number', //id
    esc_html__( 'No. of Posts Items', 'grace-mag'), //label
    esc_html__( 'Maximum 5 items and minimum 2 items can be set for news ticker.', 'grace-mag'), //desc
    'number', //type ( text, number, url, select, ios )
    'top_header_section', //section
    '', //choices
    'grace_mag_active_news_ticker', //active_callback
    '2', //min
    '5', //max
    '1', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '4' //default
);

grace_mag_add_field( 
    'top_header_display_social_links', //id
    esc_html__( "Display Social Links", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'top_header_section', //section
    '', //choices
    'grace_mag_active_top_header', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							MAIN HEADER SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'main_header_section', //id
    esc_html__( 'Main Header', 'grace-mag'), //title
    '', //desc
    'site_header', //panel
    10 //priority
);

grace_mag_add_field( 
    'main_header_display_canvas', //id
    esc_html__( "Display Canvas Sidebar", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'main_header_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'main_header_display_search', //id
    esc_html__( "Display Search Icon", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'main_header_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							BANNER SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'banner_section', //id
    esc_html__( 'Site Banner', 'grace-mag'), //title
    '', //desc
    '', //panel
    10 //priority
);

grace_mag_add_field( 
    'display_banner', //id
    esc_html__( "Display Banner", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'banner_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'banner_category', //id
    esc_html__( 'Post Category', 'grace-mag'), //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'banner_section', //section
    $categories, //choices
    'grace_mag_active_banner', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'banner_post_number', //id
    esc_html__( 'No. of Posts Items', 'grace-mag'), //label
    esc_html__( 'Maximum 5 items and minimum 3 items can be set for banner.', 'grace-mag'), //desc
    'number', //type ( text, number, url, select, ios )
    'banner_section', //section
    '', //choices
    'grace_mag_active_banner', //active_callback
    '3', //min
    '5', //max
    '1', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '4' //default
);

grace_mag_add_field( 
    'banner_bg_image', //id
    esc_html__( "Upload Background Image", 'grace-mag'), //label
    esc_html__( 'Uploaded image will be display in the background of banner.', 'grace-mag'), //desc
    '', //type ( text, number, url, select, ios )
    'banner_section', //section
    '', //choices
    'grace_mag_active_banner', //active_callback
    '', //min
    '', //max
    '', //step
    'upload', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field( 
    'banner_bg_opacity', //id
    esc_html__( "Set Background Opacity", 'grace-mag'), //label
    '', //desc
    '', //type ( text, number, url, select, ios )
    'banner_section', //section
    '', //choices
    'grace_mag_active_banner', //active_callback
    '0', //min
    '100', //max
    '1', //step
    'slider', //control ( image, toggle, slider, multiple, color, upload )
    '80' //default
);

/*-----------------------------------------------------------------------------
							SITE PAGES PANEL OPTIONS 
-----------------------------------------------------------------------------*/

grace_mag_add_panel( 
    'site_pages', //id
    esc_html__( 'Site Pages', 'grace-mag'), //title
    '', //desc
    20 //priority
);

/*-----------------------------------------------------------------------------
							POST SINGLE SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'post_single_section', //id
    esc_html__( 'Post Single', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'post_single_display_featured_image', //id
    esc_html__( "Display Featured Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_post_category', //id
    esc_html__( "Display Post Category", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_posted_date', //id
    esc_html__( "Display Posted Date", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_comment_number', //id
    esc_html__( "Display Comment No", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_tags', //id
    esc_html__( "Display Post Tags", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'post_single_display_background_image', //id
    esc_html__( "Display Breadcrumb Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_author_section', //id
    esc_html__( "Display Section", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_related_posts_section', //id
    esc_html__( "Display Section", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_related_posts_section_title', //id
    esc_html__( "Section Title", 'grace-mag'), //label
    '', //desc
    'text', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    'grace_mag_active_related_posts', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    'RELATED POSTS' //default
);

grace_mag_add_field( 
    'post_single_display_related_posted_date', //id
    esc_html__( "Display Posted Date", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    'grace_mag_active_related_posts', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_display_related_posts_comment_number', //id
    esc_html__( "Display Comment No", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    'grace_mag_active_related_posts', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'post_single_related_posts_post_number', //id
    esc_html__( "No of Post Items", 'grace-mag'), //label
    esc_html__( 'Maximum 3 items and minimum 1 items can be set on related posts.', 'grace-mag'), //desc
    'number', //type ( text, number, url, select, ios )
    'post_single_section', //section
    '', //choices
    'grace_mag_active_related_posts', //active_callback
    '1', //min
    '3', //max
    '1', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '3' //default
);

/*-----------------------------------------------------------------------------
							PAGE SINGLE SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'page_single_section', //id
    esc_html__( 'Page Single', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'page_single_display_featured_image', //id
    esc_html__( "Display Featured Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'page_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'page_single_display_background_image', //id
    esc_html__( "Display Breadcrumb Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'page_single_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							BLOG PAGE SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'blog_page_section', //id
    esc_html__( 'Blog Page', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'blog_page_display_featured_image', //id
    esc_html__( "Display Featured Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'blog_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'blog_page_display_post_category', //id
    esc_html__( "Display Post Category", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'blog_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'blog_page_display_posted_time', //id
    esc_html__( "Display Posted Time", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'blog_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'blog_page_display_comment_number', //id
    esc_html__( "Display Comment No", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'blog_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'blog_page_sidebar_position', //id
    "", //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'blog_page_section', //section
    $sidebar_position, //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'image', //control ( image, toggle, slider, multiple, color, upload )
    'right' //default
);

/*-----------------------------------------------------------------------------
							ARCHIVE PAGE SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'archive_page_section', //id
    esc_html__( 'Archive Page', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'archive_page_display_featured_image', //id
    esc_html__( "Display Featured Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'archive_page_display_post_category', //id
    esc_html__( "Display Post Category", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'archive_page_display_posted_time', //id
    esc_html__( "Display Posted Time", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'archive_page_display_comment_number', //id
    esc_html__( "Display Comment No", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'archive_page_display_background_image', //id
    esc_html__( "Display Breadcrumb Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'archive_page_sidebar_position', //id
    "", //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'archive_page_section', //section
    $sidebar_position, //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'image', //control ( image, toggle, slider, multiple, color, upload )
    'right' //default
);

/*-----------------------------------------------------------------------------
							SEARCH PAGE SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'search_page_section', //id
    esc_html__( 'Search Page', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'search_page_display_featured_image', //id
    esc_html__( "Display Featured Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'search_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'search_page_display_post_category', //id
    esc_html__( "Display Post Category", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'search_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'search_page_display_posted_time', //id
    esc_html__( "Display Posted Time", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'search_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'search_page_display_comment_number', //id
    esc_html__( "Display Comment No", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'search_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'search_page_display_background_image', //id
    esc_html__( "Display Breadcrumb Image", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'search_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field( 
    'search_page_sidebar_position', //id
    "", //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'search_page_section', //section
    $sidebar_position, //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'image', //control ( image, toggle, slider, multiple, color, upload )
    'right' //default
);

/*-----------------------------------------------------------------------------
							COMMON OPTION SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'common_page_section', //id
    esc_html__( 'Common Options', 'grace-mag'), //title
    '', //desc
    'site_pages', //panel
    10 //priority
);

grace_mag_add_field( 
    'common_page_background_image', //id
    "", //label
    esc_html__( 'Uploaded image will be shown in Archive Page, Search Page, Post Single and Page Single.', 'grace-mag'), //desc
    '', //type ( text, number, url, select, ios )
    'common_page_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'upload', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

/*-----------------------------------------------------------------------------
							STICKY NEWS SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section(
    'sticky_news_section', //id
    esc_html__( 'Sticky News', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field(
    'display_front_sticky_news', //id
    esc_html__( "Display On Front Page", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'display_single_sticky_news', //id
    esc_html__( "Display On Single Post", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

grace_mag_add_field(
    'sticky_news_title', //id
    esc_html__( 'Sticky News Title', 'grace-mag'), //label
    '', //desc
    'text', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    'Read Also' //default
);

grace_mag_add_field(
    'sticky_news_category', //id
    esc_html__( 'Post Category', 'grace-mag'), //label
    '', //desc
    'select', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    $categories, //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field(
    'sticky_news_post_number', //id
    esc_html__( 'No. of Posts Items', 'grace-mag'), //label
    esc_html__( 'Maximum 3 items and minimum 1 items can be set for sticky news.', 'grace-mag'), //desc
    'number', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    '', //choices
    '', //active_callback
    '1', //min
    '3', //max
    '1', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '3' //default
);

grace_mag_add_field(
    'display_sticky_news_category', //id
    esc_html__( "Display Posts Category", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'sticky_news_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    false //default
);

/*-----------------------------------------------------------------------------
							BREADCRUMB SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'breadcrumb_section', //id
    esc_html__( 'Breadcrumb', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field( 
    'display_breadcrumb', //id
    esc_html__( "Display Breadcrumb", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'breadcrumb_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							SITE SIDEBAR SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'site_sidebar_section', //id
    esc_html__( 'Site Sidebar', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field( 
    'enable_sticky_sidebar', //id
    esc_html__( "Enable Sticky Sidebar", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'site_sidebar_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							SITE FOOTER SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'site_footer_section', //id
    esc_html__( 'Site Footer', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field( 
    'display_scroll_top', //id
    esc_html__( "Display Scroll Top", 'grace-mag'), //label
    esc_html__( 'This option lets you to display or hide scroll to top link floating at right corner.', 'grace-mag'), //desc
    'ios', //type ( text, number, url, select, ios )
    'site_footer_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

//Option : Footer Copyright Text
$wp_customize->add_setting( 'grace_mag_copyright_text', array(
    'sanitize_callback'        => 'grace_mag_sanitize_copyright_credit',
    'default'                  => '',
) );

$wp_customize->add_control( 'grace_mag_copyright_text', array(
    'label'                    => esc_html__( 'Copyright Text', 'grace-mag' ),
    'description'		       => esc_html__( 'You can use <a> & <span> tags with the copyright and credit text.', 'grace-mag' ),
    'section'                  => 'grace_mag_site_footer_section',
    'type'                     => 'text',
) );

/*-----------------------------------------------------------------------------
							SOCIAL LINKS SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'social_links_section', //id
    esc_html__( 'Social Links', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field( 
    'facebook_link', //id
    esc_html__( "Facebook Link", 'grace-mag'), //label
    '', //desc
    'url', //type ( text, number, url, select, ios )
    'social_links_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field( 
    'instagram_link', //id
    esc_html__( "Instagram Link", 'grace-mag'), //label
    '', //desc
    'url', //type ( text, number, url, select, ios )
    'social_links_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field( 
    'twitter_link', //id
    esc_html__( "Twitter Link", 'grace-mag'), //label
    '', //desc
    'url', //type ( text, number, url, select, ios )
    'social_links_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field( 
    'youtube_link', //id
    esc_html__( "Youtube Link", 'grace-mag'), //label
    '', //desc
    'url', //type ( text, number, url, select, ios )
    'social_links_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '' //default
);

grace_mag_add_field( 
    'display_rss_feed', //id
    esc_html__( "Display RSS Feed", 'grace-mag'), //label
    '', //desc
    'ios', //type ( text, number, url, select, ios )
    'social_links_section', //section
    '', //choices
    '', //active_callback
    '', //min
    '', //max
    '', //step
    'toggle', //control ( image, toggle, slider, multiple, color, upload )
    true //default
);

/*-----------------------------------------------------------------------------
							EXCERPT LINKS SECTION OPTIONS
-----------------------------------------------------------------------------*/

grace_mag_add_section( 
    'excerpt_length_section', //id
    esc_html__( 'Excerpt Length', 'grace-mag'), //title
    '', //desc
    '', //panel
    20 //priority
);

grace_mag_add_field( 
    'excerpt_length', //id
    esc_html__( "Excerpt Length", 'grace-mag'), //label
    esc_html__( 'Maximum excerpt length 40 and minimum excerpt length 20 can be set.', 'grace-mag'), //desc
    'number', //type ( text, number, url, select, ios )
    'excerpt_length_section', //section
    '', //choices
    '', //active_callback
    '20', //min
    '40', //max
    '1', //step
    '', //control ( image, toggle, slider, multiple, color, upload )
    '25' //default
);
