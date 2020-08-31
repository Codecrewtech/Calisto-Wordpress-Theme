<?php
/**
 * Single Product Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

$count   = $product->get_rating_count();
$average = $product->get_average_rating();

if ( $count > 0 ) : ?>

	<div class="rc-ratings pull-right">
		<div class="review_num">
            <?php printf( _n( '%s review', '%s reviews', $count, 'tomato' ), '<span itemprop="ratingCount" class="count">' . $count . '</span>' ); ?>
		</div>
        <div class="star-rating" title="<?php printf( esc_html__( 'Rated %s out of 5', 'tomato' ), $average ); ?>">
			<span style="width:<?php echo ( ( ''.$average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'tomato' ); ?>
			</span>
		</div>
	</div>
    
<?php endif; 