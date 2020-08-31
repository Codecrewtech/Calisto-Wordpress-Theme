<?php
/**
 * Checkout Payment Section
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<?php if ( ! is_ajax() ) : ?>
	<?php do_action( 'woocommerce_review_order_before_payment' ); ?>
<?php endif; ?>
<div id="payment" class="woocommerce-checkout-payment">
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<h4 class="text-left"><?php _e( 'Payment Method', 'tomato' ); ?></h4>
        <br />
    	<div class="payment_methods methods payment-method">
            <div class="row">
        		<?php
        			if ( ! empty( $available_gateways ) ) {
        				foreach ( $available_gateways as $gateway ) {
        					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
        				}
        			}
        		?>
            </div>
    	</div>
	<?php endif; ?>

	<div class="text-center top-space-lg">

		<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'tomato' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'tomato' ); ?>" /></noscript>

		<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="btn btn-default btn-lg" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

		<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>
			<p class="form-row terms col-md-12">
				<label for="terms" class="checkbox"><?php printf( __( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'tomato' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?></label>
				<input type="checkbox" class="input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" />
			</p>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

	</div>

</div>

<?php if ( ! is_ajax() ) : ?>
	<?php do_action( 'woocommerce_review_order_after_payment' ); ?>
<?php endif; ?>