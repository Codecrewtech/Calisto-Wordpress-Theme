<div class="col-md-10 col-md-offset-1">
    <div class="row">
        <div class="col-md-6">
            <?php
                //Heading. 
                if( $spyropress_title ){
                    echo '<h3 class="text-left no-margin-top">'. esc_html( $spyropress_title ) .'</h3>';
                }
            ?>
            <div class="footer-address contact-info">
                <?php 
                    //Address.
                    if( $spyropress_address ){
                        echo '<p><i class="fa fa-map-marker"></i>'.$spyropress_address .'</p>';
                    }
                    //Phone
                    if( $spyropress_phone ){
                        echo '<p><i class="fa fa-phone"></i>'. $spyropress_phone .'</p>';
                    }
                    //Email
                    if( $spyropress_email ){
                        echo '<p><i class="fa fa-map-marker"></i>'.  $spyropress_email .'</p>';
                    }
                    
                ?>
            </div>
            <br />
            
            <?php 
                //Sub Heading.
                if( $spyropress_sub_title ){
                    echo '<h3 class="text-left no-margin-top">'.  $spyropress_sub_title .'</h3>';
                }
            ?>
            <div class="contact-info text-muted">
                <?php 
                    //Times.
                    if( $spyropress_times ){
                        foreach( $spyropress_times as $spyropress_time ){
                            $spyropress_start = isset($spyropress_time['spyropress_start']) ? $spyropress_time['spyropress_start'].__( ' to', 'tomato' ) : '';
                            $spyropress_end = isset($spyropress_time['spyropress_end']) ? $spyropress_time['spyropress_end'] : '';
                            $spyropress_day = isset($spyropress_time['spyropress_day']) ? __( 'on ', 'tomato' ).$spyropress_time['spyropress_day'] : '';
                            echo '<p>'. esc_html( $spyropress_start ) .' '. esc_html( $spyropress_end ) .' '. esc_html( $spyropress_day ) .'</p>';
                        }
                    }
                ?>
            </div>
            <br />
            
            <?php 
                //Heading.
                if( $spyropress_icon_title ){
                    echo '<h3 class="text-left no-margin-top">'. esc_html( $spyropress_icon_title ) .'</h3>';
                }
                
                //Social Icons.
                if( $spyropress_socials ){
                    echo '<div class="contact-social">';
                    foreach( $spyropress_socials as $spyropress_social ){
                        if(!empty($spyropress_social['spyropress_link']) && !empty($spyropress_social['spyropress_icon']))
                        echo ' <a href="'. esc_url( $spyropress_social['spyropress_link'] ) .'"><i class="fa fa-'. esc_attr( $spyropress_social['spyropress_icon'] ) .'"></i></a>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
        <div class="col-md-6">
            <?php 
                //Shortcode.
                if( $spyropress_contact_frm ){
                    echo do_shortcode( $spyropress_contact_frm );
                }
            ?>
        </div>
    </div>
</div>