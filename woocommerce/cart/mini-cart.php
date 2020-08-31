<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="table-responsive">
    <table cellspacing="0" class="table cart-table <?php echo esc_attr( $args['list_class'] ); ?>">
    	<tbody>
            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
    
            <?php
    			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
    				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
    
    				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
    
    					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
    					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'shop_thumbnail' ), $cart_item, $cart_item_key );
    					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
    					?>
                        <tr>
    						<td class="product-thumb">
    							<a href="<?php echo get_permalink( $product_id ); ?>">
    								<?php echo wp_kses_post( $thumbnail ); ?>
    							</a>
    						</td>
    						<td class="product-name">
    							<a href="<?php echo get_permalink( $product_id ); ?>"><?php echo esc_html( $product_name ); ?><br><span class="amount"><strong><?php echo wp_kses_post( $product_price ); ?></strong></span></a>
    						</td>
    						<td class="product-actions">
    							<?php
                                    $remove_link = (function_exists('wc_get_cart_remove_url')) ? wc_get_cart_remove_url( $cart_item_key ) :  WC()->cart->get_remove_url( $cart_item_key );
        							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="fa fa-times ci-close"></i></a>', esc_url( $remove_link ), esc_html__( 'Remove this item', 'tomato' ) ), $cart_item_key );
        						?>
    						</td>
    					</tr>
    					<?php
    				}
    			}
    		?>
    
            <?php else : ?>
    
            <tr>
                <td>
                    <?php _e( 'No products in the cart.', 'tomato' ); ?>
                </td>
            </tr>
    
            <?php endif; ?>
    
            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
    
            <tr>
    			<td class="actions" colspan="6">
    
                    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
    
    				<div class="actions-continue">
    					<input onclick="javascript:window.location='<?php echo WC()->cart->get_cart_url(); ?>'" type="submit" value="<?php _e( 'View Cart', 'tomato' ); ?>" class="btn btn-default btn-sm">
    					<input onclick="javascript:window.location='<?php echo wc_get_checkout_url(); ?>'" type="submit" value="<?php _e( 'Checkout &raquo;', 'tomato' ); ?>" name="proceed" class="btn pull-right btn-primary checkout btn-sm">
    				</div>
                    
    			</td>
    		</tr>
    
            <?php endif; ?>
    	</tbody>
    </table>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>