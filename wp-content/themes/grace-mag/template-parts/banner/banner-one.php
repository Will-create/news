<?php

/**
 * The template for banner one
 *
 * @package Grace_Mag
 */

$banner_query = grace_mag_banner_posts_query();
if( $banner_query -> have_posts() ) {

$banner_bg_image = grace_mag_mod( 'banner_bg_image', '' );
?>
<!--Banner section-->
<div class="banner-slider lrg-padding"<?php grace_mag_has_image_url( $banner_bg_image ); ?>>
    <div class="container">
        <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="main-slider">
                        <?php

                        $count = 1;

                        while( $banner_query -> have_posts() ) {

                            $banner_query -> the_post();

                            if( $count == 1 || $count > 3 ) {

                            $banner_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            ?>
                            <div class="slides"<?php grace_mag_has_image_url( $banner_image_url ); ?>>
                                <div class="slider-caption">
                                    <h1 class="l-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                    <div class="meta">
                                        <?php grace_mag_posted_on( true ); ?>
                                        <?php grace_mag_comments_no( true ); ?>
                                    </div>
                                </div>
                            </div><!-- slides -->
                            <?php
                            }
                            $count++;
                        }
                        wp_reset_postdata();
                        ?>
                    </div> <!-- main-slider -->
                </div><!-- col-lg-6 -->
                <div class="col-12 col-lg-4">
                <?php

                $count = 1;

                while( $banner_query -> have_posts() ) {

                        $banner_query -> the_post();

                        if( $count > 1 && $count <= 3 ) {

                        $banner_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        ?>
                        <div class="slide-related-post"<?php grace_mag_has_image_url( $banner_image_url ); ?>>
                            <div class="slider-caption">
                                <h2 class="l-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="meta">
                                    <?php grace_mag_posted_on( true ); ?>
                                    <?php grace_mag_comments_no( true ); ?>
                                </div>
                            </div>
                        </div><!-- slides -->
                        <?php
                        }
                        $count++;
                    }
                    wp_reset_postdata();
                    ?>
            </div>
        </div>
    </div>
</div><!-- slider area -->

<?php
}