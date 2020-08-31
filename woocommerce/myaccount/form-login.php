<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
	exit; // Exit if accessed directly
}
?>
<section id="shop-main">
    
    <?php get_template_part( 'woocommerce/global/breadcrumb' ); ?>
    
    <?php wc_print_notices(); ?>
    
    <?php do_action( 'woocommerce_before_customer_login_form' ); ?>
    
    <div class="row shop-login">
    	<div class="six columns">
            <div class="box-content">
    	        <h3 class="heading text-center"><?php _e( 'I\'m a Returning Customer', 'tomato' ); ?></h3>
                <div class="clearfix space40"></div>
        		<form method="post" class="logregform text-left">
        
        			<?php do_action( 'woocommerce_login_form_start' ); ?>
        
        			<div class="row">
                        <div class="twelve columns">
                            <div class="form-group">
                                <label for="username"><?php _e( 'Username or email address', 'tomato' ); ?> <span class="required">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" />
                            </div>
                        </div>
                    </div><div class="clearfix space20"></div>
                    <div class="row">
                        <div class="twelve columns">
                            <div class="form-group">
                                <a class="pull-right" href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'tomato' ); ?></a>
                                <label for="password"><?php _e( 'Password', 'tomato' ); ?> <span class="required">*</span></label>
                				<input class="form-control" type="password" name="password" id="password" />
                            </div>
                        </div>
                    </div><div class="clearfix space20"></div>
        
        			<?php do_action( 'woocommerce_login_form' ); ?>
        
        			<div class="row">
    				    <div class="six columns">
        					<span class="remember-box checkbox">
        						<label for="rememberme">
    								<label for="rememberme" class="inline">
                    					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'tomato' ); ?>
                    				</label>
       							</label>
        					</span>
    					</div>
    					<div class="six columns">
    						<input type="submit" class="button alt button btn-lg no-width u-pull-right" name="login" value="<?php _e( 'Login', 'tomato' ); ?>" />
    					</div>
    				</div>
                            
                    <?php wp_nonce_field( 'woocommerce-login' ); ?>
    
        			<?php do_action( 'woocommerce_login_form_end' ); ?>
        
      		    </form>
    
            </div>
        </div>
    
        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
    
    	<div class="six columns">
    		<div class="box-content">
                <h3 class="heading text-center"><?php _e( 'Register An Account', 'tomato' ); ?></h3>
                <div class="clearfix space40"></div>
    
        		<form method="post" class="logregform text-left">
    
        			<?php do_action( 'woocommerce_register_form_start' ); ?>
    
        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
    
    				<div class="row">
    					<div class="twelve columns">
                            <div class="form-group">
                                <label for="reg_username"><?php _e( 'Username', 'tomato' ); ?> <span class="required">*</span></label>
                                <input type="text" class="form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
    						</div>
    					</div>
    				</div><div class="clearfix space20"></div>
        			
                    <?php endif; ?>
    
        			<div class="row">
                        <div class="twelve columns">
                            <div class="form-group">
                                <label for="reg_email"><?php _e( 'Email address', 'tomato' ); ?> <span class="required">*</span></label>
                                <input type="email" class="form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
                            </div>
                        </div>
                    </div><div class="clearfix space20"></div>
    
        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
    
        				<div class="row">
                            <div class="twelve columns">
                                <div class="form-group">
                                    <label for="reg_password"><?php _e( 'Password', 'tomato' ); ?> <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?>" />
                                </div>
                            </div>
                        </div><div class="clearfix space20"></div>
    
        			<?php endif; ?>
    
        			<!-- Spam Trap -->
        			<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'tomato' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
    
        			<?php do_action( 'woocommerce_register_form' ); ?>
        			<?php do_action( 'register_form' ); ?>
    
        			<div class="row">
                        <div class="twelve columns">
                            <div class="form-group">
                                <input type="submit" class="button alt button btn-lg no-width u-pull-right" name="register" value="<?php _e( 'Register', 'tomato' ); ?>" />
                            </div>
                        </div>
                    </div>
                    
                    <?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
    
        			<?php do_action( 'woocommerce_register_form_end' ); ?>
    
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    
</section>