<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Grace_Mag
 */

get_header();

$sidebar_position = grace_mag_sidebar_position();

$display_breadcrumb_image = grace_mag_breadcrumb_image_option();

$background_image_url = '';

if( $display_breadcrumb_image == true ) {

    $background_image_url = grace_mag_mod( 'common_page_background_image', '' );

    if( !empty( $background_image_url ) ) {
        ?>
        <div class="inner-banner<?php grace_mag_has_image_class( $background_image_url ); ?>"<?php grace_mag_has_image_url( $background_image_url ); ?>></div>
        <?php
    }
}
?>
<div id="content" class="site-content sigle-post">
    <?php grace_mag_breadcrumb(); ?>
    <div class="container">
        <div class="single-post-layout1">
            <div class="row">
                <?php
                
                if( $sidebar_position == 'left' && is_active_sidebar( 'grace-mag-sidebar' ) ) {
                    
                    get_sidebar();
                }
                
                ?>
                <div class="<?php grace_mag_main_container_class(); ?>">
                    <?php
                    if( have_posts() ) :

                        while( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', get_post_type() );

                        endwhile;

                    else :

                        get_template_part( 'template-parts/content', 'none' );

                    endif;
                    ?>
                </div><!--col-lg-8-->
                <?php
                
                if( $sidebar_position == 'right' && is_active_sidebar( 'grace-mag-sidebar' ) ) {
                    
                    get_sidebar();
                }
                
                ?>
            </div><!--single-post-layout1-->
        </div><!--container-->
    </div> <!--not found page-->
</div>

<?php
get_footer();
