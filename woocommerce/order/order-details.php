<?php
/**
* Order details
*
* This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see 	https://docs.woocommerce.com/document/template-structure/
* @author  WooThemes
* @package WooCommerce/Templates
* @version 3.7.0
*/

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

$order = wc_get_order( $order_id );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>
<div class="col-full">
    <h3><?php _e( 'Order Details', 'tomato' ); ?></h3><br />
    <table class="cart-table table table-bordered account-table ">
        <thead>
        <tr>
            <th class="product-thumb">&nbsp;</th>
            <th class="product-name"><?php _e( 'Product', 'tomato' ); ?></th>
            <th class="product-total"><?php _e( 'Total', 'tomato' ); ?></th>
        </tr>
        </thead>
        <tbody>
		<?php
		foreach ( $order->get_items() as $item_id => $item ) {
			$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

			wc_get_template( 'order/order-details-item.php', array(
				'order'			     => $order,
				'item_id'		     => $item_id,
				'item'			     => $item,
				'show_purchase_note' => $show_purchase_note,
				'purchase_note'	     => $product ? $product->get_purchase_note() : '',
				'product'	         => $product,
			) );
		}
		?>
		<?php do_action( 'woocommerce_order_items_table', $order ); ?>
        </tbody>
    </table>
	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</div>
<br />
<br />
<br />


<div class="ma-address">
    <h3><?php _e( 'Customer details', 'tomato' ); ?></h3>
    <table class="customer_details cart-table account-table table table-bordered">
        <thead>
        <tr>
            <th><?php _e( 'Note:', 'tomato' ); ?></th>
            <th><?php  echo esc_html__( 'Email:', 'tomato' ); ?></th>
            <th><?php  echo esc_html__( 'Telephone:', 'tomato' ); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
				<?php echo wptexturize( $order->get_customer_note() ); ?>
            </td>
            <td>
				<?php echo esc_html( $order->get_billing_email() ); ?>
            </td>
            <td>
				<?php echo esc_html( $order->get_billing_phone() ); ?>
            </td>
        </tr>
        </tbody>
    </table>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</div>
</section>
