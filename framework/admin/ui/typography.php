<?php
/**
 * Typography OptionType
 *
 * @author 		SpyroSol
 * @category 	UI
 * @package 	Spyropress
 */

function spyropress_ui_typography( $item, $id, $value, $is_widget = false, $is_builder = false ) {

    ob_start();

    // setting default values
    $color = $cp_style = $tsc_style = '';
    $defaults = array(
        'font-size' => '0px',
        'line-height' => '0px',
        'letter-spacing' => '0px',
        'text-hshadow' => '0px',
        'text-vshadow' => '0px',
        'text-blur' => '0px',
        'use' => 0,
        'font-family' => '',
        'font-style' => '',
        'font-weight' => '',
        'font-decoration' => '',
        'font-transform' => '',
        'font-google' => '',
        'font-google-variant' => '',
        'color' => '',
        'text-shadowcolor' => ''
    );
    $value = wp_parse_args( $value, $defaults );

    // getting values
    if( $value['color'] )
        $cp_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['color']);
    if( $value['text-shadowcolor'] )
        $tsc_style = sprintf(' style="background:%1$s;border-color:%1$s"', $value['text-shadowcolor']);
?>
    <div id="<?php echo esc_attr( $id ); ?>" <?php print build_section_class( 'section-typography section-full', $item ); ?>>
        <?php build_heading( $item, $is_widget ); ?>
        <?php build_description( $item ); ?>
        <div class="controls">
        <?php
            // label for use google font
            printf('
                <label class="checkbox" for="%1$s-use">
                    <input type="checkbox" id="%1$s-use" name="%2$s[use]" value="1" %3$s />'. esc_html__( 'Use Google Fonts Instead', 'tomato' ).
                '</label>
            ', $id, $item['name'], checked($value['use'], 1, false));
        ?>
            <div class="row-fluid">
                <div class="span6">
                    <div class="pb10 web-font">
                        <strong class="sub"><?php _e( 'Font Family', 'tomato' ); ?></strong>
                        <select name="<?php echo esc_attr( $item['name'] ); ?>[font-family]" class="chosen-typo" data-placeholder="<?php echo esc_attr( 'Select Font' ); ?>" data-css="font-family">
                        <?php
                            foreach ( spyropress_panel_font_families() as $key => $family )
                                render_option(esc_attr( $key ), esc_html( $family ), array( $value['font-family'] ));
                        ?>
                        </select>
                    </div>
                    <div class="pb10 web-font row-fluid">
                        <div class="span6">
                            <select name="<?php echo esc_attr( $item['name'] ); ?>[font-style]" class="chosen-typo" data-placeholder="<?php echo esc_attr( 'Font Style' ); ?>" data-css="font-style">
                            <?php
                                foreach ( spyropress_panel_font_styles() as $key => $style )
                                    render_option(esc_attr( $key ), esc_html( $style ), array( $value['font-style'] ));
                            ?>
                            </select>
                        </div>
                        <div class="span6">
                            <select name="<?php echo esc_attr( $item['name'] ); ?>[font-weight]" class="chosen-typo" data-placeholder="<?php echo esc_attr( 'Font Weight' ); ?>" data-css="font-weight">
                            <?php
                                foreach ( spyropress_panel_font_weights() as $key => $weight )
                                    render_option(esc_attr( $key ), esc_html( $weight ), array( $value['font-weight'] ));
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="pb10 google-font">
                        <strong class="sub"><?php _e( 'Google Webfont Family', 'tomato' ); ?></strong>
                        <select id="<?php echo esc_attr( $id ); ?>-google" name="<?php echo esc_attr( $item['name'] ); ?>[font-google]" class="chosen-google-typo" data-placeholder="<?php echo esc_attr( 'Google Webfont' ); ?>" data-selected="<?php echo esc_attr( $value['font-google'] ); ?>">
                        </select>
                    </div>
                    <div class="pb10 google-font">
                        <strong class="sub"><?php _e( 'Google Webfont Variants', 'tomato' ); ?></strong>
                        <select id="<?php echo esc_attr( $id ); ?>-google-variant" name="<?php echo esc_attr( $item['name'] ); ?>[font-google-variant]" class="chosen-google-variant" data-placeholder="<?php echo esc_attr( 'Google Webfont Variants' ); ?>" data-selected="<?php echo esc_attr( $value['font-google-variant'] ); ?>">
                        </select>
                    </div>
                </div>
                <div class="span6">
                    <div class="color-picker pb10 clearfix">
                        <strong class="sub">&nbsp;</strong>
                        <input type="text" class="field" name="<?php echo esc_attr( $item['name'] ); ?>[color]" id="<?php echo esc_attr( $id ); ?>-colorpicker" value="<?php echo esc_attr( $value['color']); ?>" />
                        <div class="color-box"><div<?php print ''.$cp_style; ?>></div></div>
                    </div>
                    <div class="pb10 range-slider">
                        <strong class="sub"><?php _e( 'Font Size:', 'tomato' ); ?> <span><?php echo esc_html( $value['font-size'] ); ?></span></strong>
                        <div data-css="font-size" id="<?php echo esc_attr( $id ); ?>-fontsize" class="slider"></div>
                        <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[font-size]" id="<?php echo esc_attr( $id ); ?>-fontsize-value" value="<?php echo esc_attr( $value['font-size'] ); ?>" />
                    </div>
                </div>
            </div>
            <div id="<?php echo esc_attr( $id ); ?>-preview" class="font-preview" style="<?php spyropress_font_preview($value); ?>">
                <?php _e( 'Pack my box with five dozen liquor jugs.<br />The quick brown fox jumps over the lazy dog.', 'tomato' ); ?>
            </div>
        </div>
        <div class="clear"></div>
        <a href="#" class="advance-settings"><?php _e( 'Advance Settings', 'tomato' ); ?></a>
        <div class="controls" style="display: none;">
            <div class="row-fluid">
                <div class="span3">
                    <select name="<?php echo esc_attr( $item['name'] ); ?>[font-decoration]" class="chosen-typo" data-placeholder="<?php echo esc_attr( 'Text Decoration' ); ?>" data-css="text-decoration">
                    <?php
                        foreach ( spyropress_panel_font_decoration() as $key => $decoration )
                            render_option(esc_attr( $key ), esc_html( $decoration ), array( $value['font-decoration'] ));
                    ?>
                    </select>
                </div>
                <div class="span3">
                    <select name="<?php echo esc_attr( $item['name'] ); ?>[font-transform]" class="chosen-typo" data-placeholder="<?php echo esc_attr( 'Text Transform' ); ?>" data-css="text-transform">
                    <?php
                        foreach ( spyropress_panel_font_transform() as $key => $transform )
                            render_option(esc_attr( $key ), esc_html( $transform ), array( $value['font-transform'] ));
                    ?>
                    </select>
                </div>
                <div class="span3 range-slider">
                    <strong class="sub"><?php _e( 'Line Height:', 'tomato' ); ?> <span><?php echo esc_html( $value['line-height'] ); ?></span></strong>
                    <div data-css="line-height" id="<?php echo esc_attr( $id ); ?>-linehight" class="slider"></div>
                    <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[line-height]" id="<?php echo esc_attr( $id ); ?>-lineheight-value" value="<?php echo esc_attr( $value['line-height'] ); ?>" />
                </div>
                <div class="span3 range-slider">
                    <strong class="sub"><?php _e( 'Letter Spacing:', 'tomato' ); ?> <span><?php echo esc_html( $value['letter-spacing']); ?></span></strong>
                    <div data-css="letter-spacing" id="<?php echo esc_attr( $id ); ?>-letterspacing" class="slider"></div>
                    <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[letter-spacing]" id="<?php echo esc_attr( $id ); ?>-letterspacing-value" value="<?php echo esc_attr( $value['letter-spacing'] ); ?>" />
                </div>
            </div>
            <br />
            <strong class="sub"><?php _e( 'Text-Shadow', 'tomato' ); ?></strong>
            <div class="row-fluid">
                <div class="span3 range-slider">
                    <strong class="sub"><?php _e( 'h-Shadow:', 'tomato' ); ?> <span><?php echo esc_html( $value['text-hshadow'] ); ?></span></strong>
                    <div data-css="text-shadow" id="<?php echo esc_attr( $id ); ?>-hshadow" class="slider"></div>
                    <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[text-hshadow]" id="<?php echo esc_attr( $id ); ?>-hshadow-value" value="<?php echo esc_attr( $value['text-hshadow'] ); ?>" />
                </div>
                <div class="span3 range-slider">
                    <strong class="sub"><?php _e( 'v-Shadow:', 'tomato' ); ?> <span><?php echo esc_html( $value['text-vshadow']); ?></span></strong>
                    <div data-css="text-shadow" id="<?php echo esc_attr( $id ); ?>-vshadow" class="slider"></div>
                    <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[text-vshadow]" id="<?php echo esc_attr( $id ); ?>-vshadow-value" value="<?php echo esc_attr( $value['text-vshadow'] ); ?>" />
                </div>
                <div class="span3 range-slider">
                    <strong class="sub"><?php _e( 'Blur:', 'tomato' ); ?> <span><?php echo esc_html( $value['text-blur'] ); ?></span></strong>
                    <div data-css="text-shadow" id="<?php echo esc_attr( $id ); ?>-blur" class="slider"></div>
                    <input type="hidden" name="<?php echo esc_attr( $item['name'] ); ?>[text-blur]" id="<?php echo esc_attr( $id ); ?>-blur-value" value="<?php echo esc_attr( $value['text-blur']); ?>" />
                </div>
                <div class="span3 color-picker clearfix">
                    <input type="text" class="field shadow" name="<?php echo esc_attr( $item['name'] ); ?>[text-shadowcolor]" id="<?php echo esc_attr( $id ); ?>-shadowcolor" value="<?php echo esc_attr( $value['text-shadowcolor'] ); ?>" />
                    <div class="color-box"><div<?php print ''.$tsc_style; ?>></div></div>
                </div>
            </div>
        </div>
    </div>
<?php

    /* content */
    $ui_content = ob_get_clean();
    /* js */
    $fontsize_value         = str_replace('px', '', $value['font-size']);
    $line_height_value      = str_replace('px', '', $value['line-height']);
    $letter_spacing_value   = str_replace('px', '', $value['letter-spacing']);
    $slider_hshadow_value   = str_replace('px', '', $value['text-hshadow']);
    $slider_vshadow_value   = str_replace('px', '', $value['text-vshadow']);
    $slider_blur_value      = str_replace('px', '', $value['text-blur']);

    $typo['colorpicker'] = array( $id.'-colorpicker', $id.'-shadowcolor' );
    $typo['slider'] = array (
        "#{$id}-fontsize"   => array ( 'range' => 'min', 'min' => 1, 'max' => 120, 'value' => (int)$fontsize_value ),
        "#{$id}-linehight"  => array ( 'range' => 'min', 'min' => 7, 'max' => 89, 'value' => (int)$line_height_value ),
        "#{$id}-letterspacing"  => array ( 'min' => -20, 'max' => 20, 'value' => (int)$letter_spacing_value ),
        "#{$id}-hshadow"  => array ( 'min' => -50, 'max' => 50, 'value' => (int)$slider_hshadow_value ),
        "#{$id}-vshadow"  => array ( 'min' => -50, 'max' => 50, 'value' => (int)$slider_vshadow_value ),
        "#{$id}-blur"  => array ( 'range' => 'min', 'min' => 0, 'max' => 100, 'value' => (int)$slider_blur_value )
    );

    $js = "panelUi.bind_typography( '{$id}', ".json_encode($typo).");";

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

function spyropress_widget_typography( $item, $id, $value, $is_builder = false ) {
    return spyropress_ui_typography( $item, $id, $value, true, $is_builder );
}

/**
 * Generate style attribute for preview
 */
function spyropress_font_preview( $styles ) {
    if( $styles['color'] )
        echo 'color:'.$styles['color'].';';
    if( $styles['font-family'] )
        echo 'font-family:'.$styles['font-family'].';';
    if( $styles['font-weight'] )
        echo 'font-weight:'.$styles['font-weight'].';';
    if( $styles['font-transform'] )
        echo 'text-transform:'.$styles['font-transform'].';';
    if( $styles['font-style'] )
        echo 'font-style:'.$styles['font-style'].';';
    if( $styles['font-decoration'] )
        echo 'text-decoration:'.$styles['font-decoration'].';';
    if( $styles['font-size'] && $styles['font-size'] != '0px' )
        echo 'font-size:'.$styles['font-size'].';';
    if( $styles['line-height'] && $styles['line-height'] != '0px')
        echo 'line-height:'.$styles['line-height'].';';
    if( $styles['letter-spacing'] && $styles['letter-spacing'] != '0px' )
        echo 'letter-spacing:'.$styles['letter-spacing'].';';
    if( $styles['text-shadowcolor'] )
        echo 'text-shadow:'.$styles['text-hshadow'].' '.$styles['text-vshadow'].' '.$styles['text-blur'].' '.$styles['text-shadowcolor'].';';
}

/**
 * Font Families
 * @uses      apply_filters()
 */
function spyropress_panel_font_families() {
    return apply_filters( 'spyropress_font_families', array(
        ''          => '',
        'arial'     => esc_html__( 'Arial', 'tomato' ),
        'georgia'   => esc_html__( 'Georgia', 'tomato' ),
        'helvetica' => esc_html__( 'Helvetica', 'tomato' ),
        'palatino'  => esc_html__( 'Palatino', 'tomato' ),
        'tahoma'    => esc_html__( 'Tahoma', 'tomato' ),
        'times'     => esc_html__( '"Times New Roman", sans-serif', 'tomato' ),
        'trebuchet' => esc_html__( 'Trebuchet', 'tomato' ),
        'verdana'   => esc_html__( 'Verdana', 'tomato' )
    ));
}

/**
 * Font Weights
 */
function spyropress_panel_font_weights() {
    return array(
        ''          => '',
        'normal'    => esc_html__( 'Normal', 'tomato' ),
        'bold'      => esc_html__( 'Bold', 'tomato' ),
        'bolder'    => esc_html__( 'Bolder', 'tomato' ),
        'lighter'   => esc_html__( 'Lighter', 'tomato' ),
        '100'       => esc_html__( '100', 'tomato' ),
        '200'       => esc_html__( '200', 'tomato' ),
        '300'       => esc_html__( '300', 'tomato' ),
        '400'       => esc_html__( '400', 'tomato' ),
        '500'       => esc_html__( '500', 'tomato' ),
        '600'       => esc_html__( '600', 'tomato' ),
        '700'       => esc_html__( '700', 'tomato' ),
        '800'       => esc_html__( '800', 'tomato' ),
        '900'       => esc_html__( '900', 'tomato' ),
        'inherit'   => esc_html__( 'Inherit', 'tomato' )
    );
}

/**
 * Font Transform
 */
function spyropress_panel_font_transform() {
    return array(
        ''          => '',
        'none'          => esc_html__( 'None', 'tomato' ),
        'uppercase'     => esc_html__( 'UpperCase', 'tomato' ),
        'lowercase'     => esc_html__( 'LowerCase', 'tomato' ),
        'capitalize'    => esc_html__( 'Capitalize', 'tomato' )
    );
}

/**
 * Font Styles
 */
function spyropress_panel_font_styles() {
    return array(
        ''          => '',
        'normal'  => esc_html__( 'Normal', 'tomato' ),
        'italic'  => esc_html__( 'Italic', 'tomato' ),
        'oblique' => esc_html__( 'Oblique', 'tomato' ),
        'inherit' => esc_html__( 'Inherit', 'tomato' )
    );
}

/**
 * Font Decoration
 */
function spyropress_panel_font_decoration() {
    return array(
        ''          => '',
        'none'  => esc_html__( 'None', 'tomato' ),
        'line-through'  => esc_html__( 'Line-Through', 'tomato' ),
        'overline' => esc_html__( 'Overline', 'tomato' ),
        'underline' => esc_html__( 'Underline', 'tomato' ),
        'inherit' => esc_html__( 'Inherit', 'tomato' )
    );
}
?>