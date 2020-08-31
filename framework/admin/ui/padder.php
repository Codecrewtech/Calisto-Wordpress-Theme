<?php
/**
 * Margin/Padding OptionType
 *
 * @author 		SpyroSol
 * @category 	UI
 * @package 	Spyropress
 */

function spyropress_ui_padder($item, $id, $value, $is_widget = false, $is_builder = false) {
        
    ob_start();
    
    // setting default values
    $cp_style = '';
    $defaults = array(
        'top' => '0px',
        'right' => '0px',
        'bottom' => '0px',
        'left' => '0px',
    );
    $value = wp_parse_args( $value, $defaults );    
?>
    <div id="<?php echo esc_attr( $id ); ?>" <?php print build_section_class( 'section-padder section-full', $item ); ?>>
        <?php build_heading( $item, $is_widget ); ?>
        <?php build_description( $item ); ?>
        <div class="controls row-fluid">
            <div class="span3 range-slider">
                <strong class="sub"><?php _e( 'Top:', 'tomato' ); ?> <span><?php echo esc_html( $value['top'] ); ?></span></strong>
                <div id="<?php echo esc_attr( $id ); ?>-top" class="slider"></div>
                <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[top]" id="<?php echo esc_attr( $id ); ?>-top-value" value="<?php echo esc_attr( $value['top'] ); ?>" />
            </div>
            <div class="span3 range-slider">
                <strong class="sub"><?php _e( 'Bottom:', 'tomato' ); ?> <span><?php echo esc_html( $value['bottom'] ); ?></span></strong>
                <div id="<?php echo esc_attr( $id ); ?>-bottom" class="slider"></div>
                <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[bottom]" id="<?php echo esc_attr( $id ); ?>-bottom-value" value="<?php echo esc_attr( $value['bottom'] ); ?>" />
            </div>
            <div class="span3 range-slider">
                <strong class="sub"><?php _e( 'Left:', 'tomato' ); ?> <span><?php echo esc_html( $value['left'] ); ?></span></strong>
                <div id="<?php echo esc_attr( $id ); ?>-left" class="slider"></div>
                <input type="hidden" name="<?php echo esc_attr( $item['name']); ?>[left]" id="<?php echo esc_attr( $id ); ?>-left-value" value="<?php echo esc_attr( $value['left'] ); ?>" />
            </div>
            <div class="span3 range-slider">
                <strong class="sub"><?php _e( 'Right:', 'tomato' ); ?> <span><?php echo esc_html( $value['right'] ); ?></span></strong>
                <div id="<?php echo esc_attr( $id ); ?>-right" class="slider"></div>
                <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[right]" id="<?php echo esc_attr( $id ); ?>-right-value" value="<?php echo esc_attr( $value['right'] ); ?>" />
            </div>
        </div>
    </div>                
<?php
    
    // content
    $ui_content = ob_get_clean();
    /* js */
    $slider_top     = str_replace('px', '', $value['top']);
    $slider_bottom  = str_replace('px', '', $value['bottom']);
    $slider_left    = str_replace('px', '', $value['left']);
    $slider_right   = str_replace('px', '', $value['right']);
    
    $padder['slider'] = array (
        "#{$id}-top"   => array ( 'value' => (int)$slider_top ),
        "#{$id}-bottom"  => array ( 'value' => (int)$slider_bottom ),
        "#{$id}-left"  => array ( 'value' => (int)$slider_left ),
        "#{$id}-right"  => array ( 'value' => (int)$slider_right )
    );
    
    $js = "panelUi.bind_padder( '{$id}', ".json_encode($padder).");";
    
    if($is_widget)  {
        if(!$is_builder)
            add_jquery_ready($js);
        else
            $ui_content .= sprintf( '<script type="text/javascript">%2$s//<![CDATA[%2$s %1$s %2$s//]]>%2$s</script>', $js, "\n" );
        return $ui_content;
    }
    else {
        echo ''.$ui_content;
        add_jquery_ready($js);
    }
}

function spyropress_widget_padder( $item, $id, $value, $is_builder = false ) {
    return spyropress_ui_padder( $item, $id, $value, true, $is_builder );
}
?>