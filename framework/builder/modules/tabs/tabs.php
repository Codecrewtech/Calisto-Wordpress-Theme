<?php
/**
 * Module: Tabs
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Tabs extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/tabs';
        $this->description = esc_html__( 'Tab Builder.', 'tomato' );
        $this->id_base = 'tab';
        $this->name = esc_html__( 'Tabs', 'tomato' );

        // Fields
        $this->fields = array(
            array(
                'label' => esc_html__( 'Tab', 'tomato' ),
                'id' => 'spyropress_tabs',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    
                    array(
                        'label' => esc_html__( 'Title', 'tomato' ),
                        'id' => 'spyropress_title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => esc_html__( 'Tab Bucket', 'tomato' ),
                        'id' => 'spyropress_bucket',
                        'type' => 'select',
                        'desc' => 'If you want to use html instead of plain text.',
                        'options' => spyropress_get_buckets()
                    ),
                    
                    array(
                        'label' => esc_html__( 'Content', 'tomato' ),
                        'id' => 'spyropress_content',
                        'type' => 'textarea',
                        'rows' => 7
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
//Register Module Class Spyropress_Module_Tabs
spyropress_builder_register_module( 'Spyropress_Module_Tabs' );