<?php
/**
* Thankyou page
*
* This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see 	    https://docs.woocommerce.com/document/template-structure/
* @author 		WooThemes
* @package 	WooCommerce/Templates
* @version     3.7.0
*/

if ( ! defined( 'ABSPATH' ) ) {
   exit;
}
?>

<section class="shop-content">

   <?php if ( $order ) : ?>

      <?php if ( $order->has_status( 'failed' ) ) : ?>

         <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'tomato' ); ?></p>

         <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
            <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'tomato' ) ?></a>
            <?php if ( is_user_logged_in() ) : ?>
               <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'tomato' ); ?></a>
            <?php endif; ?>
         </p>

         <?php else : ?>

            <h3><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'tomato' ), $order ); ?></h3><br />

            <table class="cart-table account-table table table-bordered">
               <thead>
                  <tr>
                     <th><?php _e( 'Order Number:', 'tomato' ); ?></th>
                     <th><?php _e( 'Date:', 'tomato' ); ?></th>
                     <th><?php _e( 'Payment Method:', 'tomato' ); ?></th>
                     <th><?php _e( 'Total:', 'tomato' ); ?></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>
                        <?php echo esc_html( $order->get_order_number() ); ?>
                     </td>
                     <td>
                        <?php echo wc_format_datetime( $order->get_date_created() ); ?>
                     </td>
                     <td>
                        <?php echo wp_kses_post( $order->get_payment_method_title() ); ?>	
                     </td>
                     <td>
                        <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?>
                     </td>
                  </tr>
               </tbody>
            </table>
            <div class="clear"></div><br/><br/><br/>

         <?php endif; ?>
         <div class="ma-address">
            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
         </div>
         <br/><br/><br/>
         <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
         <?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received alert alert-success"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'tomato' ), null ); ?></p>

         <?php endif; ?>

      </section>
