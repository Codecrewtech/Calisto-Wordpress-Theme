<div class="row about" <?php echo spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ); ?>>
    <div class="col-md-4">
        <?php if( isset( $spyropress_images ) ): ?>
        <div class="container-fluid">
            <div class="row">
            <?php
                $spyropress_counter = 1; 
                foreach( $spyropress_images as $spyropress_image ): 
                    
                    //Get Popup Image.
                    $spyropress_popup_image = isset( $spyropress_image['spyropress_popup_image'] )? 'data-mfp-src="'. esc_url( $spyropress_image['spyropress_popup_image'] ) .'"' : '';

                    if( 1 ==  $spyropress_counter):
                ?>
                
                    <div class="col-xs-12 hidden-sm about-photo">
                        <div class="image-thumb">
                            <?php if ( isset( $spyropress_image['spyropress_front_image'] ) ): ?>
                                <?php printf( '<img src="%1$s" %2$s class="img-responsive" alt="logo">', esc_url( $spyropress_image['spyropress_front_image'] ), $spyropress_popup_image ); ?>
                            <?php endif ?>
                        </div>
                    </div>
            
                <?php else: ?>
               
                    <div class="col-sm-6 about-photo hidden-xs">
                        <?php if ( isset( $spyropress_image['spyropress_front_image'] ) ): ?>
                        <?php printf( '<img src="%1$s" %2$s class="img-responsive" alt="logo">', esc_url( $spyropress_image['spyropress_front_image'] ), $spyropress_popup_image ); ?>
                         <?php endif ?>
                    </div>
                 <?php 
                        endif; 
                        //Counter Increments.
                        if( 3 == $spyropress_counter ):
                            $spyropress_counter = 1;
                        else:
                            $spyropress_counter++;
                        endif;
                    endforeach;
                ?>       
               </div> 
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-8">
        <?php 
            //Module Contents.
            if( isset( $spyropress_content ) ){
                echo wp_kses( $spyropress_content, array( 'p' => array(), 'br' => array() ) );
            }
            
            //Module signature Image.
            if( isset( $spyropress_signature ) ){
                echo '<img src="'. esc_url( $spyropress_signature ) .'" alt="signature">';
            }
        ?>
        
    </div>
</div>