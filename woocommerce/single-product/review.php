<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
                                            
<li itemprop="reviews" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    
    <a class="pull-left" href="#"> 
        <?php 
            $avatar =   get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '50' ), '', get_comment_author() ); 
            echo str_replace( 'photo', 'photo comment-avatar', $avatar );
        ?>
    </a>
    <div class="comment-meta">
        <a href="#"><?php comment_author(); ?></a>
        <span>
		  <em><?php printf( esc_html__( '%1$s at %2$s', 'tomato' ), get_comment_date(), get_comment_time() ) ?></em>
		</span>
        <?php
            $reply = get_comment_reply_link( array_merge( $args, array(
                'depth' => $depth,
                'reply_text' => '<i class="fa fa-reply"></i> Reply',
                'max_depth' => $args['max_depth'],
                
            ) ) );
            echo str_replace( 'comment-reply-link', 'btn btn-sm btn-default pull-right', $reply );
        ?>
    </div>
    <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
        <div itemprop="reviewRating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'tomato' ), $rating ) ?>">
		   <span style="width:<?php echo ( ''.$rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo ''.$rating; ?></strong> <?php _e( 'out of 5', 'tomato' ); ?></span>
	    </div> 
    <?php endif; ?>
    <?php if ( $comment->comment_approved == '0' ) : ?>

            <div><em><?php _e( 'Your comment is awaiting approval', 'tomato' ); ?></em></div>

    <?php endif; ?>
            
    <div itemprop="description" class="description comment-body"><?php comment_text(); ?></div>
    