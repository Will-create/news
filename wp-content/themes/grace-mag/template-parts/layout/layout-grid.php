<?php

/**
 * The template for Grid Layouot
 *
 * @package Grace_Mag
 */

$sidebar_position = grace_mag_sidebar_position();
?>
<div id="content" class="site-content category-page">
    <?php
    
    if( is_archive() || is_search() ) {
        $background_image_url = '';
        
        $display_breadcrumb_image = grace_mag_breadcrumb_image_option();

        if( $display_breadcrumb_image == true ) {

            $background_image_url = grace_mag_mod( 'common_page_background_image', '' );

        }
        ?>
        <div class="inner-banner<?php grace_mag_has_image_class( $background_image_url ); ?>"<?php grace_mag_has_image_url( $background_image_url ); ?>>
            <div class="container">
                <div class="gm-inner-caption">
                    <?php
                    if( is_archive() ) {

                        the_archive_title( '<h1 class="primary-tt">', '</h1>' );
                    }

                    if( is_search() ) {

                        ?>
                        <h1 class="primary-tt">
                            <?php
                            /* translators: %s: search query. */
                            printf( esc_html__( 'Search Results for: %s', 'grace-mag' ), get_search_query() );
                            ?>
                        </h1>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!--inner-banner-->
        <?php
    
    grace_mag_breadcrumb();
        
    }
    ?>
    <div class="cate-page-content-layout1">
        <div class="container">
            <div class="row">
                <?php
                
                if( $sidebar_position == 'left' && is_active_sidebar( 'grace-mag-sidebar' ) ) {
                    
                    get_sidebar();
                }
                
                ?>
                <div class="<?php grace_mag_main_container_class(); ?>">
                    <div class="title-sec green">
                        <?php
                        if( is_archive() ) {

                            the_archive_title( '<h2 class="md-title">', '</h2>' );
                        }
                        
                        if( is_home() ) {
                            ?>
                            <h2 class="md-title"><?php echo esc_html__( 'Blog Page', 'grace-mag' ); ?></h2>
                            <?php
                        }
                        
                        if( is_search() ) {
                            ?>
                            <h2 class="md-title"><?php echo esc_html__( 'Search Results', 'grace-mag' ); ?></h2>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                    <?php

                    if( have_posts() ) :

                    /* Start the Loop */
                        while ( have_posts() ) :

                            the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */

                            get_template_part( 'template-parts/content', 'grid' );
                            

                        endwhile;

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif;

                    ?>
                    </div>
                    <!--inner-row-->
                    <?php grace_mag_pagination(); ?>
                </div><!--col-lg-8-->
                <?php
                
                if( $sidebar_position == 'right' && is_active_sidebar( 'grace-mag-sidebar' ) ) {
                    
                    get_sidebar();
                }
                
                ?>
            </div><!--container-->
        </div>
    </div>
</div> <!-- category-page-->
