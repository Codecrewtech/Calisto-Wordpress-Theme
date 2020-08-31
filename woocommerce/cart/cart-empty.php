<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<section class="shop-content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php wc_print_notices(); ?>
            <?php do_action( 'woocommerce_cart_is_empty' ); ?>
            <p class="return-to-shop"><a class="btn btn-default btn-lg" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'tomato' ) ?></a></p>
        </div>
    </div>
</section>