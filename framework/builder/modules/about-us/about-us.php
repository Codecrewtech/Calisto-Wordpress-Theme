<?php
/**
 * Module: About Us
 * Display short information ( images and text description ) about us.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_About_Us extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings.
        $this->path =  get_template_directory().'/framework/builder/modules/about-us';
        $this->cssclass = 'module-about-us';
        $this->description = esc_html__( 'Display short information ( images and text description ) about yourself.', 'tomato' );
        $this->id_base = 'spyropress_about-us';
        $this->name = esc_html__( 'About Us', 'tomato' );
        
        // Templates
        $this->templates['view'] = array( 'view' => 'view.php', 'label' =>esc_html__( 'Style One', 'tomato' ) );
        $this->templates['view-one'] = array( 'view' => 'view-one.php', 'label' =>esc_html__( 'Style Two', 'tomato' ) );
       
        // Fields
        $this->fields = array(
        
            array(
                'label' => esc_html__( 'Template', 'tomato' ),
                'id' => 'template',
                'class' => 'enable_changer section-full',
                'type' => 'select',
                'options' => $this->get_option_templates()
            ),
            
            array(
                'label' => esc_html__( 'Title', 'tomato' ),
                'id' => 'spyropress_title',
                'class' => 'section-full template view-one',
                'type' => 'text'
            ),
            
            array(
                'label' => esc_html__( 'Image', 'tomato' ),
                'id' => 'spyropress_images',
                'class' => 'section-full template view',
                'type' => 'repeater',
                'fields' => array(
                
                    array(
                        'label' => esc_html__( 'Fornt Image', 'tomato' ),
                        'id' => 'spyropress_front_image',
                        'type' => 'upload',
                    ),
                    
                    array(
                        'label' => esc_html__( 'Popup Image', 'tomato' ),
                        'id' => 'spyropress_popup_image',
                        'type' => 'upload',
                    )
                )
            ),
            
            array(
                'label' => esc_html__( 'Content', 'tomato' ),
                'id' => 'spyropress_content',
                'type' => 'textarea',
                'rows' => 5
            ),
            
            array(
                'label' => esc_html__( 'Image', 'tomato' ),
                'id' => 'spyropress_image',
                'class' => 'section-full template view-one',
                'type' => 'upload',
            ),
            
            array(
                'label' => esc_html__( 'Signature Image', 'tomato' ),
                'id' => 'spyropress_signature',
                'class' => 'section-full template view',
                'type' => 'upload',
            ),
            
            array(
                'label' => esc_html__( 'Button', 'tomato' ),
                'type' => 'toggle',
                'class' => 'section-full template view-one',
            ),
            
                array(
            		'label' => esc_html__( 'Button Text', 'tomato' ),
            		'id' => 'spyropress_btn_text',
                    'class' => 'section-full template view-one',
                    'type' => 'text'
            	),
                
                array(
                    'label' => esc_html__( 'Button Url', 'tomato' ),
                    'id' => 'spyropress_url',
                    'class' => 'section-full template view-one',
                    'type' => 'text'
                ),
                
            array(
        		'type' => 'toggle_end'
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
        
        //Template Module
        $spyropress_template = isset( $spyropress_instance['template'] ) ? $spyropress_instance['template'] : '';
        
        //Required View File
        require( $this->get_view( $spyropress_template ) ); 
    }

}
//Register Module Class Spyropress_Module_About_Us
spyropress_builder_register_module( 'Spyropress_Module_About_Us' );