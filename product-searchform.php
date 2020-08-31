<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
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
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Translation Theme Options.
$spyropress_translate['search-placeholder'] = get_setting( 'translate' ) ?  get_setting( 'search-placeholder', 'Search..' ) : esc_html__( 'Search..', 'tomato' ); 
?>
<form class="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" name="s" class="search" placeholder="<?php echo esc_attr( $spyropress_translate['search-placeholder'] ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
    <button><i class="fa fa-chevron-right"></i></button>
    <input type="hidden" name="post_type" value="product" />
</form>