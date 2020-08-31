<?php
//Check
if( empty( $spyropress_teasers ) ) return; 

//Arguments.
$spyropress_atts = array(
    'callback' => array( $this, 'spyropress_generate_teaser_one' ),
    'columns' => $spyropress_columns,
    'row' => false
);

//Info Teaser Item Columns.
echo  '<div class="row features" '. spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ) .'>'. spyropress_column_generator( $spyropress_atts, $spyropress_teasers ) .'</div>';