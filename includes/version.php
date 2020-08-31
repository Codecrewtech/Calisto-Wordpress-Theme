<?php

/**
 * Theme Meta Info for internal usage
 *
 * Dont Mess with it.
 */
add_action( 'before_spyropress_core_includes', 'spyropress_setup_theme' );
function spyropress_setup_theme() {
    global $spyropress;

    $spyropress->internal_name = 'tomato';
    $spyropress->theme_name = 'Tomato';
    $spyropress->theme_version = '1.0.2';
    $spyropress->themekey = 'fj9nzqmyzqne9ouib0e0ivt9qgarra3nm';

    $spyropress->framework = 'bs3';
    $spyropress->grid_columns = 12;
    $spyropress->row_class = 'row';
}