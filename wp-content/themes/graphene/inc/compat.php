<?php
/**
 * Bootstrap conflict with other plugins
 */ 
function graphene_compat_scripts(){

	/* Dequeue Bootstrap from other plugins */
	global $wp_scripts;
	$bootstrap_handles = array( 'bootstrap' );
	
	foreach ( $wp_scripts->queue as $script_handle ) {
		if ( ! in_array( $script_handle, array( 'bootstrap', 'bootstrap-hover-dropdown', 'bootstrap-submenu' ) ) ) {
			if ( stripos( $script_handle, 'bootstrap' ) !== false ) {

				/* Dequeue Bootstrap queued by other plugins as well */
				$script_filename = basename( $wp_scripts->registered[$script_handle]->src );
				if ( in_array( $script_filename, array( 'bootstrap.js', 'bootstrap.min.js' ) ) ) {
					wp_dequeue_script( $script_handle );
					$bootstrap_handles[] = $script_handle;
				}

				continue;
			}
		}
	}

	/* Update the Bootstrap dependency for registered scripts */
	foreach ( $wp_scripts->registered as $registered_handle => $script ) {
		if ( array_intersect( $bootstrap_handles, $script->deps ) ) {
			foreach ( $bootstrap_handles as $bootstrap_handle ) {
				$key = array_search( $bootstrap_handle, $script->deps );
				if ( $key !== false ) $wp_scripts->registered[$registered_handle]->deps[$key] = 'bootstrap';
			}
		}
	}

}
add_action( 'wp_print_scripts', 'graphene_compat_scripts', 999 );


if ( ! function_exists( 'determine_locale' ) ) :
/**
 * determine_locale() added in WP 5.0
 */
function determine_locale() {
    /**
     * Filters the locale for the current request prior to the default determination process.
     *
     * Using this filter allows to override the default logic, effectively short-circuiting the function.
     *
     * @since 5.0.0
     *
     * @param string|null The locale to return and short-circuit, or null as default.
     */
    $determined_locale = apply_filters( 'pre_determine_locale', null );
    if ( ! empty( $determined_locale ) && is_string( $determined_locale ) ) {
        return $determined_locale;
    }
 
    $determined_locale = get_locale();
 
    if ( is_admin() ) {
        $determined_locale = get_user_locale();
    }
 
    if ( isset( $_GET['_locale'] ) && 'user' === $_GET['_locale'] && wp_is_json_request() ) {
        $determined_locale = get_user_locale();
    }
 
    if ( ! empty( $_GET['wp_lang'] ) && ! empty( $GLOBALS['pagenow'] ) && 'wp-login.php' === $GLOBALS['pagenow'] ) {
        $determined_locale = sanitize_text_field( $_GET['wp_lang'] );
    }
 
    /**
     * Filters the locale for the current request.
     *
     * @since 5.0.0
     *
     * @param string $locale The locale.
     */
    return apply_filters( 'determine_locale', $determined_locale );
}
endif;


if ( ! function_exists( 'wp_body_open' ) ) :
/**
 * Backward compatibility for WP < 5.2
 */
function wp_body_open() {
    do_action( 'wp_body_open' );
}
endif;