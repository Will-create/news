<?php
if ( ! function_exists( 'graphene_get_header_image' ) ) :
/**
 * This function retrieves the header image for the theme
*/
function graphene_get_header_image( $post_id = NULL, $size = 'post-thumbnail', $return_url = true ){
	global $graphene_settings, $post;
	
	$header_img = '';
	
	if ( ! $post_id && isset( $post ) ) $post_id = $post->ID;
	if ( ! $post_id ) $header_img = get_header_image();

	if ( ! $header_img && is_singular() && has_post_thumbnail( $post_id ) ) {
		$image_id = get_post_thumbnail_id( $post_id );
		$image_meta = wp_get_attachment_metadata( $image_id );
		
		$header_image_width = apply_filters( 'graphene_header_image_width', graphene_grid_width( $graphene_settings['gutter_width'] * 2, 12 ) );
		if ( isset( $image_meta['width'] ) && $image_meta['width'] >= $header_image_width && ! $graphene_settings['featured_img_header'] ) {
			$image = wp_get_attachment_image_src( $image_id, $size );
			if ( $return_url ) $header_img = $image[0];
			else {
				$header_img = $image;
				$header_img['attachment_id'] = $image_id;
			}
		}
	}

	if ( ! $header_img ) $header_img = get_header_image();

	if ( ! $return_url && ! is_array( $header_img ) ) {
		if ( isset( $image ) && $image ) {

			$header_img = $image;
			if ( ini_get( 'allow_url_fopen' ) ) $dimension = getimagesize( $header_img );
			else $dimension = array( '', '' );
			
			$header_img = array( $header_img, $dimension[0], $dimension[1] );

		} else if ( $header_img ) {
			if ( $image_id = graphene_get_attachment_id_from_src( $header_img ) ) {
				$image = wp_get_attachment_image_src( $image_id, $size );
				if ( $image ) {
					$header_img = $image;
					$header_img['attachment_id'] = $image_id;
				}
			}
		}
	}
	
	return apply_filters( 'graphene_header_image', $header_img, $post_id, $size, $return_url );
}
endif;


/**
 * Get the attachment ID from the source URL
 *
 * @package Graphene
 * @since 1.9
 */
function graphene_get_attachment_id_from_src( $image_src ) {

	global $wpdb, $graphene_attachment_src_id;

	if ( ! isset( $graphene_attachment_src_id ) ) $graphene_attachment_src_id = array();

	if ( ! array_key_exists( $image_src,  $graphene_attachment_src_id ) ) {
		$query = $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid='%s' LIMIT 1", $image_src );
		$id = $wpdb->get_var( $query );
		$graphene_attachment_src_id[$image_src] = $id;
	}

	return $graphene_attachment_src_id[$image_src];
}


/**
 * Get the alt text for an attachment image
 *
 * @package Graphene
 * @since 1.9
 */
function graphene_get_attachment_image_alt( $image_src_or_id ){
	
	if ( ! is_numeric( $image_src_or_id ) ) $image_id = attachment_url_to_postid( $image_src_or_id );
	else $image_id = $image_src_or_id;

	if ( ! $image_id ) return;
	
	$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	return $alt;
}


/**
 * Get the alt text for custom header image
 */
function graphene_get_header_image_alt( $image_src_or_id ) {

	if ( ! is_numeric( $image_src_or_id ) ) $image_id = graphene_get_attachment_id_from_src( $image_src_or_id );
	else $image_id = $image_src_or_id;

	$alt = '';

    if ( $image_id ) {
        $alt = trim( strip_tags( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ) );

        // Get the parent's alt text if this is a cropped image
        if ( ! $alt ) { 

        	$header_url = wp_get_attachment_url( $image_id );
        	if ( stripos( $header_url, '/cropped-' ) !== false ) {
        		$attachment_metadata = wp_get_attachment_metadata( $image_id );
        		$alt = graphene_get_attachment_image_alt( $attachment_metadata['attachment_parent'] );
        	}
        }

        // Fallback to caption (excerpt)
        if ( ! $alt ) $alt = trim( strip_tags( get_post_field( 'post_excerpt', $image_id ) ) );
        // Fallback to title
        if ( ! $alt ) $alt = trim( strip_tags( get_post_field( 'post_title', $image_id ) ) );
    }

    return $alt;
}


/**
 * Get the HTML tag for image
 *
 * @package Graphene
 * @since 2.1
 */
function graphene_get_image_html( $image_src_or_id, $size = '', $alt = '' ){
	global $graphene_settings;
	
	if ( ! is_numeric( $image_src_or_id ) ) {
		$image_id = graphene_get_attachment_id_from_src( $image_src_or_id );

		if ( ! $image_id ) {
			if ( ! $alt ) $alt = get_bloginfo( 'name' );

			$height = '';
			$width = '';

			if ( ini_get( 'allow_url_fopen' ) ) $image_size = getimagesize( $image_src_or_id );
			else $image_size = array( '', '' );

			if ( $image_size && isset( $image_size[0] ) && isset( $image_size[1] ) ) {
				if ( $image_size[0] && is_numeric( $image_size[0] ) ) $width = $image_size[0];
				if ( $image_size[1] && is_numeric( $image_size[1] ) ) $height = $image_size[1];
			}

			$html = '<img src="' . $image_src_or_id . '" alt="' . $alt . '" title="' . $alt . '" width="' . $width . '" height="' . $height . '" />';
			return $html;
		}
	
	} else $image_id = $image_src_or_id;

	$args = array();
	if ( $alt ) {
		$args['alt'] = $alt;
		$args['title'] = $alt;
	}

	$image = wp_get_attachment_image( $image_id, $size, false, $args );
	return $image;
}


/**
 * This functions adds additional classes to the <body> element. The additional classes
 * are added by filtering the WordPress body_class() function.
*/
function graphene_body_class( $classes ){
    
	global $graphene_settings;
	
	if ( $graphene_settings['slider_full_width'] ) $classes[] = 'full-width-slider';
	if ( $graphene_settings['slider_position'] ) $classes[] = 'bottom-slider';
	if ( $graphene_settings['mobile_left_column_first'] ) $classes[] = 'left-col-first';
	$classes[] = 'layout-' . $graphene_settings['container_style'];
	
    $column_mode = graphene_column_mode();
    $classes[] = $column_mode;
    // for easier CSS
    if ( strpos( $column_mode, 'two_col' ) === 0 ){
        $classes[] = 'two-columns';
    } else if ( strpos( $column_mode, 'three_col' ) === 0 ){
        $classes[] = 'three-columns';
    }
	
	if ( has_nav_menu( 'secondary-menu' ) ) $classes[] = 'have-secondary-menu';
	if ( is_singular() ) $classes[] = 'singular';
	if ( $graphene_settings['slider_as_header'] ) $classes[] = 'header-slider';

	/* Different wrapper and content background colours */
	if ( $graphene_settings['content_wrapper_bg'] != $graphene_settings['content_bg'] ) {
		$classes[] = 'unequal-content-bgs';
	}

	/* Same wrapper and widget background colours */
	if ( $graphene_settings['content_wrapper_bg'] == $graphene_settings['widget_item_bg'] ) {
		$classes[] = 'equal-widget-bg';
	}
    
    // Prints the body class
    return $classes;
}

add_filter( 'body_class', 'graphene_body_class' );


/**
 * Add Social Media icons in top bar
*/
function graphene_social_profiles( $args = array() ) {
	$defaults = array(
		'classes'	=> array( 'social-profiles' )
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

    global $graphene_settings;

    /* Loop through the registered custom social media */
    $social_profiles = $graphene_settings['social_profiles'];
	if ( ! $social_profiles || ( is_array( $social_profiles ) && in_array( false, $social_profiles ) ) ) return;
	if ( empty( $social_profiles ) ) return;
	?>
	<ul class="<?php echo join( ' ', $classes ); ?>">
		<?php
			$count = 1;
		    foreach ( $social_profiles as $social_key => $social_profile ) : 
		        if ( ! empty( $social_profile['url'] ) || $social_profile['type'] == 'rss' ) : 
		            $title = graphene_determine_social_medium_title( $social_profile );
		            $class = 'mysocial social-' . $social_profile['type'];
					$id = 'social-id-' . $count;
		            
					$extra = $graphene_settings['social_media_new_window'] ?  ' target="_blank"' : '';
					$extra = apply_filters( 'graphene_social_media_attr', $extra, $title, $class, $id );
					
		            $url = ( $social_profile['type'] == 'rss' && empty( $social_profile['url'] ) ) ? get_bloginfo('rss2_url') : $social_profile['url'];
		            
		            $icon_url = '';
		            $icon_name = '';
		            if ( $social_profile['type'] == 'custom' ) {
						$icon_url = ( isset( $social_profile['icon_url'] ) ) ? $social_profile['icon_url'] : '';
						$icon_name = ( isset( $social_profile['icon_name'] ) ) ? $social_profile['icon_name'] : '';
		                $class = 'mysocial social-custom';
		            }
				?>
					
			            <li class="social-profile social-profile-<?php echo $social_profile['type']; ?>">
			            	<a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $title ); ?>" id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>"<?php echo $extra; ?>>
			            		<?php if ( $social_profile['type'] == 'custom' ) : ?>
	                        		<?php if ( isset( $social_profile['icon_name'] ) && $social_profile['icon_name'] ) : ?>
	                        			<i class="fa fa-<?php echo $social_profile['icon_name']; ?>"></i>
	                        		<?php else : ?>
		                            	<img class="mysocial-icon" src="<?php echo $social_profile['icon_url']; ?>" alt="" />
		                            <?php endif; ?>
		                        <?php else : ?>
		                            <i class="fa fa-<?php echo $social_profile['type']; ?>"></i>
		                        <?php endif; ?>
			            	</a>
			            </li>
		            
		    	<?php endif; $count++;
		    endforeach;
	    ?>
    </ul>
    <?php
}


/**
 * Backward compat
 */
function graphene_top_bar_social(){
	graphene_social_profiles();
}

/**

 * Determine the title for the social medium.
 * @param array $social_medium
 * @return string 
 */
function graphene_determine_social_medium_title( $social_medium ) {
    if ( isset( $social_medium['title'] ) && ! empty( $social_medium['title']) ) {
        return esc_attr( $social_medium['title'] );
    } else {
        /* translators: %1$s is the website's name, %2$s is the social media name */
        return sprintf( esc_attr__( 'Visit %1$s\'s %2$s page', 'graphene' ), get_bloginfo( 'name' ), ucfirst( $social_medium['type'] ) );
    }
}


/**
 * Returns the width in pixels for the specified grid number
 *
 * @param int $mod Optional Width in pixels to add/subtract from the calculated grid width
 * @param int $grid_one Grid number for 1 column layout
 * @param int $grid_two Grid number for 2 column layout
 * @param int $grid_three Grid number for 3 column layout
 * @return int Grid width in pixels
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_grid_width( $mod = '', $grid_one = 1, $grid_two = '', $grid_three = '', $post_id = NULL ){
	$grid_two = ( ! $grid_two ) ? $grid_one : $grid_two ;
	$grid_three = ( ! $grid_three ) ? $grid_one : $grid_three ;
	
	global $graphene_settings;
	$container_width = $graphene_settings['container_width'];
	$grid_width = 1.0 / 12;
	$gutter_width = $graphene_settings['gutter_width'] * 2;
	$column_mode = graphene_column_mode( $post_id );
	
	$width = $grid_width;
	
	if ( strpos( $column_mode, 'one_col' ) === 0 && is_numeric( $grid_one ) )
		$width = $grid_width * $grid_one * $container_width - $gutter_width;
	if ( strpos( $column_mode, 'two_col' ) === 0 && is_numeric( $grid_two ) )
		$width = $grid_width * $grid_two * $container_width - $gutter_width;
	if ( strpos( $column_mode, 'three_col' ) === 0 && is_numeric( $grid_three ) )
		$width = $grid_width * $grid_three * $container_width - $gutter_width;
		
	if ( $mod )	$width += $mod;
	if ( $width < 0 ) $width = 0;
		
	return apply_filters( 'graphene_grid_width', $width, $mod, $grid_one, $grid_two, $grid_three );
}


/**
 * Returns the Bootstrap grid system classes.
 *
 * @param string $classes Optional additional classes
 * @param int $grid_one Grid number for 1 column layout
 * @param int $grid_two Grid number for 2 column layout
 * @param int $grid_three Grid number for 3 column layout
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_get_grid( $classes = '', $grid_one = 12, $grid_two = '', $grid_three = '' ){
	
	$grid_two = ( ! $grid_two ) ? $grid_one : $grid_two ;
	$grid_three = ( ! $grid_three ) ? $grid_one : $grid_three ;
	
	$column_mode = graphene_column_mode();
	
	$grid = array();
	
	if ( $classes ) $grid = array_merge( $grid, explode( ' ', trim( $classes ) ) );
	
	if ( strpos( $column_mode, 'one_col' ) === 0 )
		$grid[] = sprintf( 'col-md-%d', $grid_one );
	if ( strpos( $column_mode, 'two_col' ) === 0 )
		$grid[] = sprintf( 'col-md-%d', $grid_two );
	if ( strpos( $column_mode, 'three_col' ) === 0 )
		$grid[] = sprintf( 'col-md-%d', $grid_three );

	/* Additional classes for sidebar modes */
	global $graphene_settings;

	if ( ! $graphene_settings['mobile_left_column_first'] ) {
		if ( $column_mode == 'two_col_right' ) {
			if ( stripos( $classes, 'sidebar' ) !== false ) $grid[] =  sprintf( 'col-md-pull-%d', $graphene_settings['column_width']['two_col']['content'] );
			if ( stripos( $classes, 'content-main' ) !== false ) $grid[] =  sprintf( 'col-md-push-%d', $graphene_settings['column_width']['two_col']['sidebar'] );
		}

		if ( $column_mode == 'three_col_right' ) {
			if ( stripos( $classes, 'sidebar' ) !== false ) $grid[] =  sprintf( 'col-md-pull-%d', $graphene_settings['column_width']['three_col']['content'] );
			if ( stripos( $classes, 'content-main' ) !== false ) $grid[] =  sprintf( 'col-md-push-%d', $graphene_settings['column_width']['three_col']['sidebar_left'] + $graphene_settings['column_width']['three_col']['sidebar_right'] );
		}

		if ( $column_mode == 'three_col_center' ) {
			if ( stripos( $classes, 'sidebar-left' ) !== false ) $grid[] =  sprintf( 'col-md-pull-%d', $graphene_settings['column_width']['three_col']['content'] );
			if ( stripos( $classes, 'content-main' ) !== false ) $grid[] =  sprintf( 'col-md-push-%d', $graphene_settings['column_width']['three_col']['sidebar_left'] );
		}
	}
	
	return apply_filters( 'graphene_grid', $grid, $classes, $grid_one, $grid_two, $grid_three );
}

/**
 * Prints the 960 grid system classes
 *
 * @param string $classes Optional additional classes
 * @param int $grid_one grid number for 1 column layout
 * @param int $grid_two grid number for 2 column layout
 * @param int $grid_three grid number for 3 column layout
 * @param bool $alpha switch for the alpha class
 * @param bool $omega switch for the omega class
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_grid( $classes = '', $grid_one = 1, $grid_two = '', $grid_three = '' ){
	// Separates classes with a single space	
	echo 'class="' . implode( ' ', graphene_get_grid( $classes, $grid_one, $grid_two, $grid_three ) ) . '"';
}

if ( ! function_exists( 'graphene_get_avatar_uri' ) ) :
/**
 * Retrieve the avatar URL for a user who provided a user ID or email address.
 *
 * @uses WordPress' get_avatar() function, except that it
 * returns the URL to the gravatar image only, without the <img> tag.
 *
 * @param int|string|object $id_or_email A user ID,  email address, or comment object
 * @param int $size Size of the avatar image
 * @param string $default URL to a default image to use if no avatar is available
 * @param string $alt Alternate text to use in image tag. Defaults to blank
 * @return string URL for the user's avatar
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_get_avatar_uri( $id_or_email, $size = '96', $default = '', $alt = false ) {
	
	// Silently fails if < PHP 5
	if ( ! function_exists( 'simplexml_load_string' ) ) return;
	
	$avatar = get_avatar( $id_or_email, $size, $default, $alt );
	if ( ! $avatar ) return false;
	
	$avatar_xml = simplexml_load_string( $avatar );
	$attr = $avatar_xml->attributes();
	$src = $attr['src'];

	return apply_filters( 'graphene_get_avatar_url', $src, $id_or_email, $size, $default, $alt );
}
endif;


function graphene_feed_link($output, $feed) {
    global $graphene_settings;
    
    if ( ( $feed == 'rss2' || $feed == 'rss' ) 
            && $graphene_settings['use_custom_rss_feed'] && ! empty( $graphene_settings['custom_rss_feed_url'] ) ) {
        $output = $graphene_settings['custom_rss_feed_url'];    
    }
    return $output;
}
add_filter( 'feed_link', 'graphene_feed_link', 1, 2 );


/**
 * Displays a notice to logged in users if there is no widgets placed in the displayed sidebars
 */
function graphene_sidebar_notice( $sidebar_name = '' ){
	$html = '<p>';
	$html .= sprintf( __( 'You haven\'t placed any widget into this widget area. Go to %1$s and place some widgets in the widget area called %2$s.', 'graphene' ), '<em>' . __( 'WP Admin > Appearance > Widgets', 'graphene' ) . '</em>', '<strong>' . $sidebar_name . '</strong>' ) . '</p>';
	$html .= '<p>' . __( "This notice will not be displayed to your site's visitors.", 'graphene' ) . '</p>';
	echo '<div class="alert alert-warning" role="alert">' . apply_filters( 'graphene_sidebar_notice', $html, $sidebar_name ) . '</div>';
}


/**
 * Apply the correct column mode for static posts page as per its page template
 *
 * @package Graphene
 * @since 1.9
 */
function graphene_posts_page_column(){
	if ( ! is_home() ) return;
	
	$home_page = get_option( 'page_for_posts' );
	if ( ! $home_page ) return;
	
	$template = get_post_meta( $home_page, '_wp_page_template', true );
	if ( ! $template || $template == 'default' ) return;
	
	global $graphene_settings;
	switch ( $template ) {
		case 'template-onecolumn.php': $graphene_settings['column_mode'] = 'one_column'; break;
		case 'template-twocolumnsleft.php': $graphene_settings['column_mode'] = 'two_col_left'; break;
		case 'template-twocolumnsright.php': $graphene_settings['column_mode'] = 'two_col_right'; break;
		case 'template-threecolumnsleft.php': $graphene_settings['column_mode'] = 'three_col_left'; break;
		case 'template-threecolumnscenter.php': $graphene_settings['column_mode'] = 'three_col_center'; break;
		case 'template-threecolumnsright.php': $graphene_settings['column_mode'] = 'three_col_right'; break;
	}
}
add_action( 'template_redirect', 'graphene_posts_page_column' );


/**
 * Add the necessary wrapper for full-width boxed layout
 */
function graphene_container_wrapper( $part = 'start' ) {
	global $graphene_settings;
	if ( $graphene_settings['container_style'] != 'full-width-boxed' ) return;

	if ( $part == 'start' ) echo '<div class="container container-full-width-boxed">';
	if ( $part == 'end' ) echo '</div>';
}