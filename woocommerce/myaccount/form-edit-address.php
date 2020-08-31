<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title = ( 'billing' === $load_address ) ? __( 'Billing address', 'tomato' ) : __( 'Shipping address', 'tomato' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
    
<?php else : ?>

<div class="billing-details text-left">

	<form method="post">

		<h3 class="text-left"><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><br />
        
        <div class="text-left"> 
            
            <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
            
    		<?php foreach ( $address as $key => $field ) : ?>
    
    			<?php 
                        if( is_str_contain( 'first_name', $key ) ) {
                            $field['return'] = true;
                            $output = woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                            $output = str_replace( 'col-md-12', 'col-md-6', $output );
                            echo str_replace( '</div></div>', '</div>', $output );
                        }
                        if( is_str_contain( 'last_name', $key ) ) {
                            $field['return'] = true;
                            
                            $output = woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                            $output = str_replace( 'col-md-12', 'col-md-6', $output );
                            $output = str_replace( 'row', ' ', $output );
                            echo str_replace( '</div></div>', '</div></div></div>', $output );
                        }
                        if( is_str_contain( 'city', $key ) ) {
                            $field['return'] = true;
                            $output = woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                            $output = str_replace( 'col-md-12', 'col-md-4', $output );
                            echo str_replace( '</div></div>', '</div>', $output );
                        }
                        if( is_str_contain( 'state', $key ) ) {
                            $field['return'] = true;
                            $output = woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                            $output = str_replace( 'col-md-12', 'col-md-4', $output );
                            echo ''.$output = str_replace( 'row', ' ', $output );
                        }
                        if( is_str_contain( 'postcode', $key ) ) {
                            $field['return'] = true;
                            
                            $output = woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                            $output = str_replace( 'col-md-12', 'col-md-4', $output );
                            $output = str_replace( 'row', ' ', $output );
                            echo str_replace( '</div></div>', '</div></div></div>', $output );
                        }                
                        else {
                            woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );
                        }
                
                 ?>
    
    		<?php endforeach; ?>
            
            <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

    		<p class="text-left">
    			<input type="submit" class="btn btn-default btn-lg" name="save_address" value="<?php _e( 'Save Address', 'tomato' ); ?>" />
    			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
				<input type="hidden" name="action" value="edit_address" />
    		</p>
        </div>
	</form>
 
</div>

<?php endif; ?>