<?php
/**
 * Convert a hex decimal color code to its RGB equivalent and vice versa
 */                                                                                                
function graphene_rgb2hex( $c ){
   if ( ! $c ) return false;
   $c = trim( $c );
   $out = false;
  if(preg_match("/^[0-9ABCDEFabcdef\#]+$/i", $c) ){
      $c = str_replace( '#','', $c);
      $l = strlen( $c) == 3 ? 1 : (strlen( $c) == 6 ? 2 : false);

      if( $l){
         unset( $out);
         $out['red'] = hexdec(substr( $c, 0,1*$l) );
         $out['green'] = hexdec(substr( $c, 1*$l,1*$l) );
         $out['blue'] = hexdec(substr( $c, 2*$l,1*$l) );
      }else $out = false;
             
   }elseif (preg_match("/^[0-9]+(,| |.)+[0-9]+(,| |.)+[0-9]+$/i", $c) ){
      $spr = str_replace(array( ',',' ','.' ), ':', $c);
      $e = explode(":", $spr);
      if(count( $e) != 3) return false;
         $out = '#';
         for( $i = 0; $i<3; $i++)
            $e[$i] = dechex( ( $e[$i] <= 0)?0:( ( $e[$i] >= 255)?255:$e[$i]) );
             
         for( $i = 0; $i<3; $i++)
            $out .= ( (strlen( $e[$i]) < 2)?'0':'' ).$e[$i];
                 
         $out = strtoupper( $out);
   }else $out = false;
         
   return $out;
}


/**
 * Perform adding (or subtracting) operation on a hexadecimal colour code
*/
function graphene_hex_addition( $hex, $num ){
	$rgb = graphene_rgb2hex( $hex );
	if ( ! $rgb ) return $hex;
	
	foreach ( $rgb as $key => $val ) {
		$rgb[$key] += $num;
		$rgb[$key] = ( $rgb[$key] < 0 ) ? 0 : $rgb[$key];
	}
	$hex = graphene_rgb2hex( implode( ',', $rgb ) );
	
	return $hex;
}


/**
 * Gets all action hooks available in the Graphene theme.
 * @param boolean $hooksonly
 * @return array 
 */
function graphene_get_action_hooks( $hooksonly = false ) {    

	if ( isset( $_GET['rescan_hooks'] ) && $_GET['rescan_hooks'] == 'true' ){
		delete_transient( 'graphene-action-hooks-list' );
		delete_transient( 'graphene-action-hooks' );
	}
	
	// Get the cached action hooks list, if available
	if ( $hooksonly )
		$hooks = get_transient( 'graphene-action-hooks-list' );
	else
		$hooks = get_transient( 'graphene-action-hooks' );
		
	if ( $hooks ) 
		return $hooks;
	else
		$hooks = array();
	
    // as all the hooks are defined in php files get a list of the themes php files
    $files = @glob( get_template_directory() . "/*.php" );
	$files = array_merge( $files, @glob( get_template_directory() . "/inc/*.php" ) );

    if ( $files !== false ) {
        foreach ( $files as $file ) {

            // read the file and scan it's contents for do_action();
            $content = file( $file );
			$content = implode( '', $content );
			
            if ($content !== false) {
                if (preg_match_all("/do_action\([ ]*'(graphene_[^']*)'[ ]*\)/", $content, $matches) > 0) {
					$matches = array_unique( $matches[1] );
                    if ( $hooksonly ){ $hooks = array_merge( $hooks, $matches ); }
                    else {
						$filename = basename( $file );
						if ( stripos( $file, 'inc/' ) !== false ) { $filename = 'inc/' . $filename; }
						$hooks[] = array( 'file' => $filename, 'hooks' => $matches );
					}
                }                                
            }
        }
    }
	
	// Cache the found action hooks as WordPress transients
	if ( $hooksonly )
		set_transient( 'graphene-action-hooks-list', $hooks, 60*60*24 );
	else
		set_transient( 'graphene-action-hooks', $hooks, 60*60*24 );
		
    return $hooks;
}


/**
 * Prints out the content of a variable wrapped in <pre> elements.
 * For development and debugging use
*/
if ( ! function_exists( 'disect_it' ) ) :
function disect_it( $var = NULL, $exit = true, $comment = false ){
	
	if ( $comment ) {echo '<!--';}
	
	if ( $var !== NULL ){
		echo '<pre>';
		var_dump( $var );
		echo '</pre>';
	} else {
		echo '<strong>ERROR:</strong> You must pass a variable as argument to the <code>disect_it()</code> function.';
	}
	
	if ( $comment ) {echo '-->';}
	if ( $exit ) {exit();}
}
endif;


function graphene_print_only_text( $text ){
    return sprintf( '<p class="printonly">%s</p>', $text );
}


if ( ! function_exists( 'graphene_substr' ) ) :
/**
 * Truncate a string by specified length
*/
function graphene_substr( $string, $start = 0, $length = '', $suffix = '' ){
	
	if ( $length == '' ) return $string;
	
	if ( strlen( $string ) > $length ) {
		$trunc_string = substr( $string, $start, $length ) . $suffix;
	} else {
		$trunc_string = $string;	
	}
	return apply_filters( 'graphene_substr', $trunc_string, $string, $start, $length, $suffix );
}
endif;


if ( ! function_exists( 'graphene_truncate_words' ) ) :
/**
 * Truncate a string by specified word count
 *
 * @param string $string The string to be truncated
 * @param int $word_count The number of words to keep
 * @param string $suffix Optional, string to be appended to truncated string
 * @return string $trunc_string The truncated string
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_truncate_words( $string, $word_count, $suffix = '...' ){
   $string_array = explode( ' ', $string );
   $trunc_string = $string;
   if ( count ( $string_array ) > $word_count && $word_count > 0 )
      $trunc_string = implode( ' ', array_slice( $string_array, 0, $word_count ) ) . $suffix;
	  
   return apply_filters( 'graphene_truncate_words', $trunc_string, $string, $word_count, $suffix );
}
endif;


if ( ! function_exists( 'graphene_is_wp_version' ) ) :
/**
 * Check the currently installed version of WordPress
 *
 * @param string $version The version to check
 * @return bool True is WordPress version is equal to or greater than the passed version, false otherwise
 *
 * @package Graphene
 * @since 1.6
*/
function graphene_is_wp_version( $is_ver = '' ) {

    $wp_ver = explode( '.', get_bloginfo( 'version' ) );
    $is_ver = explode( '.', $is_ver );
    for( $i=0; $i<=count( $is_ver ); $i++ )
        if( !isset( $wp_ver[$i] ) ) array_push( $wp_ver, 0 );
 
    foreach( $is_ver as $i => $is_val )
        if( $wp_ver[$i] < $is_val ) return false;
    return true;
}
endif;


/**
 * Get the registered image sizes dimensions
 */
function graphene_get_image_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array( 
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}

	// Get only 1 size if found
	if ( $size ) {

		if( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		} else {
			return false;
		}

	}

	return $sizes;
}


/**
 * Sort array based on key named "score"
 */
function graphene_sort_array_key_score( $a, $b ){
	if ( $b['score'] > $a['score'] ) return 1;
	return 0;
}


/**
 * Get registered post types
 */
function graphene_get_post_types(){
	$types = array_merge( array( 'page' => 'page', 'post' => 'post' ), get_post_types( array( '_builtin' => false ) ) );

	// These are post types we know we don't want to show Page Builder on
	unset( $types['ml-slider'] );

	foreach( $types as $type_id => $type ) {
		$type_object = get_post_type_object( $type_id );

		if( !$type_object->show_ui ) {
			unset($types[$type_id]);
			continue;
		}

		$types[$type_id] = $type_object->label;
	}

	return $types;
}


if ( ! function_exists( 'graphene_remove_anonymous_object_filter' ) ) :
/**
 * Remove an anonymous object filter.
 *
 * @param  string $tag    Hook name.
 * @param  string $class  Class name
 * @param  string $method Method name
 * @return void
 */
function graphene_remove_anonymous_object_filter( $tag, $class, $method ){
	$filters = $GLOBALS['wp_filter'][ $tag ];

	if ( empty ( $filters ) ) return;

	foreach ( $filters as $priority => $filter ) {
		foreach ( $filter as $identifier => $function )	{
			if ( is_array( $function) && is_a( $function['function'][0], $class ) && $method === $function['function'][1] ) {
				remove_filter( $tag, array ( $function['function'][0], $method ), $priority );
			}
		}
	}
}
endif;