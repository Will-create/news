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

$display_post_tags = grace_mag_post_tags_option();

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-layout1-content">
        <h1 class="single-title"><?php the_title(); ?></h1>
        <?php grace_mag_post_thumbnail(); ?>
        <div class="post-layout1-bdy">
            <div class="meta">
                <?php grace_mag_categories_meta( $display_post_category ); ?>
                <?php grace_mag_posted_on( $display_posted_time ); ?>
                <?php grace_mag_comments_no( $display_comment_no ); ?>
            </div><!--meta-->
            <div class="sigle-post-content-area">
                <?php

                the_content();

                grace_mag_pages_links();

                if ( get_edit_post_link() ) :

                    edit_post_link(
                        sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Edit <span class="screen-reader-text">%s</span>', 'grace-mag' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                endif;
                ?>
            </div><!--single-post-content-area-->
        </div><!--post-layout1-bdy-->

        <?php
        
        grace_mag_tags_meta( $display_post_tags );

        grace_mag_post_navigation();

        get_template_part( 'template-parts/content', 'author' );

        get_template_part( 'template-parts/content', 'related' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        ?>
    </div><!--post-layout1-content-->

</article>


