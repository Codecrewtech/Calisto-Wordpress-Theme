<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spyropress_shop_layout =  isset( $_GET['shop_layout'] )  ? $_GET['shop_layout'] : get_setting( 'shop_layout', 'full' );
if (is_single()) {
   $spyropress_shop_layout =  isset( $_GET['shop_layout'] )  ? $_GET['shop_layout'] : get_setting( 'shop_single_layout', 'full' );
}
$spyropress_shop_sidebar_pos = '';
if( isset( $_GET['sidebar'] ) ):
    $spyropress_shop_sidebar_pos = $_GET['sidebar'];
elseif( is_single() ):
    $spyropress_shop_sidebar_pos = get_setting( 'shop_single_sidebar_pos', 'right' );
else:
    $spyropress_shop_sidebar_pos = get_setting( 'shop_sidebar_pos', 'right' );
endif;

?>
    <?php if( 'sidebar' == $spyropress_shop_layout ) : ?>
        </div>
        
        <?php if( 'right' == $spyropress_shop_sidebar_pos ) : ?>
            <aside class="col-md-3">
                    <?php woocommerce_get_sidebar(); ?>
            </aside>
        <?php endif; ?>
            
    </div>
    <?php endif; ?>
    <?php if( 'sidebar' != $spyropress_shop_layout && is_shop() ) : ?>
        </div>
    <?php endif; ?>
    </div>
  </div>
</div>