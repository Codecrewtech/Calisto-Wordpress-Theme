<?php

/**
 * Border OptionType
 *
 * @author 		SpyroSol
 * @category 	UI
 * @package 	Spyropress
 */

function spyropress_ui_skin_generator( $id ) {

    $item['label'] = esc_html__( 'Create Skin', 'tomato' );
    $item['desc'] = esc_html__( 'Choose a name and a color and the admin will generate the skin file and save it for future use.', 'tomato' );

    spyropress_ui_sub_heading( $item, '', '' );
    echo '<div class="section section-skin-generator section-full">';
        echo '<div class="controls">';
            spyropress_ui_text( array( 'label' => 'Skin Name', 'name' => 'skin_name', 'id' => 'skin_name' ), 'skin_name', '' );
            spyropress_ui_colorpicker( array( 'label' => 'Skin Color', 'name' => 'skin_color', 'id' => 'skin_color' ), 'skin_color', '' );
            spyropress_ui_checkbox( array(
                'label' => 'Gradient',
                'name' => 'skin_gradient',
                'id' => 'skin_gradient',
                'options' => array(
                    '1' => 'Apply gradient to theme elements'
                )
            ), 'skin_gradient', '' );
        echo '</div>';
        
        wp_nonce_field( 'skin_generator_form', 'skin_generator_nonce' );
        
        printf(
            '<input type="submit" name="btn_skin_generator" value="%1$s" class="button-green button-skin-generator pull-right" />',
            esc_html__( 'Create Skin', 'tomato' )
        );
        
    echo '</div>';
}
?>