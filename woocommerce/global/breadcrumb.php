<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    //Get Page Option Value.
    $spyropress_page_options = get_post_meta( get_the_ID(), '_page_options', true );
    if( isset( $spyropress_page_options['page_breadcrumb'] ) || get_setting( 'page_breadcrumb' ) ){
        return;   //check breadcrumb enable / disable options.
    }
   
    //Get page short description.
    $spyropress_page_breadcrumb_dec = isset( $spyropress_page_options['page_breadcrumb_dec'] )? '<p>'. esc_html( $spyropress_page_options['page_breadcrumb_dec'] ) .'</p>' : '<p>'. esc_html( get_setting( 'page_breadcrumb_dec' ) ) .'</p>';        
   
    //Get page breadcrumb background
    $spyropress_page_breadcrumb_bg = isset( $spyropress_page_options['page_breadcrumb_bg'] )? $spyropress_page_options['page_breadcrumb_bg'] : get_setting_array( 'page_breadcrumb_bg' );       
   
    //Set page breadcrumb options.
    $spyropress_style = '';
    if( isset( $spyropress_page_breadcrumb_bg) && !empty( $spyropress_page_breadcrumb_bg ) ) {
        $spyropress_value = $spyropress_page_breadcrumb_bg;
        $spyropress_img = '';
        $spyropress_bg_contents = array();

        if ( isset( $spyropress_value['background-color'] ) )
            $spyropress_bg_contents[] = $spyropress_value['background-color'];

        if ( isset( $spyropress_value['background-pattern'] ) )
            $spyropress_img = $spyropress_value['background-pattern'];
        elseif ( isset( $spyropress_value['background-image'] ) )
            $spyropress_img = $spyropress_value['background-image'];
        if ( $spyropress_img )
            $spyropress_bg_contents[] = 'url(\'' . esc_url( $spyropress_img ) . '\')';

        if ( isset( $spyropress_value['background-repeat'] ) )
            $spyropress_bg_contents[] = $spyropress_value['background-repeat'];

        if ( isset( $spyropress_value['background-attachment'] ) )
            $spyropress_bg_contents[] = $spyropress_value['background-attachment'];

        if ( isset( $spyropress_value['background-position'] ) )
            $spyropress_bg_contents[] = $spyropress_value['background-position'];

        $spyropress_style .= ( !empty( $spyropress_bg_contents ) ) ? ' background: ' . join( ' ', $spyropress_bg_contents ) . '; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;' : '';
   
        if( !empty( $spyropress_style ) )
            $spyropress_style = 'style="' . $spyropress_style . '"';
    }
    
    if ( ! empty( $breadcrumb ) ) {
        
        ?>
        <section class="page_header" <?php echo ''.$spyropress_style; ?>>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="text-uppercase">
                            <?php 

                                echo woocommerce_page_title();
                             ?>
                        </h2>
                        <?php echo wp_kses( $spyropress_page_breadcrumb_dec, array( 'p' => array(), 'br' => array() ) ); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php 
    }