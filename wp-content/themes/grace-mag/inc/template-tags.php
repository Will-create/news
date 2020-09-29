<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Grace_Mag
 */

if ( ! function_exists( 'grace_mag_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function grace_mag_posted_on( $display_meta ) {
        
        if( $display_meta == true ) {
        
            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );
            
            echo '<span class="posted-date"><em class="meta-icon"><i class="fa fa-clock-o"> </i></em><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.
        }
	}
endif;

if ( ! function_exists( 'grace_mag_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function grace_mag_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'grace-mag' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'grace_mag_comments_no' ) ) :
	/**
	 * Prints HTML with meta information for no of comments.
	 */
	function grace_mag_comments_no( $display_meta ) {

		if( $display_meta == true ) {

        	if( ( comments_open() || get_comments_number() ) ) {
        		?>
        		<span class="comments">
                    <em class="meta-icon">
                        <i class="fa fa-comment"></i>
                    </em>
                    <a href="<?php the_permalink(); ?>">
                    <?php echo esc_html( absint( get_comments_number() ) ); ?>
                    </a>
                </span>
	          	<?php
	        }
	    }
	}
endif;

if( ! function_exists( 'grace_mag_categories_meta' ) ) :
	/*
	 * Prints HTML with meta information for post categories.
	 */
	function grace_mag_categories_meta( $display_meta ) {

		if( $display_meta == true ) {

			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list();

				if ( $categories_list ) {
					echo '<div class="gm-sub-cate"> <small>' . wp_kses_post( $categories_list ) . '</small> </div>'; // WPCS: XSS OK.
				}
			}
		}
	}
endif;

if ( ! function_exists( 'grace_mag_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function grace_mag_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'grace-mag' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'grace-mag' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'grace-mag' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'grace-mag' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'grace-mag' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'grace_mag_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function grace_mag_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
        
            if( is_page() ) {
                $display_featured_image = grace_mag_mod( 'page_single_display_featured_image', true );
            }
            
            if( is_single() ) {
                $display_featured_image = grace_mag_mod( 'post_single_display_featured_image', true );
            }
            
            if( $display_featured_image == true ) {
			?>
            
			<figure>
				<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</figure><!-- // thumb featured-image -->

		<?php
            }
        
        } else {

		$display_featured_image = true;
            
            if( is_home() ) {
                $display_featured_image = grace_mag_mod( 'blog_page_display_featured_image', true );
            }
            
            if( is_archive() ) {
                $display_featured_image = grace_mag_mod( 'archive_page_display_featured_image', true );
            }
            
            if( is_search() ) {
                $display_featured_image = grace_mag_mod( 'search_page_display_featured_image', true );
            }
            
            if( $display_featured_image == true ) {    
            ?>
            <figure class="img-hover">
                <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
            </figure><!-- // thumb -->

		<?php
            }
        } // End is_singular().
	}
endif;

if( ! function_exists( 'grace_mag_tags_meta' ) ) :
	/*
	 * Prints HTML with meta information for post categories.
	 */
	function grace_mag_tags_meta( $display_meta ) {

		if( $display_meta == true  ) {

			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();

				if ( $tags_list ) {
					echo '<div class="entry-tags"><div class="post-tags">' . wp_kses_post( $tags_list ) . '</div></div>'; // WPCS: XSS OK.
				}
			}
		}
	}
endif;

if ( ! function_exists( 'grace_mag_has_image_class' ) ) :
	/*
	 * Prints class if post has thumbnail
	 */
	function grace_mag_has_image_class( $post_image ) {
        
        $image_class = '';
		
		if( !empty( $post_image ) ) {
            
            $image_class = ' has-background-img';
        } else {
            
            $image_class = '';
        }
        
        echo esc_attr( $image_class );
	}
endif;

if ( ! function_exists( 'grace_mag_has_image_url' ) ) :
	/*
	 * Prints style background image if post has thumbnail
	 */
	function grace_mag_has_image_url( $post_image_url ) {
        
        $bg_image_style = '';
		
		if( !empty( $post_image_url ) ) {
            
            $post_image_url = esc_url( $post_image_url );
            
            $bg_image_style = ' style="background-image: url(' . $post_image_url . ');"';
          
        } else {
            
            $bg_image_style = '';
        }
        
        echo $bg_image_style;
	}
endif;