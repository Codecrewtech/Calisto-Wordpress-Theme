<?php

/**
 * Module: Rich Text
 * Provides a WYSIWYG editor.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Rich_Text extends SpyropressBuilderModule {

    public function __construct() {
        
        // Widget variable settings.
        $this->path =  get_template_directory().'/framework/builder/modules/rich-text';
        $this->cssclass = 'rich-text';
        $this->description = esc_html__( 'Provides a WYSIWYG editor.', 'tomato' );
        $this->id_base = 'rich_text';
        $this->name = esc_html__( 'Rich Text', 'tomato' );

        // Fields
        $this->fields = array(
            array(
                'id' => 'rich_text',
                'type' => 'editor'
            )
        );

        $this->create_widget();
    }

    function widget( $spyropress_args, $spyropress_instance ) {

        // extracting info
        extract( $spyropress_args ); extract( $spyropress_instance );
         
        //Required View File
        require( $this->get_view( ) ); 
    }
}
spyropress_builder_register_module( 'Spyropress_Module_Rich_Text' );