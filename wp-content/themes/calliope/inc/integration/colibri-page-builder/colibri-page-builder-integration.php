<?php

add_filter( 'colibri_page_builder/remote_import_slug', function ( $remote_default_path, $front_page_design ) {

    if ( $front_page_design === null ) {
        return $remote_default_path;
    }

    if ( intval( $front_page_design ) === 3 || intval( $front_page_design ) === 0 ) {
        $remote_default_path = 'calliope';
    }

    return $remote_default_path;
}, 10, 2 );

