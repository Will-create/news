<?php
/**
 * Collection of active callback functions for customizer fields.
 *
 * @package Grace_Mag
 */

/**
 * Active callback function for when top header is active.
 */
if( ! function_exists( 'grace_mag_active_top_header' ) ) {

	function grace_mag_active_top_header( $control ) {

		if ( $control->manager->get_setting( 'grace_mag_display_top_header' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}

/**
 * Active callback function for when top header and news ticker is active.
 */
if( ! function_exists( 'grace_mag_active_news_ticker' ) ) {

	function grace_mag_active_news_ticker( $control ) {

		if ( $control->manager->get_setting( 'grace_mag_display_top_header' )->value() == true && $control->manager->get_setting( 'grace_mag_top_header_display_news_ticker' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}

/**
 * Active callback function for when banner is active.
 */
if( ! function_exists( 'grace_mag_active_banner' ) ) {

	function grace_mag_active_banner( $control ) {

		if ( $control->manager->get_setting( 'grace_mag_display_banner' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}

/**
 * Active callback function for when banner is active.
 */
if( ! function_exists( 'grace_mag_active_related_posts' ) ) {

	function grace_mag_active_related_posts( $control ) {

		if ( $control->manager->get_setting( 'grace_mag_post_single_display_related_posts_section' )->value() == true ) {

			return true;
		} else {
			
			return false;
		}		
	}
}