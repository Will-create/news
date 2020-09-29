<?php
/**
 *
 * Template Name: Homepage Template
 * Template Post Type: page
 */

get_header();

grace_mag_banner_template();
?>

<div id="content" class="site-content"> 

<?php

//fullwidth top news area
if( is_active_sidebar( 'grace-mag-fullwidth-top-news-area' ) ) {

    dynamic_sidebar( 'grace-mag-fullwidth-top-news-area' );
}

//halfwidth and sidebar active
if( is_active_sidebar( 'grace-mag-middle-news-area' ) || is_active_sidebar( 'grace-mag-sidebar' ) ) {

?>  
    <div class="half-widget">
        <div class="container">
            <div class="row">
                <?php
    
                $sticky_class = '';
                
                $sticky_enabled = grace_mag_mod( 'enable_sticky_sidebar', true );
    
                if( $sticky_enabled == true ) {
                    
                    $sticky_class = ' sticky-portion';
                }
    
                ?>
                <div class="col-12 col-md-8 col-lg-9 left_post_area<?php echo esc_attr( $sticky_class ); ?>">
                    <?php
                    //halfwidget news area
                    if( is_active_sidebar( 'grace-mag-middle-news-area' ) ) {
                        
                        dynamic_sidebar( 'grace-mag-middle-news-area' );
                    }
                    ?>
                </div>
                <!--col-lg-9-->
                <div class="col-12 col-md-4 col-lg-3 right_post_area<?php echo esc_attr( $sticky_class ); ?>">
                    <?php
                    //sidebar area
                    if( is_active_sidebar( 'grace-mag-sidebar' ) ) {
                        
                        dynamic_sidebar( 'grace-mag-sidebar' );
                    }
                    ?>
                </div>
                <!--side-bar col-3-->
            </div>
            <!--row-->
        </div>
        <!--contaner-->
    </div>
 <!--half widget-->
 
<?php
    
}

//fullwidth bottom news area
if( is_active_sidebar( 'grace-mag-fullwidth-bottom-news-area' ) ) {

    dynamic_sidebar( 'grace-mag-fullwidth-bottom-news-area' );
}
?> 
</div>
<?php

get_footer();
