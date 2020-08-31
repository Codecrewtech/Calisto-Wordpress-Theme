<?php

/**
 * Module: Our Clients
 * Display a list of our clients
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Our_Clients extends SpyropressBuilderModule {

    /**
     * Constructor
     */
    public function __construct() {

        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/our-clients';
        $this->cssclass = 'module-our-clients';
        $this->description = esc_html__( 'Display a list of our clients.', 'tomato' );
        $this->id_base = 'spyropress_our_clients';
        $this->name = esc_html__( 'Our Clients', 'tomato' );

        // Fields
        $this->fields = array (

            array(
                'label' => esc_html__( 'Client', 'tomato' ),
                'id' => 'spyropress_clients',
                'type' => 'repeater',
                'fields' => array(
                    array(
                        'label' => esc_html__( 'Logo', 'tomato' ),
                        'id' => 'spyropress_logo',
                        'type' => 'upload'
                    ),
                    array(
                        'label' => esc_html__( 'Logo link', 'tomato' ),
                        'id' => 'spyropress_link',
                        'type' => 'text'
                    ),
                )
            ),

            array(
                'id' => 'spyropress_window',
                'type' => 'checkbox',
                'options' => array(
                    '1' => '<strong>' . __( 'Enable to open link in New Window', 'tomato' ) . '</strong>'
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
//Register Module Class Spyropress_Module_Our_Clients
spyropress_builder_register_module( 'Spyropress_Module_Our_Clients' );