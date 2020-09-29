<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Grace_Mag
 */

$display_post_category = grace_mag_post_category();

$display_posted_time = grace_mag_posted_time_option();

$display_comment_no = grace_mag_comment_no_option();

?>

<div class="<?php grace_mag_layout_container_class(); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="cate-layout1-bdy">
            <?php if( has_post_thumbnail() ) { ?>
            <div class="cage-pg-img-holder">
                <?php grace_mag_post_thumbnail(); ?>
            </div>
            <?php } ?>
            <div class="cate-layout1-bdy-detail">                                  
                <div class="meta">
                    <?php grace_mag_categories_meta( $display_post_category ); ?>
                    <?php grace_mag_posted_on( $display_posted_time ); ?>
                    <?php grace_mag_comments_no( $display_comment_no ); ?>
                </div>
                <!--meta-->
                <h3 class="sm-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
            </div>
        </div>
    <!--cate-layout1-bdy -->
    </article>
</div>
<!--col-lg-6-->
<?php
