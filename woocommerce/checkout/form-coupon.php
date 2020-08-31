<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'tomato' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'tomato' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

    <div class="form-group">
        <div class="six columns no-padding-left">
        
            <input type="text" name="coupon_code" class="form-control input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'tomato' ); ?>" id="coupon_code" value="" />
            
        </div>
        
        <div class="six columns no-padding-right">
        
            <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'tomato' ); ?>" />
            
        </div>
    </div>

	<div class="clear"></div>
</form>