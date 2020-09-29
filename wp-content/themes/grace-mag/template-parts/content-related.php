<?php
/**
 * Template part for displaying related posts
 *
 * @package Grace_Mag
 */

$display_related_posts_section = grace_mag_mod( 'post_single_display_related_posts_section', true );

if( $display_related_posts_section == true ) {
    
    $related_posts_post_number = grace_mag_mod( 'post_single_related_posts_post_number', 3 );

    $related_posts_query_args = array(
        'no_found_rows'       => true,
        'ignore_sticky_posts' => true,
    );

    if( absint( $related_posts_post_number ) > 0 ) {
        $related_posts_query_args['posts_per_page'] = absint( $related_posts_post_number );
    } else {
        $related_posts_query_args['posts_per_page'] = 3;
    }

    $current_object = get_queried_object();

    if ( $current_object instanceof WP_Post ) {

        $current_id = $current_object->ID;

        if ( absint( $current_id ) > 0 ) {

            // Exclude current post.
            $related_posts_query_args['post__not_in'] = array( absint( $current_id ) );

            // Include current posts categories.
            $categories = wp_get_post_categories( $current_id );

            if ( ! empty( $categories ) ) {

                $related_posts_query_args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $categories,
                        'operator' => 'IN',
                    )
                );
            }
        }
    }

    $related_posts_query = new WP_Query( $related_posts_query_args );
    
    if( $related_posts_query->have_posts() ) :
    
        $related_posts_section_title = grace_mag_mod( 'post_single_related_posts_section_title', esc_html__( 'Related Posts', 'grace-mag' ) );

        $display_related_posted_date = grace_mag_mod( 'post_single_display_related_posted_date', true );
    
        $display_related_posts_comment_number = grace_mag_mod( 'post_single_display_related_posts_comment_number', true );
        
        ?>
        <div class="single-post-related-news">
            <?php
            if( !empty( $related_posts_section_title ) ) {
            ?>
            <div class="title-sec green">
            <h2 class="md-title"><?php echo esc_html( $related_posts_section_title ); ?></h2>
            </div>
            <?php
            }
            ?>
            <ul class="single-post-items">
                <?php
                while( $related_posts_query->have_posts() ) :

                    $related_posts_query->the_post();
                    ?>
                    <li>
                        <?php
                        if( has_post_thumbnail() ) {
                        ?>
                        <figure>
                            <?php the_post_thumbnail( 'grace-mag-thumbnail-two', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                        </figure>
                        <?php
                        }
                        ?>
                        <div class="meta">
                            <?php grace_mag_posted_on( $display_related_posted_date ); ?>
                            <?php grace_mag_comments_no( $display_related_posts_comment_number ); ?>
                        </div>
                        <h4 class="sub-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
        </div>
        <?php
    endif;
}