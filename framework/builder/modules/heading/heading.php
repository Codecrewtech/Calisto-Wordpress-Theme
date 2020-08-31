<?php
/**
 * Module: Heading
 * Add headings into the page layout wherever needed.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Heading extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/heading';
        $this->cssclass = 'module-heading';
        $this->description = esc_html__( 'Add headings into the page layout wherever needed.', 'tomato' );
        $this->id_base = 'spyropress_heading';
        $this->name = esc_html__( 'Heading', 'tomato' );

        // Fields
        $this->fields = array(

            array(
                'label' => esc_html__( 'Heading Text', 'tomato' ),
                'id' => 'spyropress_heading',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'HTML Tag', 'tomato' ),
                'id' => 'spyropress_html_tag',
                'type' => 'select',
                'options' => array(
                    'h1' => esc_html__( 'H1', 'tomato' ),
                    'h2' => esc_html__( 'H2', 'tomato' ),
                    'h3' => esc_html__( 'H3', 'tomato' ),
                    'h4' => esc_html__( 'H4', 'tomato' ),
                    'h5' => esc_html__( 'H5', 'tomato' ),
                    'h6' => esc_html__( 'H6', 'tomato' )
                ),
                'std' => 'h1'
            ),
            
            array(
        		'label' => esc_html__( 'White Color', 'tomato' ),
        		'id' => 'spyropress_color',
                'type' => 'checkbox',
                'options' => array(
                    '1' => esc_html__( 'Enable Text Color White', 'tomato' ),
                )
        	),
            
            array(
                'label' => esc_html__( 'Animation', 'tomato' ),
                'type' => 'toggle',
            ),
            
                array(
            		'label' => esc_html__( 'Animation', 'tomato' ),
            		'id' => 'spyropress_animation',
                    'type' => 'select',
                    'options' => spyropress_get_options_animation()
            	),
                
                array(
                    'label' => esc_html__( 'Delay', 'tomato' ),
                    'id' => 'spyropress_delay',
                    'type' => 'text'
                ),
                
            array(
        		'type' => 'toggle_end'
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
//Register Module Class Spyropress_Module_Heading
spyropress_builder_register_module( 'Spyropress_Module_Heading' );