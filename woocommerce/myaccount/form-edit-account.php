<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce;
?>
<?php wc_print_notices(); ?>

<div class="billing-details text-left">
    <form action="" method="post">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="account_first_name"><?php _e( 'First name', 'tomato' ); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="account_last_name"><?php _e( 'Last name', 'tomato' ); ?> <span class="required">*</span></label>
                    <input type="text" class="form-control input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="account_email"><?php _e( 'Email address', 'tomato' ); ?> <span class="required">*</span></label>
                    <input type="email" class="form-control input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password_1"><?php _e( 'Password (leave blank to leave unchanged)', 'tomato' ); ?></label>
                    <input type="password" class="form-control input-text" name="password_1" id="password_1" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password_2"><?php _e( 'Confirm new password', 'tomato' ); ?></label>
                    <input type="password" class="form-control input-text" name="password_2" id="password_2" />
                </div>
            </div>
        </div>
        
        <input type="submit" class="btn btn-default btn-lg" name="save_account_details" value="<?php _e( 'Save changes', 'tomato' ); ?>" />
    	<?php wp_nonce_field( 'save_account_details' ); ?>
    	<input type="hidden" name="action" value="save_account_details" />
    </form>
</div>