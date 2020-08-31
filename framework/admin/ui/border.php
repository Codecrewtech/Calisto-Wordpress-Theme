<?php
/**
 * Border OptionType
 *
 * @author 		SpyroSol
 * @category 	UI
 * @package 	Spyropress
 */

function spyropress_ui_border($item, $id, $value, $is_widget = false, $is_builder = false) {
    
    ob_start();
    
    /* setting default values */
    $cp_style = '';
    $defaults = array(
        'top' => '0px',
        'top-color' => '',
        'top-style' => '',
        
        'right' => '0px',
        'right-color' => '',
        'right-style' => '',
        
        'bottom' => '0px',
        'bottom-color' => '',
        'bottom-style' => '',
        
        'left' => '0px',
        'left-color' => '',
        'left-style' => '',        
    );
    $value = wp_parse_args( $value, $defaults );
        
    /* getting values */
    $top_color_style = $bottom_color_style = $left_color_style = $right_color_style = '';
    if( $value['top-color'] )
        $top_color_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['top-color']);
    if( $value['bottom-color'] )
        $bottom_color_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['bottom-color']);
    if( $value['left-color'] )
        $left_color_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['left-color']);
    if( $value['right-color'] )
        $right_color_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['right-color']);
?>
    <div id="<?php echo esc_attr( $id  ); ?>" <?php echo  build_section_class( 'section-border section-full', $item ); ?>>
        <?php build_heading( $item, $is_widget ); ?>
        <?php build_description( $item ); ?>
        <div class="controls">
            <div class="row-fluid pb10">
                <div class="span6">
                    <strong class="sub"><?php _e( 'Top Border:', 'tomato' ); ?></strong>
                    <div class="range-slider pb10">
                        <strong class="sub"><?php _e( 'Width:', 'tomato' ); ?> <span><?php echo esc_attr( $value['top'] ); ?></span></strong>
                        <div id="<?php echo esc_attr( $id ); ?>-top" class="slider"></div>
                        <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[top]" id="<?php echo esc_attr( $id ); ?>-top-value" value="<?php echo esc_attr( $value['top'] ); ?>" />
                    </div>
                    <br />
                    <div class="row-fluid">
                        <div class="span6">
                            <select class="chosen" name="<?php echo esc_attr( $item['name'] ); ?>[top-style]" id="<?php echo esc_attr( $id ); ?>-top-style">
                            <?php
                                foreach ( spyropress_panel_border_styles() as $key => $style )
                                    render_option(esc_attr( $key ), esc_html( $style ), array( $value['top-style'] ));
                            ?>
                            </select>
                        </div>
                        <div class="span6">
                            <div class="color-picker clearfix">
                                <input type="text" class="field" name="<?php echo esc_attr( $item['name'] ); ?>[top-color]" id="<?php echo esc_attr( $id ); ?>-top-colorpicker" value="<?php echo esc_attr( $value['top-color'] ); ?>" />
                                <div class="color-box"><div<?php echo ''.$top_color_style; ?>></div></div>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="span6">
                    <strong class="sub"><?php _e( 'Bottom Border:', 'tomato' ); ?></strong>
                    <div class="range-slider pb10">
                        <strong class="sub"><?php _e( 'Width:', 'tomato' ); ?> <span><?php echo esc_html( $value['bottom'] ); ?></span></strong>
                        <div id="<?php echo esc_attr( $id ); ?>-bottom" class="slider"></div>
                        <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[bottom]" id="<?php echo esc_attr( $id ); ?>-bottom-value" value="<?php echo esc_attr( $value['bottom'] ); ?>" />
                    </div>
                    <br />
                    <div class="row-fluid">
                        <div class="span6">
                            <select class="chosen" name="<?php echo esc_attr( $item['name'] ); ?>[bottom-style]" id="<?php echo esc_attr( $id ); ?>-bottom-style">
                            <?php
                                foreach ( spyropress_panel_border_styles() as $key => $style )
                                    render_option(esc_attr( $key ), esc_html( $style ), array( $value['bottom-style'] ));
                            ?>
                            </select>
                        </div>
                        <div class="span6">
                            <div class="color-picker clearfix">
                                <input type="text" class="field" name="<?php echo esc_attr( $item['name']); ?>[bottom-color]" id="<?php echo esc_attr( $id ); ?>-bottom-colorpicker" value="<?php echo esc_attr( $value['bottom-color'] ); ?>" />
                                <div class="color-box"><div<?php print ''.$bottom_color_style; ?>></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="row-fluid">
                <div class="span6">
                    <strong class="sub"><?php _e( 'Left Border:', 'tomato' ); ?></strong>
                    <div class="range-slider pb10">
                        <strong class="sub"><?php _e( 'Width:', 'tomato' ); ?> <span><?php echo esc_html( $value['left']); ?></span></strong>
                        <div id="<?php echo esc_attr( $id ); ?>-left" class="slider"></div>
                        <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[left]" id="<?php echo esc_attr( $id ); ?>-left-value" value="<?php echo esc_attr( $value['left'] ); ?>" />
                    </div>
                    <br />
                    <div class="row-fluid">
                        <div class="span6">
                            <select class="chosen" name="<?php echo esc_attr( $item['name'] ); ?>[left-style]" id="<?php echo esc_attr( $id ); ?>-left-style">
                            <?php
                                foreach ( spyropress_panel_border_styles() as $key => $style )
                                    render_option(esc_attr( $key ), esc_html( $style ), array( $value['left-style'] ));
                            ?>
                            </select>
                        </div>
                        <div class="span6">
                            <div class="color-picker clearfix">
                                <input type="text" class="field" name="<?php echo esc_attr( $item['name'] ); ?>[left-color]" id="<?php echo esc_attr( $id ); ?>-left-colorpicker" value="<?php echo esc_attr( $value['left-color'] ); ?>" />
                                <div class="color-box"><div<?php print ''.$left_color_style; ?>></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <strong class="sub"><?php _e( 'Right Border:', 'tomato' ); ?></strong>
                    <div class="range-slider pb10">
                        <strong class="sub"><?php _e( 'Width:', 'tomato' ); ?> <span><?php echo esc_html( $value['right'] ); ?></span></strong>
                        <div id="<?php echo esc_attr( $id ); ?>-right" class="slider"></div>
                        <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[right]" id="<?php echo esc_attr( $id ); ?>-right-value" value="<?php echo esc_attr( $value['right'] ); ?>" />
                    </div>
                    <br />
                    <div class="row-fluid">
                        <div class="span6">
                            <select class="chosen" name="<?php echo esc_attr( $item['name'] ); ?>[right-style]" id="<?php echo esc_attr( $id ); ?>-right-style">
                            <?php
                                foreach ( spyropress_panel_border_styles() as $key => $style )
                                    render_option(esc_attr( $key ), esc_html( $style ), array( $value['right-style'] ));
                            ?>
                            </select>
                        </div>
                        <div class="span6">
                            <div class="color-picker clearfix">
                                <input type="text" class="field" name="<?php echo esc_attr( $item['name'] ); ?>[right-color]" id="<?php echo esc_attr( $id ); ?>-right-colorpicker" value="<?php echo esc_attr( $value['right-color'] ); ?>" />
                                <div class="color-box"><div<?php print ''.$right_color_style; ?>></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                
<?php
    
    /* content */
    $ui_content = ob_get_clean();
    /* js */
    $slider_top     = str_replace('px', '', $value['top']);
    $slider_bottom  = str_replace('px', '', $value['bottom']);
    $slider_left    = str_replace('px', '', $value['left']);
    $slider_right   = str_replace('px', '', $value['right']);
    
    $border['colorpicker'] = array(
        $id.'-top-colorpicker',
        $id.'-bottom-colorpicker',
        $id.'-left-colorpicker',
        $id.'-right-colorpicker',
    );
    $border['slider'] = array (
        "#{$id}-top"   => array ( 'value' => (int)$slider_top ),
        "#{$id}-bottom"  => array ( 'value' => (int)$slider_bottom ),
        "#{$id}-left"  => array ( 'value' => (int)$slider_left ),
        "#{$id}-right"  => array ( 'value' => (int)$slider_right )
    );
    
    $js = "panelUi.bind_border( '{$id}', ".json_encode($border).");";
    
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

function spyropress_widget_border( $item, $id, $value, $is_builder = false ) {
    return spyropress_ui_border( $item, $id, $value, true, $is_builder );
}

/**
 * Border Styles
 */
function spyropress_panel_border_styles() {
    return array(
        ''          => '',
        'none'      => esc_html__( 'None', 'tomato' ),
        'dotted'    => esc_html__( 'Dotted', 'tomato' ),
        'dashed'    => esc_html__( 'Dashed', 'tomato' ),
        'double'    => esc_html__( 'Double', 'tomato' ),
        'groove'    => esc_html__( 'Groove', 'tomato' ),
        'hidden'    => esc_html__( 'Hidden', 'tomato' ),
        'inset'     => esc_html__( 'Inset', 'tomato' ),
        'outset'    => esc_html__( 'Outset', 'tomato' ),
        'ridge'     => esc_html__( 'Ridge', 'tomato' ),
        'solid'     => esc_html__( 'Solid', 'tomato' )
    );
}
?>