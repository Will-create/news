<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Grace_Mag
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
   
<?php

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} else {
	do_action( 'wp_body_open' );
}
/**
* Hook - grace_mag_site_preloader_action.
*
* @hooked grace_mag_site_preloader_action - 10
*/
do_action( 'grace_mag_site_preloader' );
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'grace-mag' ); ?></a>

<header id="gm-masterheader" class="gm-masterheader">
	<?php
	if ( has_header_image() ) {
		?>
		<div class="header-inner withbg" style="background-image: url( <?php header_image(); ?> );">
		<?php
	} else {
		?>
		<div class="header-inner">
		<?php
	}
		$display_top_header = grace_mag_mod( 'display_top_header', true );
	if ( $display_top_header == true ) {
		?>
		<div class="header-top-block top-bar clearfix">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-lg-4">
					<?php
					/**
					 * Hook - grace_mag_header_current_date.
					 *
					 * @hooked grace_mag_header_current_date_action - 10
					 */
					do_action( 'grace_mag_header_current_date' );
					?>
					</div>
					<div class="col-12 col-lg-5">
					<?php
					/**
					 * Hook - grace_mag_header_breaking_news.
					 *
					 * @hooked grace_mag_header_breaking_news_action - 10
					 */
					do_action( 'grace_mag_header_breaking_news' );
					?>
					</div> <!--col-lg-5-->
					<div class="col-12 col-lg-3">
					<?php
					/**
					 * Hook - grace_mag_header_social_links.
					 *
					 * @hooked grace_mag_header_social_links_action - 10
					 */
					do_action( 'grace_mag_header_social_links' );
					?>
					</div>
				</div>
				<!--row-->
			</div>
			<!--container-->
		</div>
		<?php
	}
	?>
		<!--top-header topbar-->
		<div class="header-mid-block logo-sec">
			<div class="container">
				<div class="row  align-items-center">
					<div class="col-5 col-md-3 col-lg-4">
						<div class="logo-area">
						<?php
						/**
						 * Hook - grace_mag_header_custom_logo.
						 *
						 * @hooked grace_mag_header_custom_logo_action - 10
						 */
						do_action( 'grace_mag_header_custom_logo' );
						?>
						</div>
					</div>
					<!--logo-area-->
					<div class="col-7 col-md-9 col-lg-8">
						<?php
						/**
						 * Hook - grace_mag_header_advertisement.
						 *
						 * @hooked grace_mag_header_advertisement_action - 10
						 */
						do_action( 'grace_mag_header_advertisement' );
						?>
					</div>
				</div>
				<!--row-->
			</div>
			<!--container-->
		</div>
		<!--header-mid-block logo-sec-->
		<div class="header-bottom-block primary-menu">
			<div class="container">
				<div class="menu-wrap clearfix">
				   <?php
					/**
					 * Hook - grace_mag_header_canvas_menu_button.
					 *
					 * @hooked grace_mag_header_canvas_menu_button_action - 10
					 */
					do_action( 'grace_mag_header_canvas_menu_button' );

					/**
					* Hook - grace_mag_header_main_menu.
					*
					* @hooked grace_mag_header_main_menu_action - 10
					*/
					do_action( 'grace_mag_header_main_menu' );

					/**
					* Hook - grace_mag_header_mobile_menu.
					*
					* @hooked grace_mag_header_mobile_menu_action - 10
					*/
					do_action( 'grace_mag_header_mobile_menu' );

					/**
					* Hook - grace_mag_header_search.
					*
					* @hooked grace_mag_header_search_action - 10
					*/
					do_action( 'grace_mag_header_search' );
					?>
				</div>
				<!--menu wrap-->
			</div>
			<!--container-->
		</div>
		<!--header-bottom-block primary menu-->
	</div>
	<!--inner header-->
</header>
<?php

/**
 * Hook - grace_mag_header_canvas_menu.
 *
 * @hooked grace_mag_header_canvas_menu_action - 10
 */
do_action( 'grace_mag_header_canvas_menu' );
