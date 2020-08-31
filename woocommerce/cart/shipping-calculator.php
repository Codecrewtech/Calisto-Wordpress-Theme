<?php
/**
* Shipping Calculator
*
* @author 		WooThemes
* @package 	WooCommerce/Templates
* @version     3.5.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

//if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() )
 //return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<div class="box">

    <h4 class="text-left"><?php _e( 'Calculate Shipping', 'tomato' ); ?></h4>
    
    <form class="shipping_calculator billing-details text-left" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post" class="table table-bordered col-md-6 col-sm-12 table-dark">
       
       <table  class="table table-bordered table-dark"> 
        
            <tbody>
        
                <tr class="country">
                    <td><div class="text-left"><strong><?php _e( 'Country', 'tomato' ); ?></strong></div></td>
                    <td>
                		<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state form-control" rel="calc_shipping_state">
                			<option value=""><?php _e( 'Select a country&hellip;', 'tomato' ); ?></option>
                 		     <?php
            					foreach( WC()->countries->get_shipping_countries() as $key => $value )
            						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
            				?>
                		</select>
                    </td>
                </tr>
                    
            	<tr class="state">
                    <td><div class="text-left"><strong><?php _e( 'State / county', 'tomato' ); ?></strong></div></td>
                    <td>
                        <?php
         				    $current_cc = WC()->customer->get_shipping_country();
				            $current_r  = WC()->customer->get_shipping_state();
				            $states     = WC()->countries->get_states( $current_cc );
                
                			// Hidden Input
                			if ( is_array( $states ) && empty( $states ) ) {
                
           				?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'tomato' ); ?>" /><?php
                
            			// Dropdown Input
            			} elseif ( is_array( $states ) ) {
            
            				?>
        					<select class="form-control" name="calc_shipping_state" id="calc_shipping_state">
        						<option value=""><?php _e( 'Select a state&hellip;', 'tomato' ); ?></option>
        						<?php
        							foreach ( $states as $ckey => $cvalue )
        								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' .  $cvalue  .'</option>';
        						?>
        					</select>
         				<?php
            
                			// Standard Input
                			} else {
                
                				?><input type="text" class="form-control" value="<?php echo esc_attr( $current_r ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php
                
                			}
                        ?>
                    </td>
                </tr>
                <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
                    <tr class="state">
                        <td><div class="text-left"><strong><?php _e( 'Postcode / Zip', 'tomato' ); ?></strong></div></td>
                        <td><input type="text" class="form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" /></td>
                    </tr>
                <?php endif; ?>
            
            	<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
                     <tr class="state">
                        <td><div class="text-left"><strong><?php _e( 'City', 'tomato' ); ?></strong></div></td>
                        <td><input type="text" class="form-control input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'tomato' ); ?>" name="calc_shipping_city" id="calc_shipping_city" /></td>    
                     </tr>   
            	<?php endif; ?>
                
            <tbody>
            
         </table>
         
         <p><button type="submit" name="calc_shipping" value="1" class="btn btn-default"><?php _e( 'Update Totals', 'tomato' ); ?></button></p>
         
         <?php wp_nonce_field( 'woocommerce-cart' ); ?>
             
    </form>
    
</div>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>