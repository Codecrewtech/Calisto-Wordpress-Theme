<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields billing-details">

	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3 class="text-left"><?php _e( 'Billing &amp; Shipping', 'tomato' ); ?></h3>

	<?php else : ?>

		<h3 class="text-left"><?php _e( 'Billing Details', 'tomato' ); ?></h3>

	<?php endif; ?>
    
    <br />
    
	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>
    
    <div class="text-left">        

    	<?php foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ) : ?>
    
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
    
    	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
    
    	<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
    
    		<?php if ( ! $checkout->is_registration_required() ) : ?>
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-row form-row-wide create-account">
                            <input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <span for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'tomato' ); ?></span>
                        </div>
                    </div>
                </div>                
    
    		<?php endif; ?>
    
    		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
    
    		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
            
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group create-account">
                            <?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'tomato' ); ?>
                        </div>
                    </div>
                </div>                
    
    			<div class="create-account">
    
    				<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
    
    					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
    
    				<?php endforeach; ?>
    
    				<div class="clear"></div>
    
    			</div>
    
    		<?php endif; ?>
    
    		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
    
    	<?php endif; ?>
        
     </div>  
                      
</div><br />