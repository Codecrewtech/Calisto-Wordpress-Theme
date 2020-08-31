<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();
$thumbnails =  '';
$thumbnails2 =  '';
if ( $attachment_ids && has_post_thumbnail() ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$image_title     = get_post_field( 'post_excerpt', $attachment_id );

		$attributes = array(
			'title'                   => $image_title,
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
            'class'                   => 'img-responsive'
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="gallery-item" data-mfp-src="' . esc_url( $full_size_image[0] ) . '    ">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
 		$html .= '</a></div>';
		$thumbnails .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
	}
    
    ?>

    <div class="single-shop-carousel">
        <?php echo wp_kses_post( $thumbnails ); ?>
    </div>
    <div class="single-shop-carousel-nav">
        <?php echo wp_kses_post( $thumbnails ); ?>
    </div>
    <div class="clearfix"></div>
    <?php
    
}elseif( has_post_thumbnail() ){
    
    $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
    $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
    $image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
    $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
    
    $attributes = array(
		'title'                   => $image_title,
		'data-src'                => $full_size_image[0],
		'data-large_image'        => $full_size_image[0],
		'data-large_image_width'  => $full_size_image[1],
		'data-large_image_height' => $full_size_image[2],
        'class'                   => 'img-responsive'
	);

	if ( has_post_thumbnail() ) {
		$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">
		<a href="' . esc_url( $full_size_image[0] ) . '">';
		$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
		$html .= '</a></div>';
	} else {
		$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
		$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'tomato' ) );
		$html .= '</div>';
	}

	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

	do_action( 'woocommerce_product_thumbnails' );
}