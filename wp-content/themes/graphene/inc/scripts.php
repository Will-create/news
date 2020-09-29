<?php
/**
 * Set the theme's version as the scripts version
 * @since Graphene 2.0
 */
function graphene_scripts_version( $graphene_settings ){
	$theme_data = wp_get_theme( basename( GRAPHENE_ROOTDIR ) );
	$graphene_settings['scripts_ver'] = $theme_data->Version;

	return $graphene_settings;
}
add_filter( 'graphene_settings', 'graphene_scripts_version' );


/**
 * Print the stylesheets
*/
function graphene_enqueue_scripts(){
	global $graphene_settings;
	$version = $graphene_settings['scripts_ver'];

	/* Enqueue scripts */
	wp_enqueue_script( 'bootstrap', 				GRAPHENE_ROOTURI . '/bootstrap/js/bootstrap.min.js', 								array( 'jquery' ), $version );
	wp_enqueue_script( 'bootstrap-hover-dropdown', 	GRAPHENE_ROOTURI . '/js/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js', 	array( 'jquery', 'bootstrap' ), $version );
	wp_enqueue_script( 'bootstrap-submenu', 		GRAPHENE_ROOTURI . '/js/bootstrap-submenu/bootstrap-submenu.min.js', 				array( 'jquery', 'bootstrap' ), $version );
	wp_enqueue_script( 'infinite-scroll', 			GRAPHENE_ROOTURI . '/js/jquery.infinitescroll.min.js', 								array( 'jquery' ), $version );
	if ( ( get_option( 'thread_comments' ) == 1 ) ) wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'graphene', 					GRAPHENE_ROOTURI . '/js/graphene.js', 												array( 'bootstrap', 'infinite-scroll' ), $version );

	/* Enqueue styles */
	wp_enqueue_style( 'bootstrap', 					GRAPHENE_ROOTURI . '/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', 				GRAPHENE_ROOTURI . '/fonts/font-awesome/css/font-awesome.min.css',  array() );
	wp_enqueue_style( 'graphene', 					get_stylesheet_uri(), 												array( 'bootstrap', 'font-awesome' ), $version, 'screen' );
	wp_enqueue_style( 'graphene-responsive', 		GRAPHENE_ROOTURI . '/responsive.css', 								array( 'bootstrap', 'font-awesome', 'graphene' ), $version );
	if ( is_rtl() ) {
		wp_enqueue_style( 'bootstrap-rtl', 			GRAPHENE_ROOTURI . '/bootstrap-rtl/bootstrap-rtl.min.css', 			array( 'bootstrap' ), $version );
		wp_enqueue_style( 'graphene-rtl', 			GRAPHENE_ROOTURI . '/style-rtl.css',								array( 'graphene' ), $version );
		wp_enqueue_style( 'graphene-responsive-rtl',GRAPHENE_ROOTURI . '/responsive-rtl.css', 							array( 'bootstrap-rtl', 'graphene' ), $version, 'screen' );
	}
	if ( is_singular() && $graphene_settings['print_css'] ) 
		wp_enqueue_style( 'graphene-print', 		GRAPHENE_ROOTURI . '/style-print.css', 								array( 'graphene' ), $version, 'print' );

	wp_enqueue_style( 'graphene-blocks',			GRAPHENE_ROOTURI . '/blocks.css', 									array( 'graphene-responsive' ), $version );

}
add_action( 'wp_enqueue_scripts', 'graphene_enqueue_scripts' );


/**
 * Enqueue block editor scripts
 */
function graphene_enqueue_block_editor_assets(){
	global $graphene_settings;
	$version = $graphene_settings['scripts_ver'];

	wp_enqueue_style( 'graphene-blocks',			GRAPHENE_ROOTURI . '/blocks.css', 					array(), $version );
	wp_enqueue_style( 'graphene-editor-blocks',		GRAPHENE_ROOTURI . '/admin/editor-blocks.css',		array( 'graphene-blocks' ), $version );

	wp_enqueue_script( 'graphene-editor-blocks',		GRAPHENE_ROOTURI . '/admin/editor-blocks.js',	array( 'jquery' ), $version );
	wp_localize_script( 'graphene-editor-blocks', 'grapheneEditorJs', array( 
		'contentWidth'	=> graphene_get_content_width() + 45,
		'widthOneCol'	=> graphene_grid_width( 45, 12 ),
		'widthTwoCol'	=> graphene_grid_width( 45, $graphene_settings['column_width']['two_col']['content'] ),
		'widthThreeCol' => graphene_grid_width( 45, $graphene_settings['column_width']['three_col']['content'] ),
	) );
}
add_action( 'enqueue_block_editor_assets', 'graphene_enqueue_block_editor_assets' );


/**
 * Defer scripts loading if no caching plugin is used
 */
function graphene_defer_enqueued_scripts( $tag, $handle, $src ){

	if ( defined( 'WP_CACHE' ) ) {
		if ( WP_CACHE ) return $tag;
	}

	$scripts = array(
		'jquery-migrate',
		'bootstrap',
		'bootstrap-hover-dropdown',
		'bootstrap-submenu',
		'infinite-scroll',
		'comment-reply',
		'graphene',
		'graphene-editor-blocks',
		'graphene-bbpress',
		'jquery-autocomplete',
		'masonry'
	);
	$scripts = apply_filters( 'graphene_defer_enqueued_scripts', $scripts );

	if ( ! in_array( $handle, $scripts ) ) return $tag;

	return str_replace( '<script', '<script defer', $tag );
}
add_filter( 'script_loader_tag', 'graphene_defer_enqueued_scripts', 10, 3 );


/**
 * Localize scripts and add JavaScript data
 *
 * @package Graphene
 * @since 1.9
 */
function graphene_localize_scripts(){
	global $graphene_settings, $wp_query;
	$posts_per_page = $wp_query->get( 'posts_per_page' );
	$comments_per_page = get_option( 'comments_per_page' );
	
	$js_object = array(
		/* General */
		'siteurl'				=> home_url(),
		'ajaxurl'				=> admin_url('admin-ajax.php'),
		'templateUrl'			=> GRAPHENE_ROOTURI,
		'isSingular'			=> is_singular(),

		/* Header */
		'enableStickyMenu'		=> $graphene_settings['enable_sticky_menu'],
		
		/* Comments */
		'shouldShowComments'	=> graphene_should_show_comments(),
		'commentsOrder'			=> get_option( 'default_comments_page' ),
		
		/* Slider */
		'sliderDisable'			=> $graphene_settings['slider_disable'],
		'sliderInterval'		=> $graphene_settings['slider_speed'],
		
		/* Infinite Scroll */
		'infScrollBtnLbl'		=> __( 'Load more', 'graphene' ),
		'infScrollOn'			=> $graphene_settings['inf_scroll_enable'],
		'infScrollCommentsOn'	=> $graphene_settings['inf_scroll_comments'],
		'totalPosts'			=> $wp_query->found_posts,
		'postsPerPage'			=> $posts_per_page,
		'isPageNavi'			=> function_exists( 'wp_pagenavi' ),
		'infScrollMsgText'		=> sprintf( 
										__( 'Fetching %1$s of %2$s items left ...', 'graphene' ),
										'window.grapheneInfScrollItemsPerPage', 
										'window.grapheneInfScrollItemsLeft' ),
		'infScrollMsgTextPlural'=> sprintf( 
										_n( 'Fetching %1$s of %2$s item left ...', 
											'Fetching %1$s of %2$s items left ...', 
											$posts_per_page, 'graphene' ), 
										'window.grapheneInfScrollItemsPerPage', 
										'window.grapheneInfScrollItemsLeft' ),
		'infScrollFinishedText'	=> __( 'All loaded!', 'graphene' ),
		'commentsPerPage'		=> $comments_per_page,
		'totalComments'			=> graphene_get_comment_count( 'comments', true, true ),
		'infScrollCommentsMsg'	=> sprintf( 
										__( 'Fetching %1$s of %2$s comments left ...', 'graphene' ), 
										'window.grapheneInfScrollCommentsPerPage', 
										'window.grapheneInfScrollCommentsLeft' ),
		'infScrollCommentsMsgPlural'=> sprintf( 
										_n( 'Fetching %1$s of %2$s comments left ...', 
											'Fetching %1$s of %2$s comments left ...', 
											$comments_per_page, 'graphene' ), 
										'window.grapheneInfScrollCommentsPerPage', 
										'window.grapheneInfScrollCommentsLeft' ),
		'infScrollCommentsFinishedMsg'	=> __( 'All comments loaded!', 'graphene' ),

		/* Live search */
		'disableLiveSearch'		=> ( isset( $graphene_settings['disable_live_search'] ) && GRAPHENE_PLUS ) ? $graphene_settings['disable_live_search'] : true,
		'txtNoResult'			=> __( 'No result found.', 'graphene' ),

		/* Posts layout */
		'isMasonry'				=> ( isset( $graphene_settings['posts_layout'] ) && $graphene_settings['posts_layout'] == 'masonry' ) ? true : false,
	);
	wp_localize_script( 'graphene', 'grapheneJS', apply_filters( 'graphene_js_object', $js_object ) );
}
add_action( 'wp_enqueue_scripts', 'graphene_localize_scripts' );


/**
 * List Google Fonts to be used in the theme
 */
function graphene_google_fonts_families(){
	return apply_filters( 'graphene_google_fonts', array(
		'family' => 'Lato:400,400i,700,700i',
		'subset' => 'latin',
		'display'=> 'swap'
	) );
}


/**
 * Generate the stylesheet link for Google Fonts
 */
function graphene_google_fonts_uri(){
	$fonts = graphene_google_fonts_families();

	if ( ! $fonts['family'] ) return false;
	else return add_query_arg( $fonts, "https://fonts.googleapis.com/css" );
}


/**
 * Load Google Fonts asynchronously
 */
function graphene_load_google_fonts(){
	$fonts = graphene_google_fonts_families();
	if ( ! $fonts['family'] ) return;

	$families = explode( '|', $fonts['family'] );
	$families[0] .= '&display=swap';
	?>
		<script>
		   WebFontConfig = {
		      google: { 
		      	families: <?php echo json_encode( $families ); ?>
		      }
		   };

		   (function(d) {
		      var wf = d.createElement('script'), s = d.scripts[0];
		      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
		      wf.async = true;
		      s.parentNode.insertBefore(wf, s);
		   })(document);
		</script>
	<?php
}
add_action( 'wp_head', 'graphene_load_google_fonts' );


/**
 * Load Google Fonts locally
 */
function graphene_google_fonts_local( $fonts ){
	global $graphene_settings;
	if ( ! $graphene_settings['host_scripts_locally'] ) return $fonts;
	if ( $graphene_settings['disable_google_fonts'] ) return $fonts;

	/* Do not run this on AMP pages */
	if ( function_exists( 'is_amp_endpoint' ) ) {
		if ( is_amp_endpoint() ) return $fonts;
	}

	/* Get supplied local fonts */
	$local_fonts = apply_filters( 'graphene_local_fonts', array(
		'Lato' => '400,400i,700,700i',
	) );

	if ( ! $local_fonts ) return $fonts;

	$fonts['family'] = str_replace( 'regular', '400', $fonts['family'] );
	$fonts['family'] = str_replace( 'italic', 'i', $fonts['family'] );
	$fonts['family'] = str_replace( ',i', ',400i', $fonts['family'] );

	/* Print scripts for locally-hosted fonts */
	$css = '';
	$font_families = explode( '|', $fonts['family'] );
	foreach ( $font_families as $i => $font ) {
		$font = explode( ':', $font );
		$family = $font[0];
		$variants = $font[1];

		if ( isset( $local_fonts[$family] ) && $local_fonts[$family] == $variants ) {
			unset( $font_families[$i] );
			foreach ( explode( ',', $variants ) as $variant ) {

				$style = ( stripos( $variant, 'i' ) === 3 ) ? 'italic' : 'normal';
				$weight = str_replace( 'i', '', $variant );
				
				$name = $family;
				if ( $weight == 700 ) $name .= ' Bold';
				if ( $style == 'italic' ) $name .= ' Italic';
				if ( $weight == 400 && $style == 'normal' ) $name .= ' Regular';
				$name_hyphened = str_replace( ' ', '-', $name );

				$filename = GRAPHENE_ROOTURI . '/fonts/' . $family . '/' . $family . '-';
				if ( $weight == 700 ) $filename .= 'Bold';
				if ( $style == 'italic' ) $filename .= 'Italic';
				if ( $weight == 400 && $style == 'normal' ) $filename .= 'Regular';
				$filename .= '.woff2';

				$css .= "@font-face {
						  	font-family: '$family';
							font-style: $style;
							font-weight: $weight;
							src: local('$name'), local('$name_hyphened'), url($filename) format('woff2');
unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
							font-display: swap;
						}";
			}
		}
	}

	/* Print the stylesheet */
	if ( $css ) echo '<style type="text/css">' . "\n" . graphene_minify_css( apply_filters( 'graphene_local_fonts_style', $css ) ) . "\n" . '</style>' . "\n";

	/* Load locally-unavailable fonts from Google */
	$fonts['family'] = implode( ',', $font_families );
	return $fonts;

}
add_filter( 'graphene_google_fonts', 'graphene_google_fonts_local', 20 );


/**
 * Ensure correct ordering of stylesheets when using a child theme
 * @since Graphene 2.0.3
 */
function graphene_child_stylesheets_order(){
	global $wp_styles;
	if ( ! $wp_styles->registered ) return;

	$child_stylesheet = get_stylesheet_uri();
	if ( $child_stylesheet == GRAPHENE_ROOTURI . '/style.css' ) return;

	$parent_theme = wp_get_theme( basename( GRAPHENE_ROOTDIR ) );
	$parent_stylesheet = basename( GRAPHENE_ROOTURI ) . '/style.css';

	foreach ( $wp_styles->registered as $handle => $script ) {
		if ( stripos( $script->src, $parent_stylesheet ) !== false ) {
			$wp_styles->registered[$handle]->deps = array_merge( $script->deps, array( 'bootstrap', 'font-awesome' ) );
			$wp_styles->registered[$handle]->ver = $parent_theme->Version;
			$parent_handle = $handle;
		}

		if ( $script->src === $child_stylesheet ) $child_handles[] = $handle;
	}

	foreach ( $child_handles as $handle ){
		if ( count( $child_handles ) > 1 && $handle === 'graphene' ) {
			unset( $wp_styles->registered['graphene'] );
			continue;
		}

		if ( isset( $parent_handle ) ) {
			$wp_styles->registered[$handle]->deps[] = $parent_handle;
			$wp_styles->registered[$handle]->deps = array_unique( $wp_styles->registered[$handle]->deps );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'graphene_child_stylesheets_order', 100 );