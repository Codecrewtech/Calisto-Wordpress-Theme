<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
   <li class="dropdown">
      <a class="css-pointer dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-shopping-cart fsc pull-left"></i><span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span><span class="caret"></span></a>
      <div class="cart-content dropdown-menu">
         <div class="cart-title">
            <h4><?php echo esc_html( $item->title ); ?></h4>
         </div>
         <?php do_action( 'woocommerce_before_mini_cart' ); ?>
         <div class="cart-items">	
            <div class="cart-item clearfix">
               <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

               <?php
               foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                  $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                  $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                  if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                     $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                     $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'shop_thumbnail' ), $cart_item, $cart_item_key );
                     $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                     ?>

                     <div class="cart-item-image">
                        <a href="<?php echo get_permalink( $product_id ); ?>"><?php echo str_replace( 'wp-post-image', 'img-responsive', $thumbnail ); ?></a>
                     </div>
                     <div class="cart-item-desc">
                        <a href="<?php echo get_permalink( $product_id ); ?>"><?php echo esc_html( $product_name ); ?></a>
                        <span class="cart-item-price"><?php echo wp_kses_post( $product_price ); ?></span>
                        <?php
                        $remove_link = (function_exists('wc_get_cart_remove_url')) ? wc_get_cart_remove_url( $cart_item_key ) :  WC()->cart->get_remove_url( $cart_item_key );
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="fa fa-times ci-close"></i></a>', esc_url( $remove_link ), __( 'Remove this item', 'tomato' ) ), $cart_item_key );
                        ?>
                     </div>

                     <?php
                  }
               }


            else : 
               _e( 'No products in the cart.', 'tomato' ); 

            endif; ?>
         </div>
      </div> 
      <div class="cart-action clearfix">
         <span class="pull-left checkout-price"><?php echo WC()->cart->get_cart_total(); ?></span>
         <a class="btn btn-default pull-right" href="<?php echo get_permalink( wc_get_page_id( 'cart' ) ); ?>">View Cart</a>
      </div>
      <?php do_action( 'woocommerce_after_mini_cart' ); ?>
   </div>

</li>
<?php }