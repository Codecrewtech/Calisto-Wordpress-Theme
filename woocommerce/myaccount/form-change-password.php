<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<section class="shop-content">

    <?php wc_print_notices(); ?>
    
    <form action="<?php echo esc_url( get_permalink( wc_get_page_id( 'change_password' ) ) ); ?>" method="post" class="text-left">
    
    	<p class="form-row form-row-first col-md-12">
    		<label for="password_1"><?php _e( 'New password', 'tomato' ); ?> <span class="required">*</span></label>
    		<input type="password" class="form-control input-text" name="password_1" id="password_1" />
    	</p>
    	<p class="form-row form-row-last col-md-12">
    		<label for="password_2"><?php _e( 'Re-enter new password', 'tomato' ); ?> <span class="required">*</span></label>
    		<input type="password" class="form-control input-text" name="password_2" id="password_2" />
    	</p>
    	<div class="clear"></div>
    
    	<p><input type="submit" class="btn btn-default btn-lg" name="change_password" value="<?php _e( 'Save', 'tomato' ); ?>" /></p>
    
    	<?php wp_nonce_field( 'woocommerce-change_password' ); ?>
    	<input type="hidden" name="action" value="change_password" />
    
    </form>
    
</section>