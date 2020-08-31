<?php

/**
 * Module: Icon Teaser
 * Display a brief text with a link and use hundreds of built-in icons
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Icon_Teaser extends SpyropressBuilderModule {

    /**
     * Constructor
     */
    public function __construct() {

        // Widget variable settings
        $this->path = dirname(__FILE__);
        $this->cssclass = 'module-icon-teaser';
        $this->description = esc_html__( 'Display a brief text with a link and use of icons.', 'tomato' );
        $this->id_base = 'spyropress_icon_teaser';
        $this->name = esc_html__( 'Icon Teaser', 'tomato' );
        
         // Templates
        $this->templates['view'] = array( 'view' => 'view.php', 'label' =>esc_html__( 'Style One', 'tomato' ) );
        $this->templates['view-one'] = array( 'view' => 'view-one.php', 'label' =>esc_html__( 'Style Two', 'tomato' ) );
        
        // Fields
        $this->fields = array (
        
            array(
                'label' => esc_html__( 'Template', 'tomato' ),
                'id' => 'template',
                'class' => 'enable_changer section-full',
                'type' => 'select',
                'options' => $this->get_option_templates()
            ),
            
            array(
                'label' => esc_html__( 'Columns', 'tomato' ),
                'id' => 'spyropress_columns',
                'class' => 'template view section-full',
                'type' => 'select',
                'options' => array(
                    2 => esc_html__( '2 Column', 'tomato' ),
                    3 => esc_html__( '3 Column', 'tomato' ),
                    4 => esc_html__( '4 Column', 'tomato' ),
                )
            ),
            
            array(
                'label' => esc_html__( 'Teaser', 'tomato' ),
                'id' => 'spyropress_teasers',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    
                    array(
                        'label' => esc_html__( 'Image', 'tomato' ),
                        'id' => 'spyropress_image',
                        'type' => 'upload'
                    ),
                    
                    array(
                        'label' => esc_html__( 'Title', 'tomato' ),
                        'id' => 'spyropress_title',
                        'type' => 'text'
                    ),

                    array(
                        'label' => esc_html__( 'Title Link', 'tomato' ),
                        'id' => 'spyropress_title_link',
                        'type' => 'text'
                    ),
        
                    array(
                        'label' => esc_html__( 'Content', 'tomato' ),
                        'id' => 'spyropress_content',
                        'type' => 'textarea',
                        'rows' => 3
                    ) 
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
        
        //Template Module
        $spyropress_template = isset( $spyropress_instance['template'] ) ? $spyropress_instance['template'] : '';
        
        //Required View File
        require( $this->get_view( $spyropress_template ) ); 
    }
    
    function spyropress_generate_teaser_one( $spyropress_item, $spyropress_atts ){
        
        //Image
        $spyropress_image = '';
        if( isset( $spyropress_item['spyropress_image'] ) ){
            $spyropress_image = '<div class="features-img"><img src="'. esc_url( $spyropress_item['spyropress_image'] ) .'"  /></div>';
        }
        
        $spyropress_item['spyropress_title_link'] = !empty($spyropress_item['spyropress_title_link']) ? $spyropress_item['spyropress_title_link'] : '#';
        //Retrun Html
        return 
        '<div class="'. esc_attr( $spyropress_atts['column_class'] ) .'">
            <div class="features-tile">
                '. $spyropress_image .'
                <div class="features-content">
                    <div class="page-header">
                        <h1><a href="'. esc_url( $spyropress_item['spyropress_title_link'] ) .'" >'.  $spyropress_item['spyropress_title'] .'</a></h1>
                    </div>
                    <p>'.  $spyropress_item['spyropress_content']  .'</p>
                </div>
            </div>
        </div>';
    }
    
    function spyropress_generate_teaser_two( $spyropress_item, $spyropress_atts ){
        
        //Image
        $spyropress_image = '';
        if( isset( $spyropress_item['spyropress_image'] ) ){
            $spyropress_image = '<img src="'. esc_url( $spyropress_item['spyropress_image'] ) .'" class="center-block"  />';
        }

        $spyropress_item['spyropress_title_link'] = !empty($spyropress_item['spyropress_title_link']) ? $spyropress_item['spyropress_title_link'] : '#';
        
        //Retrun Html
        return 
        '<div class="service-content text-center">
            '. $spyropress_image .'
            <h4 class="text-uppercase"><a href="'. esc_url( $spyropress_item['spyropress_title_link'] ) .'" >'. $spyropress_item['spyropress_title'] .'</a></h4>
            <p>'.  $spyropress_item['spyropress_content'] .'</p>
        </div>';
    }
}
//Register Module Class Spyropress_Module_Icon_Teaser
spyropress_builder_register_module( 'Spyropress_Module_Icon_Teaser' );