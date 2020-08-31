<?php
//Check
if( empty( $spyropress_teasers ) ) return; 

//Arguments.
$spyropress_atts = array(
    'callback' => array( $this, 'spyropress_generate_teaser_two' ),
    'columns' => false,
    'row' => false
);

//Info Teaser Item Columns.
echo  '<div class="row services-slider" '. spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ) .'>'. spyropress_column_generator( $spyropress_atts, $spyropress_teasers ) .'</div>';