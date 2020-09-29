<?php

use ColibriWP\Theme\Core\Hooks;
use ColibriWP\Theme\Core\Utils;
use ColibriWP\Theme\Defaults;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function calliope_override_defaults( $defaults, $overrides ) {
    $overrides = Utils::pathDelete( $overrides, array(
        'header_front_page.hero',
        'header_post.hero'
    ) );

    if ( file_exists( get_stylesheet_directory() . "/inc/defaults.php" ) ) {
        $defaults  = require_once get_stylesheet_directory() . "/inc/defaults.php";
        $overrides = array_replace_recursive( $overrides, $defaults );
    }

    if ( file_exists( get_stylesheet_directory() . "/inc/template-defaults.php" ) ) {
        $template_defaults = require_once get_stylesheet_directory() . "/inc/template-defaults.php";
        $defaults          = array_replace_recursive( $template_defaults, $overrides );
    }

    return $defaults;
}

function calliope_set_google_fonts() {
    colibriwp_assets()
        ->clearGoogleFonts()
        ->addGoogleFont( 'Open Sans', [ 400, 600 ] )
        ->addGoogleFont( 'Raleway', [ 400, 500 ] )
        ->addGoogleFont( 'Montserrat', [ 300, 400, 500, 600 ] )
        ->registerScript(
            'calliope-admin-js',
            get_stylesheet_directory_uri() . "/resources/admin/admin.js",
            array( 'jquery' ),
            false
        );
}


function calliope_override_translations( $texts ) {

    $name  = colibriwp_theme()->getThemeHeaderData( 'Name' );
    $texts = array_merge( $texts, array(
        'theme_page_name'                         => sprintf( __( '%s Settings', 'calliope' ), $name ),
        "page_builder_plugin_description"         => sprintf(
            __(
                '%1$s plugin adds drag and drop functionality and many other features to the %2$s theme.',
                'calliope'
            ),
            'Colibri Page Builder',
            $name
        ),
        "admin_sidebar_documentation_description" =>
            sprintf(
                __(
                    '%s is easy to learn and master, but you can always check out our documentation to learn about some features you might have missed.',
                    'calliope'
                ),
                $name
            ),
    ) );


    return $texts;
}

function calliope_theme_loaded() {
    calliope_set_google_fonts();

    Hooks::colibri_add_filter(
        'info_page_support_link',
        Hooks::identity( 'https://colibriwp.com/go/calliope-support' )
    );

    Hooks::colibri_add_filter(
        'info_page_review_link',
        Hooks::identity( 'https://wordpress.org/support/theme/' . get_stylesheet() . '/reviews/' )
    );


    Hooks::colibri_add_filter(
        'info_page_docs_link',
        Hooks::identity( 'https://colibriwp.com/go/calliope-docs' )
    );


    add_action( 'admin_enqueue_scripts', function () {

        $notice_disble_slug = get_template() . "-page-info";
        $is_notice_disabled = get_option( "{$notice_disble_slug}-theme-notice-dismissed", false );

        if ( ! $is_notice_disabled ) {
            wp_enqueue_script( 'calliope-admin-js' );
        }

    }, 20 );

}

function calliope_override_main_row_class( $classes ) {

    return Defaults::get( 'templates.blog.row.layout-classes', $classes );
}

function calliope_front_page_design_screenshot_url( $url, $design ) {
    $slug = \ColibriWP\Theme\Core\Utils::pathGet( $design, 'meta.slug', '' );

    if ( $slug === 'modern' ) {
        return get_stylesheet_directory_uri() . "/resources/images/modern-screenshot.jpg";
    }

    return $url;
}


function calliope_theme_boot() {
    Hooks::colibri_add_filter( 'use_child_theme_header_data', '__return_true' );
    Hooks::colibri_add_filter( 'defaults', 'calliope_override_defaults', 10, 2 );
    Hooks::colibri_add_filter( 'translations', 'calliope_override_translations', 10, 2 );
    Hooks::colibri_add_filter( 'main_row_class', 'calliope_override_main_row_class', 10, 1 );
    Hooks::colibri_add_filter( 'front_page_design_screenshot_url', 'calliope_front_page_design_screenshot_url', 10, 2 );

    require_once __DIR__ . "/inc/integration/colibri-page-builder/colibri-page-builder-integration.php";
}


add_action( 'colibriwp_theme_boot', 'calliope_theme_boot' );
add_action( 'after_setup_theme', 'calliope_theme_loaded', 40 );

add_filter( 'colibri_page_builder/upgrade_url', function ( $url ) {
    return 'https://colibriwp.com/go/calliope-upgrade';
} );

add_filter( 'colibri_page_builder/try_url', function ( $url ) {
    return 'https://colibriwp.com/go/try-calliope';
} );

add_filter( 'mesmerize_notifications_template_slug', function ( $slug ) {
    return "calliope";
} );

add_filter( 'mesmerize_notifications_stylesheet_slug', function ( $slug ) {
    return "calliope";
} );
