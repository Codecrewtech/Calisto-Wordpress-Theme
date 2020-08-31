<?php
echo wp_kses_post( $before_widget );

    //Widget Title.
    if ( '' != $spyropress_title ){
        echo wp_kses_post( $before_title.$spyropress_title.$after_title );
    }
    
    //Social Icons.
    if( $spyropress_socials ){
        echo '<div class="footer-social-icons">'. spyropress_get_social_icons( $spyropress_socials ) .'</div>';
    }
        
    //Widget Content.
    echo '<div class="footer-address">';
    
        if ( $spyropress_address ) 
            echo '<p><i class="fa fa-map-marker"></i>'. esc_html( $spyropress_address  ) .'</p>';
    
        if ( $spyropress_phone ) 
            echo '<p><i class="fa fa-phone"></i>Phone: '. esc_html( $spyropress_phone  ) .'</p>' ;
                 
        if ( $spyropress_email ) 
            echo '<p><i class="fa fa-envelope-o"></i>'. esc_html( $spyropress_email  ) .'</p>' ;
    
    echo '</div>';

echo wp_kses_post( $after_widget );