<?php
/**
 * Module:List Items
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_List_Item extends SpyropressBuilderModule{

    public function __construct(){
        
        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/list-items';
        $this->description = esc_html__( 'List Items.', 'tomato' );
        $this->id_base = 'list-item';
        $this->name = esc_html__( 'List Items', 'tomato' );
        
        // Fields
        $this->fields = array(
            
            array(
                'label' => esc_html__( 'List Style', 'tomato' ),
                'id' => 'spyropress_list_style',
                'type' => 'select',
                'options' => array(
                    'no-padding' => esc_html__( 'Style One', 'tomato' ),
                    'list-circle no-padding' => esc_html__( 'Style Two', 'tomato' ),
                ),'std' => 'no-padding'
            ),
            
            array(
                'label' => esc_html__( 'List Item', 'tomato' ),
                'id' => 'spyropress_lists',
                'type' => 'repeater',
                'item_title' => 'item',
                'fields' => array(
                
                    array(
                        'label' => esc_html__( 'Items', 'tomato' ),
                        'id' => 'spyropress_item',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => esc_html__( 'Icon', 'tomato' ),
                        'id' => 'spyropress_icon',
                        'type' => 'select',
                        'options' => spyropress_get_options_fontawesome_icons()
                    ),
                    
                )
            )
        );

        $this->create_widget();
    }

    function widget( $spyropress_args, $spyropress_instance ) {

        // extracting info
        extract( $spyropress_args ); extract( $spyropress_instance );

        //Required View File
        require( $this->get_view() ); 
    }

}
//register class Spyropress_Module_List_Item
spyropress_builder_register_module( 'Spyropress_Module_List_Item' );