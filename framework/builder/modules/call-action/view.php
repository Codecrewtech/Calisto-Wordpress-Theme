<div class="subscribe">	
	<?php
        //Module Title.
        if ( !empty( $spyropress_title ) ){
          echo '<div class="col-md-3"><h1>' . esc_html( $spyropress_title ) . '</h1></div>';  
        } 
        
        //Module Sub Title.
        if ( !empty( $spyropress_sub_title ) ){
            echo '<div class="col-md-5"><p>' . esc_html( $spyropress_sub_title ) . '</p></div>';
        } 
        
        //Mailchaimp Form Shortcode.
        if ( !empty( $spyropress_frm_shortcode ) ){
            echo '<div class="col-md-4">'. do_shortcode( $spyropress_frm_shortcode ) .'</div>';
        } 
    ?>
</div>