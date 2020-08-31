<?php
/**
 * Module: Accordion
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Accordions extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path =  get_template_directory().'/framework/builder/modules/accordion';
        $this->cssclass = '';
        $this->description = esc_html__( 'Accordion Builder.', 'tomato' );
        $this->id_base = 'accordion';
        $this->name = esc_html__( 'Accordions', 'tomato' );

        // Fields
        $this->fields = array(
                        
            array(
                'label' => esc_html__( 'Accordion', 'tomato' ),
                'id' => 'spyropress_accordions',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    
                    array(
                        'label' => esc_html__( 'Title', 'tomato' ),
                        'id' => 'spyropress_title',
                        'type' => 'text'
                    ),
                    
                    array(
                        'label' => esc_html__( 'Accordion Bucket', 'tomato' ),
                        'id' => 'spyropress_bucket',
                        'type' => 'select',
                        'desc' => esc_html__( 'If you want to use complex html instead of plain text.', 'tomato' ),
                        'options' => spyropress_get_buckets()
                    ),
                    
                    array(
                        'label' => esc_html__( 'Content', 'tomato' ),
                        'id' => 'spyropress_content',
                        'type' => 'textarea',
                        'rows' => 7
                    )
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
//Register Module Class Spyropress_Module_Accordions
spyropress_builder_register_module( 'Spyropress_Module_Accordions' );