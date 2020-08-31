<div class="row about2" <?php echo spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ); ?>>
    <div class="col-md-5">
        <?php if( $spyropress_image ): ?>
            <img src="<?php echo esc_url( $spyropress_image ); ?>" class="img-responsive"  />
        <?php endif; ?>
    </div>
    <div class="col-md-7 text-left">
        <?php 
            //Module Title.
            if( $spyropress_title ){
                echo '<h2 class="text-left">'. esc_html( $spyropress_title ) .'</h2>';
            }
            //Module Content.
            if( $spyropress_content ){
                echo '<p>'. esc_html( $spyropress_content ) .'</p>';
            }
            //Module Button
            if( $spyropress_url ){
                echo '<a class="btn btn-default" role="button" href="'. esc_url( $spyropress_url ) .'">'. esc_html( $spyropress_btn_text ) .'</a>';
            }
        ?>
    </div>
</div>