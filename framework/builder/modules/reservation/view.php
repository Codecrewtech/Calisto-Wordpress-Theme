<div class="reservation" <?php echo spyropress_build_atts( array( 'animation' => esc_attr( $spyropress_animation ) , 'animation-delay' => esc_attr( $spyropress_delay ) ), 'data-' ); ?>>
    <?php if( $spyropress_contact_frm ): ?>
    <div class="reservation-form">
         <div id="reservationform">
            <?php echo do_shortcode( $spyropress_contact_frm );?>
         </div>
    </div>
    <?php endif; 
          if( $spyropress_frm_footer ):  
    ?>
    <div class="reservation-footer">
        <p><?php echo wp_kses( $spyropress_frm_footer, array( 'strong' => array() ) ); ?></p>
        <span></span>
    </div>
    <?php endif; ?>
</div>