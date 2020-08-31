<?php

/**
 * Option/Settings Helper Functions
 *
 * @category Utilities
 * @package Spyropress
 *
 */

/** Option Getter and Formatter **********************/

function get_float_class( $float ) {
    
    // check for null
    if ( ! $float ) return;

    $allowed_floats = array( 'left' => 'pull-left', 'right' => 'pull-right' );

    if ( in_array( $float, array_keys( $allowed_floats ) ) )
        $float = $allowed_floats[$float];

    return $float;
}

/**
 * Row Class
 */
function get_row_class( $return = false ) {
    global $spyropress;

    if ( $return )
        return $spyropress->row_class;
    echo esc_attr( $spyropress->row_class );
}

/**
 * Column Class
 */
function get_column_class( $column ) {
    if( 'skt' == get_html_framework() ) return get_skeleton_col_class( $column );
    
    if( 'bs' == get_html_framework() ) return get_bootstrap_class( $column );
    
    if( 'bs3' == get_html_framework() ) return get_bootstrap3_class( $column );
    
    if( 'fd3' == get_html_framework() ) return get_foundation3_col_class( $column );
}

/**
 * Bootstrap Class
 */
function get_bootstrap_class( $column ) {

    $class = 'span12';

    switch ( $column ) {
        case 2:
            $class = 'span6';
            break;
        case 3:
            $class = 'span4';
            break;
        case 4:
            $class = 'span3';
            break;
        case 6:
            $class = 'span2';
            break;
    }

    return $class;
}

/**
 * Bootstrap Class
 */
function get_bootstrap3_class( $column ) {

    $class = 'col-md-12';

    switch ( $column ) {
        case 2:
            $class = 'col-md-6';
            break;
        case 3:
            $class = 'col-md-4';
            break;
        case 4:
            $class = 'col-md-3';
            break;
        case 6:
            $class = 'col-md-2';
            break;
    }

    return $class;
}

/**
 * Skeleton Classes
 */
function get_skeleton_col_class( $column ) {

    $class = get_skeleton_class( 16 );

    switch ( $column ) {
        case 2:
            $class = get_skeleton_class( 8 );
            break;
        case 3:
            $class = get_skeleton_class( '1/3' );
            break;
        case 4:
            $class = get_skeleton_class( 4 );
            break;
        case 8:
            $class = get_skeleton_class( 2 );
            break;
    }

    return $class;
}

function get_skeleton_class( $column ) {
    
    $classes = array(
        1 => 'one columns',
        2 => 'two columns',
        3 => 'three columns',
        4 => 'four columns',
        5 => 'five columns',
        6 => 'six columns',
        7 => 'seven columns',
        8 => 'eight columns',
        9 => 'nine columns',
        10 => 'ten columns',
        11 => 'eleven columns',
        12 => 'twelve columns',
        13 => 'thirteen columns',
        14 => 'fourteen columns',
        15 => 'fifteen columns',
        16 => 'sixteen columns',
        '1/3' => 'one-third column',
        '2/3' => 'two-thirds column',
    );
    
    return $classes[$column];
}

function get_admin_column_class( $column ) {
    
    $class = '';
    if( 12 == get_grid_columns() ) {

        $class = 'span12';
        
        switch ( $column ) {
            case 2:
                $class = 'span6';
                break;
            case 3:
                $class = 'span4';
                break;
            case 4:
                $class = 'span3';
                break;
            case 6:
                $class = 'span2';
                break;
        }
    }
    elseif( 16 == get_grid_columns() ) {

        $class = 'span16';
        
        switch ( $column ) {
            case 2:
                $class = 'span8';
                break;
            case 3:
                $class = 'span1by3';
                break;
            case 4:
                $class = 'span4';
                break;
            case 8:
                $class = 'span2';
                break;
        }
    }
    
    return $class;
}

/**
 * Foundation3 Classes
 */

function get_foundation3_col_class( $column ) {

    $class = get_foundation3_class( 12 );

    switch ( $column ) {
        case 2:
            $class = get_foundation3_class( 6 );
            break;
        case 3:
            $class = get_foundation3_class( 4 );
            break;
        case 4:
            $class = get_foundation3_class( 3 );
            break;
        case 6:
            $class = get_foundation3_class( 2 );
            break;
    }

    return $class;
}

function get_foundation3_class( $column ) {

    $classes = array(
        1 => 'one columns',
        2 => 'two columns',
        3 => 'three columns',
        4 => 'four columns',
        5 => 'five columns',
        6 => 'six columns',
        7 => 'seven columns',
        8 => 'eight columns',
        9 => 'nine columns',
        10 => 'ten columns',
        11 => 'eleven columns',
        12 => 'twelve columns'
    );
    
    return $classes[$column];
}

/**
 * Get HTML Framework
 */
function get_html_framework() {
    global $spyropress;
    return $spyropress->framework;
}

/**
 * Get Grid Column
 */
function get_grid_columns() {
    global $spyropress;
    return $spyropress->grid_columns;
}

/**
 * First Column Class accoring to framework
 */
function get_first_column_class() {
    
    // Skeleton
    if( 'skt' == get_html_framework() ) return 'alpha';
    
    // Others
    return 'column_first';
}

/**
 * Last Column Class accoring to framework
 */
function get_last_column_class() {
    
    // Skeleton
    if( 'skt' == get_html_framework() ) return 'omega';
    
    // Foundation
    if( 'fd3' == get_html_framework() ) return 'end';
    
    // Others
    return 'column_last';
}

/** Data Sources for Post Type and Taxonomies **********************/

/**
 * Buckets
 */
function spyropress_get_buckets() {
    
    $buckets = array();
    
    if ( ! post_type_exists( 'bucket' ) ) return $buckets;
    
    // get posts
    $args = array(
        'post_type' => 'bucket',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'asc'
    );
    $posts = get_posts( $args );
    if ( !empty( $posts ) ) {
        foreach ( $posts as $post ) {
            $buckets[$post->ID] = $post->post_title;
        }
    }

    return $buckets;
}

/**
 * Custom Taxonomies
 */
function spyropress_get_taxonomies( $tax = '' ) {
    
    if ( ! $tax ) return array();

    $terms = get_terms( $tax );
    $taxs = array();
    if ( !empty( $terms ) )
        foreach ( $terms as $term )
            $taxs[$term->slug] = $term->name;

    return $taxs;
}

/** Custom Data Sources ********************************************/

/**
 * jQuery Easing Options
 */
function spyropress_get_options_easing() {
    return array(
        'linear' => esc_html__( 'linear', 'tomato' ),
        'jswing' => esc_html__( 'jswing', 'tomato' ),
        'def' => esc_html__( 'def', 'tomato' ),
        'easeInQuad' => esc_html__( 'easeInQuad', 'tomato' ),
        'easeOutQuad' => esc_html__( 'easeOutQuad', 'tomato' ),
        'easeInOutQuad' => esc_html__( 'easeInOutQuad', 'tomato' ),
        'easeInCubic' => esc_html__( 'easeInCubic', 'tomato' ),
        'easeOutCubic' => esc_html__( 'easeOutCubic', 'tomato' ),
        'easeInOutCubic' => esc_html__( 'easeInOutCubic', 'tomato' ),
        'easeInQuart' => esc_html__( 'easeInQuart', 'tomato' ),
        'easeOutQuart' => esc_html__( 'easeOutQuart', 'tomato' ),
        'easeInOutQuart' => esc_html__( 'easeInOutQuart', 'tomato' ),
        'easeInQuint' => esc_html__( 'easeInQuint', 'tomato' ),
        'easeOutQuint' => esc_html__( 'easeOutQuint', 'tomato' ),
        'easeInOutQuint' => esc_html__( 'easeInOutQuint', 'tomato' ),
        'easeInSine' => esc_html__( 'easeInSine', 'tomato' ),
        'easeOutSine' => esc_html__( 'easeOutSine', 'tomato' ),
        'easeInOutSine' => esc_html__( 'easeInOutSine', 'tomato' ),
        'easeInExpo' => esc_html__( 'easeInExpo', 'tomato' ),
        'easeOutExpo' => esc_html__( 'easeOutExpo', 'tomato' ),
        'easeInOutExpo' => esc_html__( 'easeInOutExpo', 'tomato' ),
        'easeInCirc' => esc_html__( 'easeInCirc', 'tomato' ),
        'easeOutCirc' => esc_html__( 'easeOutCirc', 'tomato' ),
        'easeInOutCirc' => esc_html__( 'easeInOutCirc', 'tomato' ),
        'easeInElastic' => esc_html__( 'easeInElastic', 'tomato' ),
        'easeOutElastic' => esc_html__( 'easeOutElastic', 'tomato' ),
        'easeInOutElastic' => esc_html__( 'easeInOutElastic', 'tomato' ),
        'easeInBack' => esc_html__( 'easeInBack', 'tomato' ),
        'easeOutBack' => esc_html__( 'easeOutBack', 'tomato' ),
        'easeInOutBack' => esc_html__( 'easeInOutBack', 'tomato' ),
        'easeInBounce' => esc_html__( 'easeInBounce', 'tomato' ),
        'easeOutBounce' => esc_html__( 'easeOutBounce', 'tomato' ),
        'easeInOutBounce' => esc_html__( 'easeInOutBounce', 'tomato' ),
    );
}

function spyropress_get_options_float() {
    return array(
        'none' => esc_html__( 'None', 'tomato' ),
        'left' => esc_html__( 'Left', 'tomato' ),
        'right' => esc_html__( 'Right', 'tomato' ),
    );
}

function spyropress_get_options_link( $fields ) {
    // check for emptiness
    if ( empty( $fields ) ) $fields = array();

    return array_merge( $fields, array(
        array(
            'label' => esc_html__( 'URL/Link Setting', 'tomato' ),
            'type' => 'toggle'
        ),

        array(
            'label' => esc_html__( 'Link Text', 'tomato' ),
            'id' => 'url_text',
            'type' => 'text'
        ),

        array(
            'label' => esc_html__( 'URL/Hash', 'tomato' ),
            'id' => 'url',
            'type' => 'text'
        ),

        array(
            'label' => esc_html__( 'Link to Post/Page', 'tomato' ),
            'id' => 'link_url',
            'type' => 'custom_post',
            'post_type' => array( 'post', 'page' )
        ),

        array( 'type' => 'toggle_end' )
    ) );
}

function spyropress_get_options_fontawesome_icons(){
    
     return array(
        'fa-adjust' => esc_html__( 'Adjust', 'tomato' ),
        'fa-adn' => esc_html__( 'Adn', 'tomato' ),
        'fa-align-center' => esc_html__( 'Align Center', 'tomato' ),
        'fa-align-justify' => esc_html__( 'Align Justify', 'tomato' ),
        'fa-align-left' => esc_html__( 'Align Left', 'tomato' ),
        'fa-align-right' => esc_html__( 'Align Right', 'tomato' ),
        'fa-ambulance' => esc_html__( 'Ambulance', 'tomato' ),
        'fa-anchor' => esc_html__( 'Anchor', 'tomato' ),
        'fa-android' => esc_html__( 'Android', 'tomato' ),
        'fa-angellist' => esc_html__( 'Angellist', 'tomato' ),
        'fa-angle-double-down' => esc_html__( 'Angle Double Down', 'tomato' ),
        'fa-angle-double-left' => esc_html__( 'Angle Double Left', 'tomato' ),
        'fa-angle-double-right' => esc_html__( 'Angle Double Right', 'tomato' ),
        'fa-angle-double-up' => esc_html__( 'Angle Double Up', 'tomato' ),
        'fa-angle-down' => esc_html__( 'Angle Down', 'tomato' ),
        'fa-angle-left' => esc_html__( 'Angle Left', 'tomato' ),
        'fa-angle-right' => esc_html__( 'Angle Right', 'tomato' ),
        'fa-angle-up' => esc_html__( 'Angle Up', 'tomato' ),
        'fa-apple' => esc_html__( 'Apple', 'tomato' ),
        'fa-archive' => esc_html__( 'Archive', 'tomato' ),
        'fa-area-chart' => esc_html__( 'Area Chart', 'tomato' ),
        'fa-arrow-circle-down' => esc_html__( 'Arrow Circle Down', 'tomato' ),
        'fa-arrow-circle-left' => esc_html__( 'Arrow Circle Left', 'tomato' ),
        'fa-arrow-circle-o-down' => esc_html__( 'Arrow Circle Outline Down', 'tomato' ),
        'fa-arrow-circle-o-left' => esc_html__( 'Arrow Circle Outline Left', 'tomato' ),
        'fa-arrow-circle-o-right' => esc_html__( 'Arrow Circle Outline Right', 'tomato' ),
        'fa-arrow-circle-o-up' => esc_html__( 'Arrow Circle Outline Up', 'tomato' ),
        'fa-arrow-circle-right' => esc_html__( 'Arrow Circle Right', 'tomato' ),
        'fa-arrow-circle-up' => esc_html__( 'Arrow Circle Up', 'tomato' ),
        'fa-arrow-down' => esc_html__( 'Arrow Down', 'tomato' ),
        'fa-arrow-left' => esc_html__( 'Arrow Left', 'tomato' ),
        'fa-arrow-right' => esc_html__( 'Arrow Right', 'tomato' ),
        'fa-arrow-up' => esc_html__( 'Arrow Up', 'tomato' ),
        'fa-arrows-alt' => esc_html__( 'Arrows Alt', 'tomato' ),
        'fa-arrows-h' => esc_html__( 'Arrows H', 'tomato' ),
        'fa-arrows-v' => esc_html__( 'Arrows V', 'tomato' ),
        'fa-arrows' => esc_html__( 'Arrows', 'tomato' ),
        'fa-asterisk' => esc_html__( 'Asterisk', 'tomato' ),
        'fa-at' => esc_html__( 'At', 'tomato' ),
        'fa-automobile' => esc_html__( 'Automobile', 'tomato' ),
        'fa-backward' => esc_html__( 'Backward', 'tomato' ),
        'fa-ban' => esc_html__( 'Ban', 'tomato' ),
        'fa-bank' => esc_html__( 'Bank', 'tomato' ),
        'fa-bar-chart-o' => esc_html__( 'Bar Chart Outline', 'tomato' ),
        'fa-bar-chart' => esc_html__( 'Bar Chart', 'tomato' ),
        'fa-barcode' => esc_html__( 'Barcode', 'tomato' ),
        'fa-bars' => esc_html__( 'Bars', 'tomato' ),
        'fa-beer' => esc_html__( 'Beer', 'tomato' ),
        'fa-behance-square' => esc_html__( 'Behance Square', 'tomato' ),
        'fa-behance' => esc_html__( 'Behance', 'tomato' ),
        'fa-bell-o' => esc_html__( 'Bell Outline', 'tomato' ),
        'fa-bell-slash-o' => esc_html__( 'Bell Slash Outline', 'tomato' ),
        'fa-bell-slash' => esc_html__( 'Bell Slash', 'tomato' ),
        'fa-bell' => esc_html__( 'Bell', 'tomato' ),
        'fa-bicycle' => esc_html__( 'Bicycle', 'tomato' ),
        'fa-binoculars' => esc_html__( 'Binoculars', 'tomato' ),
        'fa-birthday-cake' => esc_html__( 'Birthday Cake', 'tomato' ),
        'fa-bitbucket-square' => esc_html__( 'Bitbucket Square', 'tomato' ),
        'fa-bitbucket' => esc_html__( 'Bitbucket', 'tomato' ),
        'fa-bitcoin' => esc_html__( 'Bitcoin', 'tomato' ),
        'fa-bold' => esc_html__( 'Bold', 'tomato' ),
        'fa-bolt' => esc_html__( 'Bolt', 'tomato' ),
        'fa-bomb' => esc_html__( 'Bomb', 'tomato' ),
        'fa-book' => esc_html__( 'Book', 'tomato' ),
        'fa-bookmark-o' => esc_html__( 'Bookmark Outline', 'tomato' ),
        'fa-bookmark' => esc_html__( 'Bookmark', 'tomato' ),
        'fa-briefcase' => esc_html__( 'Briefcase', 'tomato' ),
        'fa-btc' => esc_html__( 'Btc', 'tomato' ),
        'fa-bug' => esc_html__( 'Bug', 'tomato' ),
        'fa-building-o' => esc_html__( 'Building Outline', 'tomato' ),
        'fa-building' => esc_html__( 'Building', 'tomato' ),
        'fa-bullhorn' => esc_html__( 'Bullhorn', 'tomato' ),
        'fa-bullseye' => esc_html__( 'Bullseye', 'tomato' ),
        'fa-bus' => esc_html__( 'Bus', 'tomato' ),
        'fa-cc-amex' => esc_html__( 'CC Amex', 'tomato' ),
        'fa-cc-discover' => esc_html__( 'CC Discover', 'tomato' ),
        'fa-cc-mastercard' => esc_html__( 'CC Mastercard', 'tomato' ),
        'fa-cc-paypal' => esc_html__( 'CC Paypal', 'tomato' ),
        'fa-cc-stripe' => esc_html__( 'CC Stripe', 'tomato' ),
        'fa-cc-visa' => esc_html__( 'CC Visa', 'tomato' ),
        'fa-cab' => esc_html__( 'Cab', 'tomato' ),
        'fa-calculator' => esc_html__( 'Calculator', 'tomato' ),
        'fa-calendar-o' => esc_html__( 'Calendar Outline', 'tomato' ),
        'fa-calendar' => esc_html__( 'Calendar', 'tomato' ),
        'fa-camera-retro' => esc_html__( 'Camera Retro', 'tomato' ),
        'fa-camera' => esc_html__( 'Camera', 'tomato' ),
        'fa-car' => esc_html__( 'Car', 'tomato' ),
        'fa-caret-down' => esc_html__( 'Caret Down', 'tomato' ),
        'fa-caret-left' => esc_html__( 'Caret Left', 'tomato' ),
        'fa-caret-right' => esc_html__( 'Caret Right', 'tomato' ),
        'fa-caret-square-o-down' => esc_html__( 'Caret Square Outline Down', 'tomato' ),
        'fa-caret-square-o-left' => esc_html__( 'Caret Square Outline Left', 'tomato' ),
        'fa-caret-square-o-right' => esc_html__( 'Caret Square Outline Right', 'tomato' ),
        'fa-caret-square-o-up' => esc_html__( 'Caret Square Outline Up', 'tomato' ),
        'fa-caret-up' => esc_html__( 'Caret Up', 'tomato' ),
        'fa-cc' => esc_html__( 'Cc', 'tomato' ),
        'fa-certificate' => esc_html__( 'Certificate', 'tomato' ),
        'fa-chain-broken' => esc_html__( 'Chain Broken', 'tomato' ),
        'fa-chain' => esc_html__( 'Chain', 'tomato' ),
        'fa-check-circle-o' => esc_html__( 'Check Circle Outline', 'tomato' ),
        'fa-check-circle' => esc_html__( 'Check Circle', 'tomato' ),
        'fa-check-square-o' => esc_html__( 'Check Square Outline', 'tomato' ),
        'fa-check-square' => esc_html__( 'Check Square', 'tomato' ),
        'fa-check' => esc_html__( 'Check', 'tomato' ),
        'fa-chevron-circle-down' => esc_html__( 'Chevron Circle Down', 'tomato' ),
        'fa-chevron-circle-left' => esc_html__( 'Chevron Circle Left', 'tomato' ),
        'fa-chevron-circle-right' => esc_html__( 'Chevron Circle Right', 'tomato' ),
        'fa-chevron-circle-up' => esc_html__( 'Chevron Circle Up', 'tomato' ),
        'fa-chevron-down' => esc_html__( 'Chevron Down', 'tomato' ),
        'fa-chevron-left' => esc_html__( 'Chevron Left', 'tomato' ),
        'fa-chevron-right' => esc_html__( 'Chevron Right', 'tomato' ),
        'fa-chevron-up' => esc_html__( 'Chevron Up', 'tomato' ),
        'fa-child' => esc_html__( 'Child', 'tomato' ),
        'fa-circle-o-notch' => esc_html__( 'Circle Outline Notch', 'tomato' ),
        'fa-circle-o' => esc_html__( 'Circle Outline', 'tomato' ),
        'fa-circle-thin' => esc_html__( 'Circle Thin', 'tomato' ),
        'fa-circle' => esc_html__( 'Circle', 'tomato' ),
        'fa-clipboard' => esc_html__( 'Clipboard', 'tomato' ),
        'fa-clock-o' => esc_html__( 'Clock Outline', 'tomato' ),
        'fa-close' => esc_html__( 'Close', 'tomato' ),
        'fa-cloud-download' => esc_html__( 'Cloud Download', 'tomato' ),
        'fa-cloud-upload' => esc_html__( 'Cloud Upload', 'tomato' ),
        'fa-cloud' => esc_html__( 'Cloud', 'tomato' ),
        'fa-cny' => esc_html__( 'Cny', 'tomato' ),
        'fa-code-fork' => esc_html__( 'Code Fork', 'tomato' ),
        'fa-code' => esc_html__( 'Code', 'tomato' ),
        'fa-codepen' => esc_html__( 'Codepen', 'tomato' ),
        'fa-coffee' => esc_html__( 'Coffee', 'tomato' ),
        'fa-cog' => esc_html__( 'Cog', 'tomato' ),
        'fa-cogs' => esc_html__( 'Cogs', 'tomato' ),
        'fa-columns' => esc_html__( 'Columns', 'tomato' ),
        'fa-comment-o' => esc_html__( 'Comment Outline', 'tomato' ),
        'fa-comment' => esc_html__( 'Comment', 'tomato' ),
        'fa-comments-o' => esc_html__( 'Comments Outline', 'tomato' ),
        'fa-comments' => esc_html__( 'Comments', 'tomato' ),
        'fa-compass' => esc_html__( 'Compass', 'tomato' ),
        'fa-compress' => esc_html__( 'Compress', 'tomato' ),
        'fa-copy' => esc_html__( 'Copy', 'tomato' ),
        'fa-copyright' => esc_html__( 'Copyright', 'tomato' ),
        'fa-credit-card' => esc_html__( 'Credit Card', 'tomato' ),
        'fa-crop' => esc_html__( 'Crop', 'tomato' ),
        'fa-crosshairs' => esc_html__( 'Crosshairs', 'tomato' ),
        'fa-css3' => esc_html__( 'Css3', 'tomato' ),
        'fa-cube' => esc_html__( 'Cube', 'tomato' ),
        'fa-cubes' => esc_html__( 'Cubes', 'tomato' ),
        'fa-cut' => esc_html__( 'Cut', 'tomato' ),
        'fa-cutlery' => esc_html__( 'Cutlery', 'tomato' ),
        'fa-dashboard' => esc_html__( 'Dashboard', 'tomato' ),
        'fa-database' => esc_html__( 'Database', 'tomato' ),
        'fa-dedent' => esc_html__( 'Dedent', 'tomato' ),
        'fa-delicious' => esc_html__( 'Delicious', 'tomato' ),
        'fa-desktop' => esc_html__( 'Desktop', 'tomato' ),
        'fa-deviantart' => esc_html__( 'Deviantart', 'tomato' ),
        'fa-digg' => esc_html__( 'Digg', 'tomato' ),
        'fa-dollar' => esc_html__( 'Dollar', 'tomato' ),
        'fa-dot-circle-o' => esc_html__( 'Dot Circle Outline', 'tomato' ),
        'fa-download' => esc_html__( 'Download', 'tomato' ),
        'fa-dribbble' => esc_html__( 'Dribbble', 'tomato' ),
        'fa-dropbox' => esc_html__( 'Dropbox', 'tomato' ),
        'fa-drupal' => esc_html__( 'Drupal', 'tomato' ),
        'fa-edit' => esc_html__( 'Edit', 'tomato' ),
        'fa-eject' => esc_html__( 'Eject', 'tomato' ),
        'fa-ellipsis-h' => esc_html__( 'Ellipsis H', 'tomato' ),
        'fa-ellipsis-v' => esc_html__( 'Ellipsis V', 'tomato' ),
        'fa-empire' => esc_html__( 'Empire', 'tomato' ),
        'fa-envelope-o' => esc_html__( 'Envelope Outline', 'tomato' ),
        'fa-envelope-square' => esc_html__( 'Envelope Square', 'tomato' ),
        'fa-envelope' => esc_html__( 'Envelope', 'tomato' ),
        'fa-eraser' => esc_html__( 'Eraser', 'tomato' ),
        'fa-eur' => esc_html__( 'Eur', 'tomato' ),
        'fa-euro' => esc_html__( 'Euro', 'tomato' ),
        'fa-exchange' => esc_html__( 'Exchange', 'tomato' ),
        'fa-exclamation-circle' => esc_html__( 'Exclamation Circle', 'tomato' ),
        'fa-exclamation-triangle' => esc_html__( 'Exclamation Triangle', 'tomato' ),
        'fa-exclamation' => esc_html__( 'Exclamation', 'tomato' ),
        'fa-expand' => esc_html__( 'Expand', 'tomato' ),
        'fa-external-link-square' => esc_html__( 'External Link Square', 'tomato' ),
        'fa-external-link' => esc_html__( 'External Link', 'tomato' ),
        'fa-eye-slash' => esc_html__( 'Eye Slash', 'tomato' ),
        'fa-eye' => esc_html__( 'Eye', 'tomato' ),
        'fa-eyedropper' => esc_html__( 'Eyedropper', 'tomato' ),
        'fa-facebook-square' => esc_html__( 'Facebook Square', 'tomato' ),
        'fa-facebook' => esc_html__( 'Facebook', 'tomato' ),
        'fa-fast-backward' => esc_html__( 'Fast Backward', 'tomato' ),
        'fa-fast-forward' => esc_html__( 'Fast Forward', 'tomato' ),
        'fa-fax' => esc_html__( 'Fax', 'tomato' ),
        'fa-female' => esc_html__( 'Female', 'tomato' ),
        'fa-fighter-jet' => esc_html__( 'Fighter Jet', 'tomato' ),
        'fa-file-archive-o' => esc_html__( 'File Archive Outline', 'tomato' ),
        'fa-file-audio-o' => esc_html__( 'File Audio Outline', 'tomato' ),
        'fa-file-code-o' => esc_html__( 'File Code Outline', 'tomato' ),
        'fa-file-excel-o' => esc_html__( 'File Excel Outline', 'tomato' ),
        'fa-file-image-o' => esc_html__( 'File Image Outline', 'tomato' ),
        'fa-file-movie-o' => esc_html__( 'File Movie Outline', 'tomato' ),
        'fa-file-o' => esc_html__( 'File Outline', 'tomato' ),
        'fa-file-pdf-o' => esc_html__( 'File Pdf Outline', 'tomato' ),
        'fa-file-photo-o' => esc_html__( 'File Photo Outline', 'tomato' ),
        'fa-file-picture-o' => esc_html__( 'File Picture Outline', 'tomato' ),
        'fa-file-powerpoint-o' => esc_html__( 'File Powerpoint Outline', 'tomato' ),
        'fa-file-sound-o' => esc_html__( 'File Sound Outline', 'tomato' ),
        'fa-file-text-o' => esc_html__( 'File Text Outline', 'tomato' ),
        'fa-file-text' => esc_html__( 'File Text', 'tomato' ),
        'fa-file-video-o' => esc_html__( 'File Video Outline', 'tomato' ),
        'fa-file-word-o' => esc_html__( 'File Word Outline', 'tomato' ),
        'fa-file-zip-o' => esc_html__( 'File Zip Outline', 'tomato' ),
        'fa-file' => esc_html__( 'File', 'tomato' ),
        'fa-files-o' => esc_html__( 'Files Outline', 'tomato' ),
        'fa-film' => esc_html__( 'Film', 'tomato' ),
        'fa-filter' => esc_html__( 'Filter', 'tomato' ),
        'fa-fire-extinguisher' => esc_html__( 'Fire Extinguisher', 'tomato' ),
        'fa-fire' => esc_html__( 'Fire', 'tomato' ),
        'fa-flag-checkered' => esc_html__( 'Flag Checkered', 'tomato' ),
        'fa-flag-o' => esc_html__( 'Flag Outline', 'tomato' ),
        'fa-flag' => esc_html__( 'Flag', 'tomato' ),
        'fa-flash' => esc_html__( 'Flash', 'tomato' ),
        'fa-flask' => esc_html__( 'Flask', 'tomato' ),
        'fa-flickr' => esc_html__( 'Flickr', 'tomato' ),
        'fa-floppy-o' => esc_html__( 'Floppy Outline', 'tomato' ),
        'fa-folder-o' => esc_html__( 'Folder Outline', 'tomato' ),
        'fa-folder-open-o' => esc_html__( 'Folder Outlinepen Outline', 'tomato' ),
        'fa-folder-open' => esc_html__( 'Folder Outlinepen', 'tomato' ),
        'fa-folder' => esc_html__( 'Folder', 'tomato' ),
        'fa-font' => esc_html__( 'Font', 'tomato' ),
        'fa-forward' => esc_html__( 'Forward', 'tomato' ),
        'fa-foursquare' => esc_html__( 'Foursquare', 'tomato' ),
        'fa-frown-o' => esc_html__( 'Frown Outline', 'tomato' ),
        'fa-futbol-o' => esc_html__( 'Futbol Outline', 'tomato' ),
        'fa-gamepad' => esc_html__( 'Gamepad', 'tomato' ),
        'fa-gavel' => esc_html__( 'Gavel', 'tomato' ),
        'fa-gbp' => esc_html__( 'Gbp', 'tomato' ),
        'fa-ge' => esc_html__( 'Ge', 'tomato' ),
        'fa-gear' => esc_html__( 'Gear', 'tomato' ),
        'fa-gears' => esc_html__( 'Gears', 'tomato' ),
        'fa-gift' => esc_html__( 'Gift', 'tomato' ),
        'fa-git-square' => esc_html__( 'Git Square', 'tomato' ),
        'fa-git' => esc_html__( 'Git', 'tomato' ),
        'fa-github-alt' => esc_html__( 'Github Alt', 'tomato' ),
        'fa-github-square' => esc_html__( 'Github Square', 'tomato' ),
        'fa-github' => esc_html__( 'Github', 'tomato' ),
        'fa-gittip' => esc_html__( 'Gittip', 'tomato' ),
        'fa-glass' => esc_html__( 'Glass', 'tomato' ),
        'fa-globe' => esc_html__( 'Globe', 'tomato' ),
        'fa-google-plus-square' => esc_html__( 'Google Plus Square', 'tomato' ),
        'fa-google-plus' => esc_html__( 'Google Plus', 'tomato' ),
        'fa-google-wallet' => esc_html__( 'Google Wallet', 'tomato' ),
        'fa-google' => esc_html__( 'Google', 'tomato' ),
        'fa-graduation-cap' => esc_html__( 'Graduation Cap', 'tomato' ),
        'fa-group' => esc_html__( 'Group', 'tomato' ),
        'fa-h-square' => esc_html__( 'H Square', 'tomato' ),
        'fa-hacker-news' => esc_html__( 'Hacker News', 'tomato' ),
        'fa-hand-o-down' => esc_html__( 'Hand Outline Down', 'tomato' ),
        'fa-hand-o-left' => esc_html__( 'Hand Outline Left', 'tomato' ),
        'fa-hand-o-right' => esc_html__( 'Hand Outline Right', 'tomato' ),
        'fa-hand-o-up' => esc_html__( 'Hand Outline Up', 'tomato' ),
        'fa-hdd-o' => esc_html__( 'Hdd Outline', 'tomato' ),
        'fa-header' => esc_html__( 'Header', 'tomato' ),
        'fa-headphones' => esc_html__( 'Headphones', 'tomato' ),
        'fa-heart-o' => esc_html__( 'Heart Outline', 'tomato' ),
        'fa-heart' => esc_html__( 'Heart', 'tomato' ),
        'fa-history' => esc_html__( 'History', 'tomato' ),
        'fa-home' => esc_html__( 'Home', 'tomato' ),
        'fa-hospital-o' => esc_html__( 'Hospital Outline', 'tomato' ),
        'fa-html5' => esc_html__( 'Html5', 'tomato' ),
        'fa-ils' => esc_html__( 'Ils', 'tomato' ),
        'fa-image' => esc_html__( 'Image', 'tomato' ),
        'fa-inbox' => esc_html__( 'Inbox', 'tomato' ),
        'fa-indent' => esc_html__( 'Indent', 'tomato' ),
        'fa-info-circle' => esc_html__( 'Info Circle', 'tomato' ),
        'fa-info' => esc_html__( 'Info', 'tomato' ),
        'fa-inr' => esc_html__( 'Inr', 'tomato' ),
        'fa-instagram' => esc_html__( 'Instagram', 'tomato' ),
        'fa-institution' => esc_html__( 'Institution', 'tomato' ),
        'fa-ioxhost' => esc_html__( 'Ioxhost', 'tomato' ),
        'fa-italic' => esc_html__( 'Italic', 'tomato' ),
        'fa-joomla' => esc_html__( 'Joomla', 'tomato' ),
        'fa-jpy' => esc_html__( 'Jpy', 'tomato' ),
        'fa-jsfiddle' => esc_html__( 'Jsfiddle', 'tomato' ),
        'fa-key' => esc_html__( 'Key', 'tomato' ),
        'fa-keyboard-o' => esc_html__( 'Keyboard Outline', 'tomato' ),
        'fa-krw' => esc_html__( 'Krw', 'tomato' ),
        'fa-language' => esc_html__( 'Language', 'tomato' ),
        'fa-laptop' => esc_html__( 'Laptop', 'tomato' ),
        'fa-lastfm-square' => esc_html__( 'Lastfm Square', 'tomato' ),
        'fa-lastfm' => esc_html__( 'Lastfm', 'tomato' ),
        'fa-leaf' => esc_html__( 'Leaf', 'tomato' ),
        'fa-legal' => esc_html__( 'Legal', 'tomato' ),
        'fa-lemon-o' => esc_html__( 'Lemon Outline', 'tomato' ),
        'fa-level-down' => esc_html__( 'Level Down', 'tomato' ),
        'fa-level-up' => esc_html__( 'Level Up', 'tomato' ),
        'fa-life-bouy' => esc_html__( 'Life Bouy', 'tomato' ),
        'fa-life-buoy' => esc_html__( 'Life Buoy', 'tomato' ),
        'fa-life-ring' => esc_html__( 'Life Ring', 'tomato' ),
        'fa-life-saver' => esc_html__( 'Life Saver', 'tomato' ),
        'fa-lightbulb-o' => esc_html__( 'Lightbulb Outline', 'tomato' ),
        'fa-line-chart' => esc_html__( 'Line Chart', 'tomato' ),
        'fa-link' => esc_html__( 'Link', 'tomato' ),
        'fa-linkedin-square' => esc_html__( 'Linkedin Square', 'tomato' ),
        'fa-linkedin' => esc_html__( 'Linkedin', 'tomato' ),
        'fa-linux' => esc_html__( 'Linux', 'tomato' ),
        'fa-list-alt' => esc_html__( 'List Alt', 'tomato' ),
        'fa-list-ol' => esc_html__( 'List Outlinel', 'tomato' ),
        'fa-list-ul' => esc_html__( 'List Ul', 'tomato' ),
        'fa-list' => esc_html__( 'List', 'tomato' ),
        'fa-location-arrow' => esc_html__( 'Location Arrow', 'tomato' ),
        'fa-lock' => esc_html__( 'Lock', 'tomato' ),
        'fa-long-arrow-down' => esc_html__( 'Long Arrow Down', 'tomato' ),
        'fa-long-arrow-left' => esc_html__( 'Long Arrow Left', 'tomato' ),
        'fa-long-arrow-right' => esc_html__( 'Long Arrow Right', 'tomato' ),
        'fa-long-arrow-up' => esc_html__( 'Long Arrow Up', 'tomato' ),
        'fa-magic' => esc_html__( 'Magic', 'tomato' ),
        'fa-magnet' => esc_html__( 'Magnet', 'tomato' ),
        'fa-mail-forward' => esc_html__( 'Mail Forward', 'tomato' ),
        'fa-mail-reply-all' => esc_html__( 'Mail Reply All', 'tomato' ),
        'fa-mail-reply' => esc_html__( 'Mail Reply', 'tomato' ),
        'fa-male' => esc_html__( 'Male', 'tomato' ),
        'fa-map-marker' => esc_html__( 'Map Marker', 'tomato' ),
        'fa-maxcdn' => esc_html__( 'Maxcdn', 'tomato' ),
        'fa-meanpath' => esc_html__( 'Meanpath', 'tomato' ),
        'fa-medkit' => esc_html__( 'Medkit', 'tomato' ),
        'fa-meh-o' => esc_html__( 'Meh Outline', 'tomato' ),
        'fa-microphone-slash' => esc_html__( 'Microphone Slash', 'tomato' ),
        'fa-microphone' => esc_html__( 'Microphone', 'tomato' ),
        'fa-minus-circle' => esc_html__( 'Minus Circle', 'tomato' ),
        'fa-minus-square-o' => esc_html__( 'Minus Square Outline', 'tomato' ),
        'fa-minus-square' => esc_html__( 'Minus Square', 'tomato' ),
        'fa-minus' => esc_html__( 'Minus', 'tomato' ),
        'fa-mobile-phone' => esc_html__( 'Mobile Phone', 'tomato' ),
        'fa-mobile' => esc_html__( 'Mobile', 'tomato' ),
        'fa-money' => esc_html__( 'Money', 'tomato' ),
        'fa-moon-o' => esc_html__( 'Moon Outline', 'tomato' ),
        'fa-mortar-board' => esc_html__( 'Mortar Board', 'tomato' ),
        'fa-music' => esc_html__( 'Music', 'tomato' ),
        'fa-navicon' => esc_html__( 'Navicon', 'tomato' ),
        'fa-newspaper-o' => esc_html__( 'Newspaper Outline', 'tomato' ),
        'fa-openid' => esc_html__( 'Openid', 'tomato' ),
        'fa-outdent' => esc_html__( 'Outdent', 'tomato' ),
        'fa-pagelines' => esc_html__( 'Pagelines', 'tomato' ),
        'fa-paint-brush' => esc_html__( 'Paint Brush', 'tomato' ),
        'fa-paper-plane-o' => esc_html__( 'Paper Plane Outline', 'tomato' ),
        'fa-paper-plane' => esc_html__( 'Paper Plane', 'tomato' ),
        'fa-paperclip' => esc_html__( 'Paperclip', 'tomato' ),
        'fa-paragraph' => esc_html__( 'Paragraph', 'tomato' ),
        'fa-paste' => esc_html__( 'Paste', 'tomato' ),
        'fa-pause' => esc_html__( 'Pause', 'tomato' ),
        'fa-paw' => esc_html__( 'Paw', 'tomato' ),
        'fa-paypal' => esc_html__( 'Paypal', 'tomato' ),
        'fa-pencil-square-o' => esc_html__( 'Pencil Square Outline', 'tomato' ),
        'fa-pencil-square' => esc_html__( 'Pencil Square', 'tomato' ),
        'fa-pencil' => esc_html__( 'Pencil', 'tomato' ),
        'fa-phone-square' => esc_html__( 'Phone Square', 'tomato' ),
        'fa-phone' => esc_html__( 'Phone', 'tomato' ),
        'fa-photo' => esc_html__( 'Photo', 'tomato' ),
        'fa-picture-o' => esc_html__( 'Picture Outline', 'tomato' ),
        'fa-pie-chart' => esc_html__( 'Pie Chart', 'tomato' ),
        'fa-pied-piper-alt' => esc_html__( 'Pied Piper Alt', 'tomato' ),
        'fa-pied-piper' => esc_html__( 'Pied Piper', 'tomato' ),
        'fa-pinterest-square' => esc_html__( 'Pinterest Square', 'tomato' ),
        'fa-pinterest' => esc_html__( 'Pinterest', 'tomato' ),
        'fa-plane' => esc_html__( 'Plane', 'tomato' ),
        'fa-play-circle-o' => esc_html__( 'Play Circle Outline', 'tomato' ),
        'fa-play-circle' => esc_html__( 'Play Circle', 'tomato' ),
        'fa-play' => esc_html__( 'Play', 'tomato' ),
        'fa-plug' => esc_html__( 'Plug', 'tomato' ),
        'fa-plus-circle' => esc_html__( 'Plus Circle', 'tomato' ),
        'fa-plus-square-o' => esc_html__( 'Plus Square Outline', 'tomato' ),
        'fa-plus-square' => esc_html__( 'Plus Square', 'tomato' ),
        'fa-plus' => esc_html__( 'Plus', 'tomato' ),
        'fa-power-off' => esc_html__( 'Power Outlineff', 'tomato' ),
        'fa-print' => esc_html__( 'Print', 'tomato' ),
        'fa-puzzle-piece' => esc_html__( 'Puzzle Piece', 'tomato' ),
        'fa-qq' => esc_html__( 'Qq', 'tomato' ),
        'fa-qrcode' => esc_html__( 'Qrcode', 'tomato' ),
        'fa-question-circle' => esc_html__( 'Question Circle', 'tomato' ),
        'fa-question' => esc_html__( 'Question', 'tomato' ),
        'fa-quote-left' => esc_html__( 'Quote Left', 'tomato' ),
        'fa-quote-right' => esc_html__( 'Quote Right', 'tomato' ),
        'fa-ra' => esc_html__( 'Ra', 'tomato' ),
        'fa-random' => esc_html__( 'Random', 'tomato' ),
        'fa-rebel' => esc_html__( 'Rebel', 'tomato' ),
        'fa-recycle' => esc_html__( 'Recycle', 'tomato' ),
        'fa-reddit-square' => esc_html__( 'Reddit Square', 'tomato' ),
        'fa-reddit' => esc_html__( 'Reddit', 'tomato' ),
        'fa-refresh' => esc_html__( 'Refresh', 'tomato' ),
        'fa-remove' => esc_html__( 'Remove', 'tomato' ),
        'fa-renren' => esc_html__( 'Renren', 'tomato' ),
        'fa-reorder' => esc_html__( 'Reorder', 'tomato' ),
        'fa-repeat' => esc_html__( 'Repeat', 'tomato' ),
        'fa-reply-all' => esc_html__( 'Reply All', 'tomato' ),
        'fa-reply' => esc_html__( 'Reply', 'tomato' ),
        'fa-retweet' => esc_html__( 'Retweet', 'tomato' ),
        'fa-rmb' => esc_html__( 'Rmb', 'tomato' ),
        'fa-road' => esc_html__( 'Road', 'tomato' ),
        'fa-rocket' => esc_html__( 'Rocket', 'tomato' ),
        'fa-rotate-left' => esc_html__( 'Rotate Left', 'tomato' ),
        'fa-rotate-right' => esc_html__( 'Rotate Right', 'tomato' ),
        'fa-rouble' => esc_html__( 'Rouble', 'tomato' ),
        'fa-rss-square' => esc_html__( 'Rss Square', 'tomato' ),
        'fa-rss' => esc_html__( 'Rss', 'tomato' ),
        'fa-rub' => esc_html__( 'Rub', 'tomato' ),
        'fa-ruble' => esc_html__( 'Ruble', 'tomato' ),
        'fa-rupee' => esc_html__( 'Rupee', 'tomato' ),
        'fa-save' => esc_html__( 'Save', 'tomato' ),
        'fa-scissors' => esc_html__( 'Scissors', 'tomato' ),
        'fa-search-minus' => esc_html__( 'Search Minus', 'tomato' ),
        'fa-search-plus' => esc_html__( 'Search Plus', 'tomato' ),
        'fa-search' => esc_html__( 'Search', 'tomato' ),
        'fa-send-o' => esc_html__( 'Send Outline', 'tomato' ),
        'fa-send' => esc_html__( 'Send', 'tomato' ),
        'fa-share-alt-square' => esc_html__( 'Share Alt Square', 'tomato' ),
        'fa-share-alt' => esc_html__( 'Share Alt', 'tomato' ),
        'fa-share-square-o' => esc_html__( 'Share Square Outline', 'tomato' ),
        'fa-share-square' => esc_html__( 'Share Square', 'tomato' ),
        'fa-share' => esc_html__( 'Share', 'tomato' ),
        'fa-shekel' => esc_html__( 'Shekel', 'tomato' ),
        'fa-sheqel' => esc_html__( 'Sheqel', 'tomato' ),
        'fa-shield' => esc_html__( 'Shield', 'tomato' ),
        'fa-shopping-cart' => esc_html__( 'Shopping Cart', 'tomato' ),
        'fa-sign-in' => esc_html__( 'Sign In', 'tomato' ),
        'fa-sign-out' => esc_html__( 'Sign Outlineut', 'tomato' ),
        'fa-signal' => esc_html__( 'Signal', 'tomato' ),
        'fa-sitemap' => esc_html__( 'Sitemap', 'tomato' ),
        'fa-skype' => esc_html__( 'Skype', 'tomato' ),
        'fa-slack' => esc_html__( 'Slack', 'tomato' ),
        'fa-sliders' => esc_html__( 'Sliders', 'tomato' ),
        'fa-slideshare' => esc_html__( 'Slideshare', 'tomato' ),
        'fa-smile-o' => esc_html__( 'Smile Outline', 'tomato' ),
        'fa-soccer-ball-o' => esc_html__( 'Soccer Ball Outline', 'tomato' ),
        'fa-sort-alpha-asc' => esc_html__( 'Sort Alpha Asc', 'tomato' ),
        'fa-sort-alpha-desc' => esc_html__( 'Sort Alpha Desc', 'tomato' ),
        'fa-sort-amount-asc' => esc_html__( 'Sort Amount Asc', 'tomato' ),
        'fa-sort-amount-desc' => esc_html__( 'Sort Amount Desc', 'tomato' ),
        'fa-sort-asc' => esc_html__( 'Sort Asc', 'tomato' ),
        'fa-sort-desc' => esc_html__( 'Sort Desc', 'tomato' ),
        'fa-sort-down' => esc_html__( 'Sort Down', 'tomato' ),
        'fa-sort-numeric-asc' => esc_html__( 'Sort Numeric Asc', 'tomato' ),
        'fa-sort-numeric-desc' => esc_html__( 'Sort Numeric Desc', 'tomato' ),
        'fa-sort-up' => esc_html__( 'Sort Up', 'tomato' ),
        'fa-sort' => esc_html__( 'Sort', 'tomato' ),
        'fa-soundcloud' => esc_html__( 'Soundcloud', 'tomato' ),
        'fa-space-shuttle' => esc_html__( 'Space Shuttle', 'tomato' ),
        'fa-spinner' => esc_html__( 'Spinner', 'tomato' ),
        'fa-spoon' => esc_html__( 'Spoon', 'tomato' ),
        'fa-spotify' => esc_html__( 'Spotify', 'tomato' ),
        'fa-square-o' => esc_html__( 'Square Outline', 'tomato' ),
        'fa-square' => esc_html__( 'Square', 'tomato' ),
        'fa-stack-exchange' => esc_html__( 'Stack Exchange', 'tomato' ),
        'fa-stack-overflow' => esc_html__( 'Stack Outlineverflow', 'tomato' ),
        'fa-star-half-empty' => esc_html__( 'Star Half Empty', 'tomato' ),
        'fa-star-half-full' => esc_html__( 'Star Half Full', 'tomato' ),
        'fa-star-half-o' => esc_html__( 'Star Half Outline', 'tomato' ),
        'fa-star-half' => esc_html__( 'Star Half', 'tomato' ),
        'fa-star-o' => esc_html__( 'Star Outline', 'tomato' ),
        'fa-star' => esc_html__( 'Star', 'tomato' ),
        'fa-steam-square' => esc_html__( 'Steam Square', 'tomato' ),
        'fa-steam' => esc_html__( 'Steam', 'tomato' ),
        'fa-step-backward' => esc_html__( 'Step Backward', 'tomato' ),
        'fa-step-forward' => esc_html__( 'Step Forward', 'tomato' ),
        'fa-stethoscope' => esc_html__( 'Stethoscope', 'tomato' ),
        'fa-stop' => esc_html__( 'Stop', 'tomato' ),
        'fa-strikethrough' => esc_html__( 'Strikethrough', 'tomato' ),
        'fa-stumbleupon-circle' => esc_html__( 'Stumbleupon Circle', 'tomato' ),
        'fa-stumbleupon' => esc_html__( 'Stumbleupon', 'tomato' ),
        'fa-subscript' => esc_html__( 'Subscript', 'tomato' ),
        'fa-suitcase' => esc_html__( 'Suitcase', 'tomato' ),
        'fa-sun-o' => esc_html__( 'Sun Outline', 'tomato' ),
        'fa-superscript' => esc_html__( 'Superscript', 'tomato' ),
        'fa-support' => esc_html__( 'Support', 'tomato' ),
        'fa-table' => esc_html__( 'Table', 'tomato' ),
        'fa-tablet' => esc_html__( 'Tablet', 'tomato' ),
        'fa-tachometer' => esc_html__( 'Tachometer', 'tomato' ),
        'fa-tag' => esc_html__( 'Tag', 'tomato' ),
        'fa-tags' => esc_html__( 'Tags', 'tomato' ),
        'fa-tasks' => esc_html__( 'Tasks', 'tomato' ),
        'fa-taxi' => esc_html__( 'Taxi', 'tomato' ),
        'fa-tencent-weibo' => esc_html__( 'Tencent Weibo', 'tomato' ),
        'fa-terminal' => esc_html__( 'Terminal', 'tomato' ),
        'fa-text-height' => esc_html__( 'Text Height', 'tomato' ),
        'fa-text-width' => esc_html__( 'Text Width', 'tomato' ),
        'fa-th-large' => esc_html__( 'Th Large', 'tomato' ),
        'fa-th-list' => esc_html__( 'Th List', 'tomato' ),
        'fa-th' => esc_html__( 'Th', 'tomato' ),
        'fa-thumb-tack' => esc_html__( 'Thumb Tack', 'tomato' ),
        'fa-thumbs-down' => esc_html__( 'Thumbs Down', 'tomato' ),
        'fa-thumbs-o-down' => esc_html__( 'Thumbs Outline Down', 'tomato' ),
        'fa-thumbs-o-up' => esc_html__( 'Thumbs Outline Up', 'tomato' ),
        'fa-thumbs-up' => esc_html__( 'Thumbs Up', 'tomato' ),
        'fa-ticket' => esc_html__( 'Ticket', 'tomato' ),
        'fa-times-circle-o' => esc_html__( 'Times Circle Outline', 'tomato' ),
        'fa-times-circle' => esc_html__( 'Times Circle', 'tomato' ),
        'fa-times' => esc_html__( 'Times', 'tomato' ),
        'fa-tint' => esc_html__( 'Tint', 'tomato' ),
        'fa-toggle-down' => esc_html__( 'Toggle Down', 'tomato' ),
        'fa-toggle-left' => esc_html__( 'Toggle Left', 'tomato' ),
        'fa-toggle-off' => esc_html__( 'Toggle Outlineff', 'tomato' ),
        'fa-toggle-on' => esc_html__( 'Toggle Outlinen', 'tomato' ),
        'fa-toggle-right' => esc_html__( 'Toggle Right', 'tomato' ),
        'fa-toggle-up' => esc_html__( 'Toggle Up', 'tomato' ),
        'fa-trash-o' => esc_html__( 'Trash Outline', 'tomato' ),
        'fa-trash' => esc_html__( 'Trash', 'tomato' ),
        'fa-tree' => esc_html__( 'Tree', 'tomato' ),
        'fa-trello' => esc_html__( 'Trello', 'tomato' ),
        'fa-trophy' => esc_html__( 'Trophy', 'tomato' ),
        'fa-truck' => esc_html__( 'Truck', 'tomato' ),
        'fa-try' => esc_html__( 'Try', 'tomato' ),
        'fa-tty' => esc_html__( 'Tty', 'tomato' ),
        'fa-tumblr-square' => esc_html__( 'Tumblr Square', 'tomato' ),
        'fa-tumblr' => esc_html__( 'Tumblr', 'tomato' ),
        'fa-turkish-lira' => esc_html__( 'Turkish Lira', 'tomato' ),
        'fa-twitch' => esc_html__( 'Twitch', 'tomato' ),
        'fa-twitter-square' => esc_html__( 'Twitter Square', 'tomato' ),
        'fa-twitter' => esc_html__( 'Twitter', 'tomato' ),
        'fa-umbrella' => esc_html__( 'Umbrella', 'tomato' ),
        'fa-underline' => esc_html__( 'Underline', 'tomato' ),
        'fa-undo' => esc_html__( 'Undo', 'tomato' ),
        'fa-university' => esc_html__( 'University', 'tomato' ),
        'fa-unlink' => esc_html__( 'Unlink', 'tomato' ),
        'fa-unlock-alt' => esc_html__( 'Unlock Alt', 'tomato' ),
        'fa-unlock' => esc_html__( 'Unlock', 'tomato' ),
        'fa-unsorted' => esc_html__( 'Unsorted', 'tomato' ),
        'fa-upload' => esc_html__( 'Upload', 'tomato' ),
        'fa-usd' => esc_html__( 'Usd', 'tomato' ),
        'fa-user-md' => esc_html__( 'User Md', 'tomato' ),
        'fa-user' => esc_html__( 'User', 'tomato' ),
        'fa-users' => esc_html__( 'Users', 'tomato' ),
        'fa-video-camera' => esc_html__( 'Video Camera', 'tomato' ),
        'fa-vimeo-square' => esc_html__( 'Vimeo Square', 'tomato' ),
        'fa-vine' => esc_html__( 'Vine', 'tomato' ),
        'fa-vk' => esc_html__( 'Vk', 'tomato' ),
        'fa-volume-down' => esc_html__( 'Volume Down', 'tomato' ),
        'fa-volume-off' => esc_html__( 'Volume Outlineff', 'tomato' ),
        'fa-volume-up' => esc_html__( 'Volume Up', 'tomato' ),
        'fa-warning' => esc_html__( 'Warning', 'tomato' ),
        'fa-wechat' => esc_html__( 'Wechat', 'tomato' ),
        'fa-weibo' => esc_html__( 'Weibo', 'tomato' ),
        'fa-weixin' => esc_html__( 'Weixin', 'tomato' ),
        'fa-wheelchair' => esc_html__( 'Wheelchair', 'tomato' ),
        'fa-wifi' => esc_html__( 'Wifi', 'tomato' ),
        'fa-windows' => esc_html__( 'Windows', 'tomato' ),
        'fa-won' => esc_html__( 'Won', 'tomato' ),
        'fa-wordpress' => esc_html__( 'Wordpress', 'tomato' ),
        'fa-wrench' => esc_html__( 'Wrench', 'tomato' ),
        'fa-xing-square' => esc_html__( 'Xing Square', 'tomato' ),
        'fa-xing' => esc_html__( 'Xing', 'tomato' ),
        'fa-yahoo' => esc_html__( 'Yahoo', 'tomato' ),
        'fa-yelp' => esc_html__( 'Yelp', 'tomato' ),
        'fa-yen' => esc_html__( 'Yen', 'tomato' ),
        'fa-youtube-play' => esc_html__( 'Youtube Play', 'tomato' ),
        'fa-youtube-square' => esc_html__( 'Youtube Square', 'tomato' ),
        'fa-youtube' => esc_html__( 'Youtube', 'tomato' )
     );
}

function spyropress_get_options_social() {

    return array(
        'dribbble' => esc_html__( 'Dribbble', 'tomato' ),
        'dropbox' => esc_html__( 'Dropbox', 'tomato' ),
        'envelope' => esc_html__( 'Envelope', 'tomato' ),
        'facebook' => esc_html__( 'FaceBook', 'tomato' ),
        'facebook-square' => esc_html__( 'FaceBook Square', 'tomato' ),
        'foursquare' => esc_html__( 'Foursquare', 'tomato' ),
        'github' => esc_html__( 'Github ', 'tomato' ),
        'google-plus' => esc_html__( 'Google+', 'tomato' ),
        'instagram' => esc_html__( 'Instagram', 'tomato' ),
        'linkedin' => esc_html__( 'Linkedin', 'tomato' ),
        'maxcdn' => esc_html__( 'Maxcdn', 'tomato' ),
        'pinterest' => esc_html__( 'Pinterest', 'tomato' ),
        'rss' => esc_html__( 'Rss', 'tomato' ),
        'skype' => esc_html__( 'Skype', 'tomato' ),
        'tumblr' => esc_html__( 'Tumblr', 'tomato' ),
        'twitter' => esc_html__( 'Twitter', 'tomato' ),
        'vk' => esc_html__( 'Vk', 'tomato' ),
        'vimeo' => esc_html__( 'Vimeo', 'tomato' ),
        'youtube' => esc_html__( 'Youtube', 'tomato' ), 
        'youtube-play' => esc_html__( 'Youtube Play', 'tomato' ), 
        'yelp' => esc_html__('Yelp', 'tomato'),
    );

}

function spyropress_get_options_animation() {

    return array(
        'flash' => esc_html__( 'flash', 'tomato' ),
        'shake' => esc_html__( 'shake', 'tomato' ),
        'bounce' => esc_html__( 'bounce', 'tomato' ),
        'tada' => esc_html__( 'tada', 'tomato' ),
        'swing' => esc_html__( 'swing', 'tomato' ),
        'wobble' => esc_html__( 'wobble', 'tomato' ),
        'wiggle' => esc_html__( 'wiggle', 'tomato' ),
        'pulse' => esc_html__( 'pulse', 'tomato' ),
        'fadeIn' => esc_html__( 'fadeIn', 'tomato' ),
        'fadeInUp' => esc_html__( 'fadeInUp', 'tomato' ),
        'fadeInDown' => esc_html__( 'fadeInDown', 'tomato' ),
        'fadeInLeft' => esc_html__( 'fadeInLeft', 'tomato' ),
        'fadeInRight' => esc_html__( 'fadeInRight', 'tomato' ),
        'fadeInUpBig' => esc_html__( 'fadeInUpBig', 'tomato' ),
        'fadeInDownBig' => esc_html__( 'fadeInDownBig', 'tomato' ),
        'fadeInLeftBig' => esc_html__( 'fadeInLeftBig', 'tomato' ),
        'fadeInRightBig' => esc_html__( 'fadeInRightBig', 'tomato' ),
        'flipInX' => esc_html__( 'flipInX', 'tomato' ),
        'flipInY' => esc_html__( 'flipInY', 'tomato' ),
        'bounceIn' => esc_html__( 'bounceIn', 'tomato' ),
        'bounceInUp' => esc_html__( 'bounceInUp', 'tomato' ),
        'bounceInDown' => esc_html__( 'bounceInDown', 'tomato' ),
        'bounceInLeft' => esc_html__( 'bounceInLeft', 'tomato' ),
        'bounceInRight' => esc_html__( 'bounceInRight', 'tomato' ),
        'rotateIn' => esc_html__( 'rotateIn', 'tomato' ),
        'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'tomato' ),
        'rotateInDownLeft' => esc_html__( 'rotateInDownLeft', 'tomato' ),
        'rotateInUpRight' => esc_html__( 'rotateInUpRight', 'tomato' ),
        'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'tomato' )
    );

}

function spyropress_get_social_icons( $spyropress_id = '' ){
    
    //Check
    if( empty( $spyropress_id ) )return;
    
    $spyropress_social_icons = '';
    foreach( $spyropress_id as $spyropress_icons ){
        $spyropress_link = isset($spyropress_icons['spyropress_link']) ? $spyropress_icons['spyropress_link'] : '' ;
        $spyropress_icon = isset($spyropress_icons['spyropress_icon']) ? $spyropress_icons['spyropress_icon'] : '';
        $spyropress_social_icons .= '<a href="'. esc_url( $spyropress_link ) .'" target="_blank"><i class="fa fa-'. esc_attr( $spyropress_icon ) .'"></i></a>';
    }
    
    //Return HTML
    return $spyropress_social_icons;
}