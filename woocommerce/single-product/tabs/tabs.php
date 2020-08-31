<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$count = 0;
if ( ! empty( $tabs ) ) : ?>

	<div class="tab-style3">
        <div class="align-center mb-40 mb-xs-30">
    		<ul class="nav nav-tabs tpl-minimal-tabs animate">
    			<?php foreach ( $tabs as $key => $tab ) : $count++; ?>
    
    				<li class="<?php echo ( 1 == $count ) ? 'active ' : ''; echo ''.$key ?>_tab">
    					<a  aria-expanded="<?php echo ( 1 == $count ) ? true : false; ?>" href="#tab-<?php echo ''.$key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
    				</li>
    
    			<?php endforeach; $count = 0; ?>
    		</ul>
        </div>
        <div style="height: auto;" class="tab-content tpl-minimal-tabs-cont align-center section-text">
    		<?php foreach ( $tabs as $key => $tab ) : $count++; ?>
    
    			<div class="tab-pane fade <?php echo ( 1 == $count ) ? ' active in' : ''; ?>" id="tab-<?php echo ''.$key ?>">
    				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
    			</div>
    
    		<?php endforeach; ?>
        </div>
	</div>

<?php endif; ?>