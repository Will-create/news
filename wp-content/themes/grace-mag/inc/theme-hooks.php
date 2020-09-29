<?php
/**
 * Custom hooks for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Grace_Mag
 */ 

/**
 * Site preloader hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_site_preloader_action' ) ) :

 	function grace_mag_site_preloader_action() {
        
        $display_site_preloader = grace_mag_mod( 'display_site_preloader', true );
        
        if( $display_site_preloader == true ) {

            ?>
            <div class="loader-wrap">
                <div class="loader-inn">
                    <div class="loader">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!--loader-->
                </div>
            </div><!--loader-wrap-->
            <?php
        }
 	}
endif;
add_action( 'grace_mag_site_preloader', 'grace_mag_site_preloader_action', 10 );

/**
 * Header current date hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_current_date_action' ) ) :

 	function grace_mag_header_current_date_action() {
        
        $top_header_display_today_date = grace_mag_mod( 'top_header_display_today_date', true );
        
        if( $top_header_display_today_date == true ) {
        
            $type = 'l, jS F Y';
            
            $time = date_i18n( $type, current_time( 'timestamp', 1 ) );

            ?>
            <div class="current-date">
                <span><?php esc_html_e( 'Today', 'grace-mag' ); ?></span>
                <i><?php echo esc_html( $time );  ?></i>
            </div>
            <!--topbar current time-->
            <?php
        }
 	}
endif;
add_action( 'grace_mag_header_current_date', 'grace_mag_header_current_date_action', 10 );


/**
 * Header breaking news hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_breaking_news_action' ) ) :

 	function grace_mag_header_breaking_news_action() {
        
        $top_header_display_news_ticker = grace_mag_mod( 'top_header_display_news_ticker', true );
        
        if( $top_header_display_news_ticker == true ) {

 		?>
 		<div class="breaking-news-wrap">
            <?php grace_mag_news_ticker_template(); ?>
        </div> <!--topbar Breaking News-->
        <?php
        }
 	}
endif;
add_action( 'grace_mag_header_breaking_news', 'grace_mag_header_breaking_news_action', 10 );


/**
 * Header social links hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_social_links_action' ) ) :

 	function grace_mag_header_social_links_action() {
        
        $top_header_display_social_links = grace_mag_mod( 'top_header_display_social_links', true );
        
        if( $top_header_display_social_links == true ) {

 		?>
 		<ul class="top-social-icon">
            <?php grace_mag_social_links_template( 'header' ); ?>
        </ul>
        <!--top social-->
        <?php
        }
 	}
endif;
add_action( 'grace_mag_header_social_links', 'grace_mag_header_social_links_action', 10 );


/**
 * Header custom logo hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_custom_logo_action' ) ) :

 	function grace_mag_header_custom_logo_action() {

 		the_custom_logo();
                            
        ?>
        <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
        <?php

        $grace_mag_description = get_bloginfo( 'description', 'display' );

        if ( $grace_mag_description || is_customize_preview() ) :

        ?>
        <p class="site-description"><?php echo esc_html( $grace_mag_description ); /* WPCS: xss ok. */ ?></p>
        <?php

        endif;
 	}
endif;
add_action( 'grace_mag_header_custom_logo', 'grace_mag_header_custom_logo_action', 10 );


/**
 * Header advertisement hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_advertisement_action' ) ) :

 	function grace_mag_header_advertisement_action() {
        
        //header advertisement
        if( is_active_sidebar( 'grace-mag-header-advertisement' ) ) {

            dynamic_sidebar( 'grace-mag-header-advertisement' );
        }
 	}
endif;
add_action( 'grace_mag_header_advertisement', 'grace_mag_header_advertisement_action', 10 );


/**
 * Header canvas menu button hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_canvas_menu_button_action' ) ) :

 	function grace_mag_header_canvas_menu_button_action() {
        
        $main_header_display_canvas = grace_mag_mod( 'main_header_display_canvas', true );
        
        if( $main_header_display_canvas == true ) {
        
        ?>
 		<button class="hamburger hamburger_nb" type="button"> <span class="hamburger_box"> <span class="hamburger_inner"></span> </span> </button>
        <?php
        }
 	}
endif;
add_action( 'grace_mag_header_canvas_menu_button', 'grace_mag_header_canvas_menu_button_action', 10 );


/**
 * Header main menu hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_main_menu_action' ) ) :

 	function grace_mag_header_main_menu_action() {
        
        ?>
 		<nav id="main_navigation" class="main_navigation">
            <?php
            $menu_args = array(
                'theme_location' => 'menu-1',
                'container' => '',
                'menu_class' => 'clearfix',
                'menu_id' => '',
                'fallback_cb' => 'grace_mag_navigation_fallback',
            );
            wp_nav_menu( $menu_args );
            ?>
        </nav>
        <?php
 	}
endif;
add_action( 'grace_mag_header_main_menu', 'grace_mag_header_main_menu_action', 10 );


/**
 * Header mobile menu hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_mobile_menu_action' ) ) :

 	function grace_mag_header_mobile_menu_action() {
        
        ?>
 		<div class="mobile-menu-icon">
            <div class="mobile-menu"><i class="fa fa-align-right"></i><?php esc_html_e( 'Menu', 'grace-mag' ); ?></div>
        </div>
        <!--mobile-menu-->
        <?php
 	}
endif;
add_action( 'grace_mag_header_mobile_menu', 'grace_mag_header_mobile_menu_action', 10 );

/**
 * Header search hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_search_action' ) ) :

 	function grace_mag_header_search_action() {
        
        $main_header_display_search = grace_mag_mod( 'main_header_display_search', true );
        
        if( $main_header_display_search == true ) {
        
        ?>
 		<div class="search-icon">
            <button class="btn-style btn-search" type="button"><i class="fa fa-search"></i></button>
            <div id="header-search">
                <?php get_search_form(); ?>
            </div>
        </div><!--// top search-section -->
        <?php
        }
 	}
endif;
add_action( 'grace_mag_header_search', 'grace_mag_header_search_action', 10 );

/**
 * Header mobile menu hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_header_canvas_menu_action' ) ) :

 	function grace_mag_header_canvas_menu_action() {
        
        $main_header_display_canvas = grace_mag_mod( 'main_header_display_canvas', true );
        
        if( $main_header_display_canvas == true ) {
        
        ?>
 		<div class="side-canvas">
            <div class="close">
                <span class="fa fa-close"></span>
            </div>
            <?php
            //canvas sidebar
            if( is_active_sidebar( 'grace-mag-canvas-sidebar' ) ) {
                
                dynamic_sidebar( 'grace-mag-canvas-sidebar' );
            }
            ?>
        </div>
        <!--canvas-->
        <div class="overlay"></div>
        <?php
        }
 	}
endif;
add_action( 'grace_mag_header_canvas_menu', 'grace_mag_header_canvas_menu_action', 10 );

/**
 * Footer container hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_footer_container_action' ) ) :

 	function grace_mag_footer_container_action() {
        
        ?>
 		<div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <?php
                    //footer left area
                    if( is_active_sidebar( 'grace-mag-footer-left' ) ) {

                        dynamic_sidebar( 'grace-mag-footer-left' );
                    }
                    ?>
                </div>
                <!--col-lg-4-->
                <div class="col-12 col-lg-4">
                    <?php
                    //footer middle area
                    if( is_active_sidebar( 'grace-mag-footer-middle' ) ) {

                        dynamic_sidebar( 'grace-mag-footer-middle' );
                    }
                    ?>
                </div>
                <!--col-lg-4-->
                <div class="col-12 col-lg-4">
                    <?php
                    //footer right area
                    if( is_active_sidebar( 'grace-mag-footer-right' ) ) {

                        dynamic_sidebar( 'grace-mag-footer-right' );
                    }
                    ?>
                </div>
                <!--col-lg-4-->
            </div>
            <!--row-->
        </div>
        <?php
 	}
endif;
add_action( 'grace_mag_footer_container', 'grace_mag_footer_container_action', 10 );

/**
 * Footer copyright text hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_footer_copyright_action' ) ) :

 	function grace_mag_footer_copyright_action() {
        
        ?>
 		<div class="copy-right">
            <div class="container">
                <div class="copy-content">
                    <p>
                    <?php 
                    $footer_copyright_text = grace_mag_mod( 'copyright_text', '' );
                    if( !empty( $footer_copyright_text ) ) {
                        /* translators: 1: Copyright Text 2: Theme name, 3: Theme author. */
                        printf( esc_html__( '%1$s %2$s by %3$s','grace-mag' ), $footer_copyright_text, 'Grace Mag', '<a href="'. esc_url( 'https://everestthemes.com' ) . '">Everestthemes</a>' );
                    } else {
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf( esc_html__( '%1$s by %2$s', 'grace-mag' ), 'Grace Mag', '<a href="'. esc_url( 'https://everestthemes.com' ) . '">Everestthemes</a>' );
                    }
                    ?> 
                    </p>
                </div>
            </div>
        </div>
        <?php
 	}
endif;
add_action( 'grace_mag_footer_copyright', 'grace_mag_footer_copyright_action', 10 );

/**
 * Footer scroll top hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_footer_scroll_top_action' ) ) :

 	function grace_mag_footer_scroll_top_action() {
        
        $display_scroll_top = grace_mag_mod( 'display_scroll_top', true );
        
        if( $display_scroll_top == true ) {
        
        ?>
 		<a href="#" class="scrollup"><i class="fa fa-long-arrow-up"></i></a>
        <?php
        }
 	}
endif;
add_action( 'grace_mag_footer_scroll_top', 'grace_mag_footer_scroll_top_action', 10 );

/**
 * Sticky news hook declaration
 *
 * @since 1.0.0
 */
if( ! function_exists( 'grace_mag_sticky_news_action' ) ) :

 	function grace_mag_sticky_news_action() {

        $display_sticky_news = false;

        if( is_front_page() ) {

            $display_sticky_news = grace_mag_mod( 'display_front_sticky_news', true );
        }

        if( is_single() ) {

            $display_sticky_news = grace_mag_mod( 'display_single_sticky_news', true );
        }

        if( $display_sticky_news == true ) {

            $sticky_news_title = grace_mag_mod( 'sticky_news_title', 'Read also' );

            $display_sticky_news_category = grace_mag_mod( 'display_sticky_news_category', false );

            ?>
            <!-- start read also section -->
            <div class="read-also">
                <?php
                if( !empty( $sticky_news_title ) ) {
                ?>
                <div class="gm-also-wrap">
                    <h3 class="gm-also-tt"><?php echo esc_html( $sticky_news_title ); ?>
                        <a class="penci-close-rltpopup">x<span></span><span></span></a>
                    </h3>
                </div><!--gm-also-wrap-->
                <?php
                }

                $sticky_news_query = grace_mag_sticky_news_query();

                if( $sticky_news_query -> have_posts() ) {
                ?>
                <div class="read-also-wrap">
                    <?php

                    while( $sticky_news_query -> have_posts() ) {

                        $sticky_news_query -> the_post();

                        ?>
                        <div class="read-also-content">
                            <div class="read-img-holder">
                                <figure>
                                    <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                </figure>
                            </div><!--read-img-holder-->
                            <div class="read-also-bdy">
                                <?php grace_mag_categories_meta( $display_sticky_news_category ); ?>
                                <h3 class="sub-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                            </div>
                        </div><!--read-also-content-->
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php
                }
            ?>
            </div><!--read-also-->
            <!-- end read also section -->
            <?php
        }
 	}
endif;
add_action( 'grace_mag_sticky_news', 'grace_mag_sticky_news_action', 50 );
