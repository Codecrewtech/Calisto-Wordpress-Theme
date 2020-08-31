<?php
/**
 * 404 page.
 *
 * @package Tomato
 * @author ThemeSuared
 * @link http://themesuared.com/tomato/
 */

 get_header(); 
    
    //Translation Value.
    $spyropress_translate['404-title'] = get_setting( 'translate' ) ? get_setting( 'error-404-title', '404' ) : esc_html__( '404', 'tomato' );
    $spyropress_translate['404-subtitle'] = get_setting('translate') ? get_setting( 'error-404-subtitle', 'We`re sorry, but the page you are looking for doesn`t exist.' ) : esc_html__( 'We`re sorry, but the page you are looking for doesn`t exist.', 'tomato' );
    $spyropress_translate['404-btn'] = get_setting('translate') ? get_setting( 'error-404-btn', 'Back to home' ) : esc_html__( 'Back to home', 'tomato' );

    get_template_part( 'templates/page', 'breadcrumb' );  //Include Page Breadcrumb Html. 
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="giant-space">
                    <h2 class="text-giant"><?php echo esc_html( $spyropress_translate['404-title'] ); ?></h2>
                    <p class="wow fadeInUp"><?php echo esc_html( $spyropress_translate['404-subtitle'] ); ?></p>
                    <p class="top-space-lg"><a href="<?php echo esc_url( site_url() ); ?>" class="btn btn-default btn-lg"><?php echo esc_html( $spyropress_translate['404-btn'] ); ?></a></p>
                </div>
            </div>
        </div>
    </div>
    
<?php get_footer(); ?>