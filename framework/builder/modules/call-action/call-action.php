<?php
/**
 * Module: Call of Action
 * A lightweight, flexible component to showcase key content on your site.
 *
 * @author 		SpyroSol
 * @category 	SpyropressBuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Call_Action extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/call-action';
        $this->description = esc_html__( 'Call of Actin', 'tomato' );
        $this->id_base = 'call_action';
        $this->name = esc_html__( 'Call of Action', 'tomato' );
        
        // Fields
        $this->fields = array(
            
            array(
                'label' => esc_html__( 'Title', 'tomato' ),
                'id' => 'spyropress_title',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Sub Title', 'tomato' ),
                'id' => 'spyropress_sub_title',
                'type' => 'text'
            ),
            
            array(
                'label' => esc_html__( 'Mailchamp Form', 'tomato' ),
                'id' => 'spyropress_frm_shortcode',
                'type' => 'text'
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
//Register Module Class Spyropress_Module_Call_Action
spyropress_builder_register_module( 'Spyropress_Module_Call_Action' );