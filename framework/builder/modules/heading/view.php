<?php  
//Module Contents.
if( $spyropress_heading ){
    $spyropress_extra_cls = isset( $spyropress_color )? 'class="white"' : '';
    printf( '<div class="page-header" %1$s><%2$s %4$s>%3$s</%2$s></div>', spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ), esc_attr( $spyropress_html_tag ), wp_kses( $spyropress_heading, array( 'small' => array() ) ), $spyropress_extra_cls );
}   