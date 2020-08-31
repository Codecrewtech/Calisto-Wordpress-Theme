<?php
/**
 * Cart errors page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<hr class="tall"/>

<?php wc_print_notices(); ?>

<p><?php _e( 'There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'tomato' ) ?></p>

<?php do_action( 'woocommerce_cart_has_errors' ); ?>

<p><a class="btn btn-primary push-bottom wc-backward" href="<?php echo get_permalink(wc_get_page_id( 'cart' ) ); ?>"><?php _e( 'Return To Cart', 'tomato' ) ?></a></p>