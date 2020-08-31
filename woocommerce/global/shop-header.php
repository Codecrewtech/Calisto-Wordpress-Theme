<?php

$features = get_setting_array( 'shop_loop_top_bar', array() );
$pagination_pos = get_setting( 'shop_pagination_pos', 'bottom' );
if( !empty( $features ) ):
?>
<div class="clearfix">
    <div class="shop-grid">
        <?php
            if( in_array( 'filter', $features )  ) {
                woocommerce_catalog_ordering();
            }
        ?>
        <?php 
            if( in_array( 'result_count', $features )  ) {
                woocommerce_result_count();
            }
        ?>
    </div>        
</div>
<?php endif;