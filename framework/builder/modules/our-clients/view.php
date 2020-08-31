<?php
//Check 
if( empty( $spyropress_clients ) ) return;
 
//Module Contents.    
echo '<div class="trusted-sponsors" '. spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ) .'>';
    
    foreach( $spyropress_clients as $spyropress_client ){
        
        if( isset($spyropress_client['spyropress_link']) ){
            $spyropress_target = isset( $spyropress_window )? 'target="_blank"' : '';
            echo '<a href="'. esc_url( $spyropress_client['spyropress_link'] ) .'" '. $spyropress_target .'><img  src="' . esc_url( $spyropress_client['spyropress_logo'] ) . '"></a>';     
        }else{
            echo '<img  src="' . esc_url( $spyropress_client['spyropress_logo'] ) . '">';      
        }
    }
        
echo '</div>';
