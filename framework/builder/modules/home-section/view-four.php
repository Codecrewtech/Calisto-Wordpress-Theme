<?php if( !empty( $spyropress_slides_two ) ): ?>
    <div class="hero-slider">
        
         <?php foreach( $spyropress_slides_two as $spyropress_slides ): ?>
             <div class="slider-item" style="background:url(<?php echo ''.$spyropress_slides['spyropress_image']?>) no-repeat center;" >
                 <div class="slider-content">
                     <?php 
                        //Heading
                        if( isset( $spyropress_slides['spyropress_heading'] ) && !empty( $spyropress_slides['spyropress_heading'] ) ){
                            echo '<h1>'. $spyropress_slides['spyropress_heading'] .'</h1>';
                        }
                        
                        //Sub Heading
                        if( isset( $spyropress_slides['spyropress_sub_heading'] ) && !empty( $spyropress_slides['spyropress_sub_heading'] ) ){
                            echo '<h2>'. $spyropress_slides['spyropress_sub_heading'] .'</h2>';
                        }
                     ?>
                 </div>
             </div>
         <?php endforeach; ?>
         
    </div>
<?php endif; 