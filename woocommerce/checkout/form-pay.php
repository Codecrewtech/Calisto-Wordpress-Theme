<?php
/**
 * Pay for order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<form id="order_review" method="post">
    
	<div id="payment">
        <div class="clearfix row"></div>
		<div class="clearfix row"></div>
		<div class="clearfix row"></div>
		<div class="clearfix row"></div>
		<?php if ( $order->needs_payment() ) : ?>
		<h4 class="heading"><?php _e( 'Payment', 'tomato' ); ?></h4>
        <div class="clearfix row"></div>
		<div class="clearfix row"></div>
		<div class="clearfix row"></div>
		<div class="payment_methods methods payment-method">
            <div class="row">
    			<?php
    				if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
    					// Chosen Method
    					if ( sizeof( $available_gateways ) )
    						current( $available_gateways )->set_current();
    
    					foreach ( $available_gateways as $gateway ) {
    						?>
    						<div class="payment_method_<?php echo esc_attr( $gateway->id ); ?> four columns text-left">
    							<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
    							<div class="space20"></div>
                                <label for="payment_method_<?php echo esc_attr( $gateway->id ); ?>"><span><strong><?php echo esc_html( $gateway->get_title() ); ?> <?php echo tomato_html($gateway->get_icon()); ?></strong></span></label>
    							<?php
    								if ( $gateway->has_fields() || $gateway->get_description() ) {
    									echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
    									$gateway->payment_fields();
    									echo '</div>';
    								}
    							?>
    						</div>
    						<?php
    					}
    				}
    			?>
            </div>
		</div>
		<?php endif; ?>

		<div class="form-row">
			<?php wp_nonce_field( 'woocommerce-pay' ); ?>
			<?php
				$pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', esc_html__( 'Pay for order', 'tomato' ) );

				echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' );
			?>
			<input type="hidden" name="woocommerce_pay" value="1" />
		</div>

	</div>

</form>