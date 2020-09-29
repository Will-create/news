<?php 
/**
 * Adds the content panes in the homepage. The homepage panes are only displayed if using a static
 * front page, before the comments. It is also recommended that the comments section is disabled 
 * for the page used as the static front page.
*/
function graphene_homepage_panes(){
	global $graphene_settings, $graphene_defaults, $in_homepage_panes;
	$in_homepage_panes = true;
	
	// Get the number of panes to display
	if ( $graphene_settings['show_post_type'] == 'latest-posts' || $graphene_settings['show_post_type'] == 'cat-latest-posts' ){
		$pane_count = $graphene_settings['homepage_panes_count'];
	} elseif ( $graphene_settings['show_post_type'] == 'posts' ) {
		$pane_count = count( explode( ',', $graphene_settings['homepage_panes_posts'] ) );
	}
	
	// Build the common WP_Query() parameter first
	$args = array( 
		'orderby' 				=> 'date',
		'order' 				=> 'DESC',
		'post_type' 			=> array( 'post', 'page' ),
		'posts_per_page'		=> $pane_count,
		'ignore_sticky_posts' 	=> 1,
	);
	
	// args specific to latest posts
	if ( $graphene_settings['show_post_type'] == 'latest-posts' ) $args['post_type'] = array( 'post' );
	
	// args specific to latest posts by category
	if ( $graphene_settings['homepage_panes_cat'] ) $args['category__in'] = graphene_object_id( $graphene_settings['homepage_panes_cat'], 'category' );
	
	// args specific to posts/pages
	if ( $graphene_settings['show_post_type'] == 'posts' ){
		
         $post_ids = $graphene_settings['homepage_panes_posts'];
         $post_ids = preg_split("/[\s]*[,][\s]*/", $post_ids, -1, PREG_SPLIT_NO_EMPTY); // post_ids are comma seperated, the query needs a array     
		 $post_ids = graphene_object_id( $post_ids );

		 $args['post__in'] = $post_ids;
		 $args['orderby'] = 'post__in';
	}
	
	// Get the posts to display as homepage panes
	$panes = new WP_Query( apply_filters( 'graphene_homepage_panes_args', $args ) );
	$count = 0;

	do_action( 'graphene_before_homepage_panes' );
	?>
    
    <div class="homepage_panes row">
	
	<?php while ( $panes->have_posts() ) : $panes->the_post(); $count++; $post_id = get_the_ID(); ?>
		<div class="homepage-pane-wrap col-sm-6">
			<div class="homepage_pane" id="homepage-pane-<?php echo $post_id; ?>">
	        	<?php
	        		do_action( 'graphene_homepage_pane_top' );

	        		/* Get the post's image */ 
					if ( has_post_thumbnail( $post_id ) ){
						$image = get_the_post_thumbnail( $post_id, 'graphene-homepage-pane' );
						$image = '<a href="' . get_permalink( $post_id ) . '">' . $image . '</a>';
					} else {
						$image = graphene_get_post_image( $post_id, 'graphene-homepage-pane', 'excerpt' );
					}

					if ( $image ) echo apply_filters( 'graphene_homepage_pane_image', $image, $post_id );
				?>
	            
	            <div class="pane-content">

		            <?php /* The post title */ ?>
		            <h3 class="post-title">
		            	<a href="<?php echo get_permalink( $post_id ); ?>" title="<?php printf( __( 'Permalink to %s', 'graphene' ), esc_attr( get_the_title( $post_id ) ) ); ?>"><?php echo get_the_title( $post_id ); ?></a>
		                <?php do_action( 'homepage_pane_title' ); ?>
		            </h3>
		            
		            <?php /* The post excerpt */ ?>
		            <div class="post-excerpt entry-content">
		            	<?php 
							the_excerpt();
							
							do_action( 'graphene_homepage_pane_content' );
						?>
		            </div>
		            
		            <?php /* Read more button */ ?>
		            <p class="post-comments">
		            	<a href="<?php echo get_permalink( $post_id ); ?>" title="<?php printf( __( 'Permalink to %s', 'graphene' ), esc_attr( get_the_title( $post_id ) ) ); ?>" class="btn"><?php _e( 'Read more', 'graphene' ); ?></a>
		            </p>

	            </div>
	            
	            <?php do_action( 'graphene_homepage_pane_bottom' ); ?>
	            
	        </div>
	    </div>
    <?php endwhile; wp_reset_postdata(); ?>
	</div>
	
	<?php
	do_action( 'graphene_after_homepage_panes' );
	unset( $in_homepage_panes );
}

/* Helper function to control when the homepage panes should be displayed. */
function graphene_display_homepage_panes(){
	global $graphene_settings;

	if ( $graphene_settings['disable_homepage_panes'] ) return;
	if ( ! is_front_page() ) return;
	if ( get_option( 'show_on_front' ) != 'page' ) return;
	if ( graphene_has_custom_layout() ) return;

	graphene_homepage_panes();
}
add_action( 'graphene_bottom_content', 'graphene_display_homepage_panes' );