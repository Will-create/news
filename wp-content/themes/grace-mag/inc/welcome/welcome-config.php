<?php
	/**
	 * Welcome Page Initiation
	*/

	include get_template_directory() . '/inc/welcome/welcome.php';

	$strings = array(
		// Welcome Page General Texts
		'welcome_menu_text' 		=> esc_html__( 'Grace Mag Setup', 'grace-mag' ),
		'theme_short_description' 	=> esc_html__( 'Magazine &nbsp; | &nbsp; Customizable &nbsp; | &nbsp; SEO Optimized  &nbsp; | &nbsp; Responsive', 'grace-mag' ),

		//free vs pro
		'free_vs_pro' => array(

            'features' => array(
                'Header Layouts' => array('1 Layout','3 Layouts'),
                'Banner Layouts' => array('1 Layout','4 Layouts'),
                'Font Options' => array('Yes! 20 Fonts', 'Yes! 800+ Fonts', '', 'dashicons-yes'),
                'Color Options' => array('Primary Color', 'Yes', '', 'dashicons-yes'),
                'Typography Options' => array('Global Option', 'Yes', '', 'dashicons-yes'),
                'Blog Page Layouts' => array('1 Layout', '3 Layouts'),
                'Archive Page Layouts' => array('1 Layout', '2 Layouts'),
                'Archive Page Title Layouts' => array('1 Layout', '3 Layouts'),
                'Search Page Layouts' => array('1 Layout', '2 Layouts'),
                'Single Post Layouts' => array('1 Layout', '2 Layouts'),
                'Single Page Layouts' => array('1 Layout', '2 Layouts'),
                'Sticky News Options' => array('Normal', 'Advance'),
                'Widget Options' => array('Normal', 'Advance'),
                'Full Width Widget' => array('2 Layouts', '7 Layouts'),
                'Half Width Widget' => array('3 Layouts', '4 Layouts'),
                'Post Widget' => array('2 Layouts', '4 Layouts'),
                'Social Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Author User Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Instagram Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Video Widget' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Advance Breadcrumb' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Sidebar Options' => array('Normal', 'Advance'),
                'Social Links' => array('3', '7'),
                'Social Share' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Global Excerpt Length' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Custom Excerpt Length' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Remove Theme Credit' => array('No', 'Yes', 'dashicons-no-alt', 'dashicons-yes'),
                'Translation Ready' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'Responsive Layout' => array('Yes', 'Yes', 'dashicons-yes', 'dashicons-yes'),
                'SEO' => array('Optimized', 'Optimized'),
                'Support' => array('Yes', 'High Priority Dedicated Support')
            ),
        ),


	);

	/**
	 * Initiating Welcome Page
	*/
	$my_theme_wc_page = new Grace_Mag_Welcome( $strings );
