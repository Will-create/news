<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Grace_Mag
 */

/**
 * Load Author Widget.
 */
require get_template_directory() . '/widgets/fullwidth-news-widget.php';
require get_template_directory() . '/widgets/halfwidth-news-widget.php';
require get_template_directory() . '/widgets/post-widget.php';

function grace_mag_custom_widgets_init() {
	
    register_widget( 'Grace_Mag_Fullwidth_News_Widget' );
    
    register_widget( 'Grace_Mag_Halfwidth_News_Widget' );
    
    register_widget( 'Grace_Mag_Post_Widget' );
}
add_action( 'widgets_init', 'grace_mag_custom_widgets_init', 10 );