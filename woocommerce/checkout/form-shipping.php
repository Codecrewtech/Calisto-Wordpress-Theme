<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields billing-details">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

        <h3 class="text-left"><?php _e( 'Ship to a different address?', 'tomato' ); ?></h3>
        
        <br />
        
		<div class="shipping_address text-left">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<?php foreach ( $checkout->get_checkout_fields( 'shipping' )  as $key => $field ) : ?>
            
               <?php 
                    /*if( is_str_contain( 'first_name', $key ) ) {
                        $field['return'] = true;
                        $output = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        $output = str_replace( 'col-md-12', 'col-md-6', $output );
                        echo str_replace( '</div></div>', '</div>', $output );
                    }
                    if( is_str_contain( 'last_name', $key ) ) {
                        $field['return'] = true;
                        
                        $output = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        $output = str_replace( 'col-md-12', 'col-md-6', $output );
                        $output = str_replace( 'row', ' ', $output );
                        echo str_replace( '</div></div>', '</div></div></div>', $output );
                    }
                    if( is_str_contain( 'city', $key ) ) {
                        $field['return'] = true;
                        $output = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        $output = str_replace( 'col-md-12', 'col-md-4', $output );
                        echo str_replace( '</div></div>', '</div>', $output );
                    }
                    if( is_str_contain( 'state', $key ) ) {
                        $field['return'] = true;
                        $output = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        $output = str_replace( 'col-md-12', 'col-md-4', $output );
                        echo $output = str_replace( 'row', ' ', $output );
                    }
                    if( is_str_contain( 'postcode', $key ) ) {
                        $field['return'] = true;
                        
                        $output = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        $output = str_replace( 'col-md-12', 'col-md-4', $output );
                        $output = str_replace( 'row', ' ', $output );
                        echo str_replace( '</div></div>', '</div></div></div>', $output );
                    }                
                    else {
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                    }*/
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
             ?>

			<?php endforeach; ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" id="ship-to-different-address">
                        <input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
                        <label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'tomato' ); ?></label>
	                </div>
                </div>
            </div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

		<div class="billing-details">

            <div class="text-left">  
             
            	<?php foreach ( $checkout->get_checkout_fields( 'order' )  as $key => $field ) : ?>
            
            		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
            
            	<?php endforeach; ?>
            </div>
            
        </div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>

