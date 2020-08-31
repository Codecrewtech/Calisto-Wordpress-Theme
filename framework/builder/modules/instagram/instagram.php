<?php
/**
 * Module: Instagram Feed
 * Add Instagram Feed into the page layout wherever needed.
 */
 
class Spyropress_Module_Instagram extends SpyropressBuilderModule {
    
    public function __construct() {
        
        // Widget variable settings.
        $this->path =  get_template_directory().'/framework/builder/modules/instagram';
        $this->cssclass = 'spyropress_instagram';
        $this->description = esc_html__( 'Add Instagram Feed into the page layout wherever needed.', 'tomato' );
        $this->id_base = 'spyropress_instagram';
        $this->name = esc_html__( 'Instagram Feed', 'tomato' );

        // Fields
        $this->fields = array(
        
            array(
                'label' => esc_html__( 'Instagram Username', 'tomato' ),
                'type'  => 'text',
                'id' => 'spyropress_user_id'
            ),
            
            array(
                'label' => esc_html__( 'Instagram ID', 'tomato' ),
                'type'  => 'text',
                'id' => 'spyropress_client_id'
            ),
            
            array(
                'label' => esc_html__( 'Instagram Access Token', 'tomato' ),
                'type'  => 'text',
                'id' => 'spyropress_access_token'
            ),
            
            array(
                'label' => esc_html__( 'Limit of Instagram gallery images', 'tomato' ),
                'type'  => 'range_slider',
                'max'   => 20,
                'id' => 'spyropress_limit'
            )            
                  
        );
        
        $this->create_widget();
    }
    
    function widget( $spyropress_args, $spyropress_instance ) {

        // extracting info
        extract( $spyropress_args ); extract( $spyropress_instance );
        
        // get view to render
        require( $this->get_view() );
    }
}
//Register Class Spyropress_Module_Instagram.
spyropress_builder_register_module( 'Spyropress_Module_Instagram' );