<?php

/**
 * Enqueue scripts and stylesheets
 *
 * @category Core
 * @package SpyroPress
 *
 */

function spyropress_montserrat() {
    $fonts_url = '';
    $montserrat = _x('on','Montserrat font: on or off','tomato');
     if ( 'off' !== $montserrat ) {
        $query_args = array(
        'family' =>  'Montserrat:400,700', 
        'subset' => urlencode( 'latin,latin-ext' )
        );
      }
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    return esc_url_raw( $fonts_url );
} 
function spyropress_lato() {
    $fonts_url = '';
    $lato = _x('on','Lato font: on or off','tomato');
     if ( 'off' !== $lato ) {
        $query_args = array(
        'family' =>  'Lato:400,100,300,300italic,400italic,700,900', 
        'subset' => urlencode( 'latin,latin-ext' )
        );
      }
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    return esc_url_raw( $fonts_url );
} 
 

/**
 * Register StyleSheets
 */
function spyropress_register_stylesheets() {

    /* Add Google font */
    wp_enqueue_style( 'spyropress_montserrat-font', spyropress_montserrat(), array(), null );
    wp_enqueue_style( 'spyropress_lato-font', spyropress_lato(), array(), null );

    // Default stylesheets
    wp_enqueue_style( 'tomato-bootstrap', assets_css() . 'bootstrap.min.css', false, false );
    wp_enqueue_style( 'tomato-animate', assets_css() . 'animate.min.css', false, false );
    wp_enqueue_style( 'tomato-font-awesome', assets_css() . 'font-awesome/css/font-awesome.css', false, false );
    wp_enqueue_style( 'tomato-plugin', assets_css() . 'plugin.css', false, false );
    wp_enqueue_style( 'tomato-vegas', assets_js() . 'vendor/vegas/vegas.min.css', false, false );
    wp_enqueue_style( 'tomato-main', assets_css() . 'main.css', false, false );
    
    //Theme Skin Color.
    if( $spyropress_skin = get_setting( 'theme_skin', false ) ){
        wp_enqueue_style( "spyropress-skin-$spyropress_skin", assets_css() . "skins/$spyropress_skin.css", false, false );
    }
    
    // Dynamic StyleSheet
    if ( file_exists( dynamic_css_path() . 'dynamic.css' ) )
        wp_enqueue_style( 'dynamic', dynamic_css_url() . 'dynamic.css', false, false );

    // Builder StyleSheet
    if ( file_exists( dynamic_css_path() . 'builder.css' ) )
        wp_enqueue_style( 'builder', dynamic_css_url() . 'builder.css', false, false );
    
}

/**
 * Enqueque Scripts
 */
function spyropress_register_scripts() {

    wp_enqueue_script( 'jquery' );
    /**
     * Register Scripts
     */
    // threaded comments
    if ( is_single() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    // Plugins
    wp_register_script( 'tomato-jquery-bootstrap', assets_js() . 'vendor/bootstrap.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-flexslider', assets_js() . 'vendor/jquery.flexslider-min.js', false, false, true );
    wp_register_script( 'tomato-jquery-spectragram', assets_js() . 'vendor/spectragram.js', false, false, true );
    wp_register_script( 'tomato-jquery-carousel', assets_js() . 'vendor/owl.carousel.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-velocity', assets_js() . 'vendor/velocity.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-velocity-ui', assets_js() . 'vendor/velocity.ui.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-bootstrap-datepicker', assets_js() . 'vendor/bootstrap-datepicker.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-bootstrap-clockpicker', assets_js() . 'vendor/bootstrap-clockpicker.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-magnific', assets_js() . 'vendor/jquery.magnific-popup.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-isotope', assets_js() . 'vendor/isotope.pkgd.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-slick', assets_js() . 'vendor/slick.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-appear', assets_js() . 'vendor/jquery.appear.js', false, false, true );
    wp_register_script( 'tomato-jquery-animation', assets_js() . 'animation.js', false, false, true );
    wp_register_script( 'tomato-jquery-vegas', assets_js() . 'vendor/vegas/vegas.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-YTPlayer', assets_js() . 'vendor/jquery.mb.YTPlayer.js', false, false, true );
    wp_register_script( 'tomato-jquery-stellar', assets_js() . 'vendor/jquery.stellar.js', false, false, true );
    wp_register_script( 'tomato-jquery-ketchup', assets_js() . 'vendor/mc/jquery.ketchup.all.min.js', false, false, true );
    wp_register_script( 'tomato-jquery-mc-main', assets_js() . 'vendor/mc/main.js', false, false, true );
    //wp_register_script( 'tomato-jquery-reservation', assets_js() . 'reservation.js', false, false, true );

    
     // style switcher
    wp_register_script( 'tomato-jquery-cookie', assets() . 'master/style-switcher/jquery.cookie.js', false, false, true );
    wp_register_script( 'tomato-jquery-style-switcher', assets() . 'master/style-switcher/style.switcher.js', false, false, true );
   

    $spyropress_deps = array(
        'tomato-jquery-bootstrap',
        'tomato-jquery-flexslider',
        'tomato-jquery-spectragram',
        'tomato-jquery-carousel',
        'tomato-jquery-velocity',
        'tomato-jquery-velocity-ui',
        'tomato-jquery-bootstrap-datepicker',
        'tomato-jquery-bootstrap-clockpicker',
        'tomato-jquery-magnific',
        'tomato-jquery-isotope',
        'tomato-jquery-slick',
        'tomato-jquery-appear',
        'tomato-jquery-animation',
        'tomato-jquery-vegas',
        'tomato-jquery-YTPlayer',
        'tomato-jquery-stellar',
        'tomato-jquery-ketchup',
        'tomato-jquery-mc-main',
        //'tomato-jquery-reservation'
    );
    
    if( current_theme_supports( 'theme-demo' )  ) {
        $spyropress_deps[] = 'tomato-jquery-cookie';
        $spyropress_deps[] = 'tomato-jquery-style-switcher';
    }
    
    // main scripts
    wp_register_script( 'main-script', assets_js() . 'main.js', $spyropress_deps, false, true );

    /**
     * Enqueue All
     */
    wp_enqueue_script( 'main-script' );
    
    /**
     * Enqueue Theme Settings
     */
    $spyropress_theme_settings = array(
        'assets' => assets()
    );
    wp_localize_script( 'tomato-jquery-bootstrap', 'theme_settings', $spyropress_theme_settings );

}

function spyropress_conditional_scripts() {

    $spyropress_content = '<!--[if lt IE 9]>
            <script src="'. assets_js() .'vendor/html5-3.6-respond-1.4.2.min.js"></script>
        <![endif]-->';

    echo get_relative_url( $spyropress_content );
}