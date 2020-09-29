<?php

use ColibriWP\Theme\Core\Hooks;
use ColibriWP\Theme\Defaults;

$calliope_front_page_design = false;

foreach ( Defaults::get( 'front_page_designs', array() ) as $design ) {
    if ( \ColibriWP\Theme\Core\Utils::pathGet( $design, 'display', true ) ) {
        if ( \ColibriWP\Theme\Core\Utils::pathGet( $design, 'meta.slug' ) === 'modern' ) {
            $calliope_front_page_design = $design;
            break;
        }

    }
}

?>
<style>
    .colibri-admin-big-notice--container .action-buttons,
    .colibri-admin-big-notice--container .content-holder {
        display: flex;
        align-items: center;
    }


    .colibri-admin-big-notice--container .front-page-preview {
        max-width: 362px;
        margin-right: 40px;
    }

    .colibri-admin-big-notice--container .front-page-preview img {
        max-width: 100%;
        border: 1px solid #ccd0d4;
    }

</style>
<div class="colibri-admin-big-notice--container">
    <div class="content-holder">

        <div class="front-page-preview">
            <?php $calliope_front_page_design_image = get_stylesheet_directory_uri() . "/screenshot.jpg"; ?>
            <img class="selected"
                 data-index="<?php echo esc_attr( $calliope_front_page_design['index'] ); ?>"
                 src="<?php echo esc_url( $calliope_front_page_design_image ); ?>"/>
        </div>
        <div class="messages-area">
            <div class="title-holder">
                <h1><?php esc_html_e( 'Would you like to install the pre-designed Calliope homepage?',
                        'calliope' ) ?></h1>
            </div>
            <div class="action-buttons">
                <button class="button button-primary button-hero start-with-predefined-design-button">
                    <?php esc_html_e( 'Install the Calliope homepage', 'calliope' ); ?>
                </button>
                <span class="or-separator"></span>
                <button class="button-link calliope-maybe-later">
                    <?php esc_html_e( 'Maybe Later', 'calliope' ); ?>
                </button>
            </div>
            <div class="content-footer ">
                <div>
                    <div class="plugin-notice">
                        <span class="spinner"></span>
                        <span class="message"></span>
                    </div>
                </div>
                <div>
                    <p class="description large-text">
                        <?php esc_html_e( 'This action will also install the Colibri Page Builder plugin.', 'calliope' ); ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <?php
    $calliope_builder_slug   = Hooks::colibri_apply_filters( 'plugin_slug', 'colibri-page-builder' );
    $calliope_builder_status = array(
        "status"         => colibriwp_theme()->getPluginsManager()->getPluginState( $calliope_builder_slug ),
        "install_url"    => colibriwp_theme()->getPluginsManager()->getInstallLink( $calliope_builder_slug ),
        "activate_url"   => colibriwp_theme()->getPluginsManager()->getActivationLink( $calliope_builder_slug ),
        "slug"           => $calliope_builder_slug,
        "view_demos_url" => add_query_arg(
            array(
                'page'        => 'colibri-wp-page-info',
                'current_tab' => 'demo-import'
            ),
            admin_url( 'themes.php' )
        ),
        "messages"       => array(
            "installing" => \ColibriWP\Theme\Translations::get( 'installing',
                'Colibri Page Builder' ),
            "activating" => \ColibriWP\Theme\Translations::get( 'activating',
                'Colibri Page Builder' )
        ),
    );
    wp_localize_script( get_template() . "-page-info", 'colibriwp_builder_status', $calliope_builder_status );
    ?>
</div>
