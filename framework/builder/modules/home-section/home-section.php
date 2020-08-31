<?php
/**
 * Module: Home Section
 * Add Home Intro section content on the top of your site page
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Home_Section extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->path =  get_template_directory().'/framework/builder/modules/home-section';
        $this->cssclass = 'module-home-section';
        $this->description = esc_html__( 'Add Home Intro section content on the top of your site page', 'tomato' );
        $this->id_base = 'spyropress_home_section';
        $this->name = esc_html__( 'Home Intro Section', 'tomato' );
        
        // Templates
        $this->templates['view'] = array( 'view' => 'view.php', 'label' =>esc_html__( 'Style One', 'tomato' ) );
        $this->templates['view-one'] = array( 'view' => 'view-one.php', 'label' =>esc_html__( 'Style Two', 'tomato' ) );
        $this->templates['view-two'] = array( 'view' => 'view-two.php', 'label' =>esc_html__( 'Style Three', 'tomato' ) );
        $this->templates['view-three'] = array( 'view' => 'view-three.php', 'label' =>esc_html__( 'Style Four', 'tomato' ) );
        $this->templates['view-four'] = array( 'view' => 'view-four.php', 'label' =>esc_html__( 'Style Five', 'tomato' ) );
        
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
        		'label' => esc_html__( 'Custom Logo', 'tomato' ),
                'desc' => esc_html__( 'Upload a logo for your site or specify an image URL directly.', 'tomato' ),
        		'id' => 'spyropress_logo',
                'class' => 'template view view-one view-two view-three section-full',
                'type' => 'upload'
        	),
            
            array(
                'label' => esc_html__( 'Background', 'tomato' ),
                'id' => 'spyropress_bg_image',
                'class' => 'template view view-three section-full',
                'type' => 'upload',
            ),
        
            array(
                'label' => esc_html__( 'Heading Text', 'tomato' ),
                'id' => 'spyropress_heading',
                'class' => 'template view view-one view-two section-full',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Sub Heading Text', 'tomato' ),
                'id' => 'spyropress_sub_heading',
                'class' => 'template view view-one view-two section-full',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Video Title', 'tomato' ),
                'id' => 'spyropress_video_title',
                'class' => 'template view-two section-full',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Video', 'tomato' ),
                'id' => 'spyropress_video',
                'class' => 'template view-two section-full',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Slider Slides', 'tomato' ),
                'id' => 'spyropress_slides',
                'class' => 'template view-one section-full',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                
                    array(
                        'label' => esc_html__( 'Image', 'tomato' ),
                        'id' => 'spyropress_image',
                        'type' => 'upload',
                    )
                )
            ),
            
            array(
                'label' => esc_html__( 'Slider Slides', 'tomato' ),
                'id' => 'spyropress_slides_two',
                'class' => 'template view-four section-full',
                'type' => 'repeater',
                'item_title' => 'title',
                'fields' => array(
                    
                    array(
                        'label' => esc_html__( 'Heading Text', 'tomato' ),
                        'id' => 'spyropress_heading',
                        'type' => 'text',
                    ),
                    
                    array(
                        'label' => esc_html__( 'Sub Heading Text', 'tomato' ),
                        'id' => 'spyropress_sub_heading',
                        'type' => 'text',
                    ),
                
                    array(
                        'label' => esc_html__( 'Image', 'tomato' ),
                        'id' => 'spyropress_image',
                        'type' => 'upload',
                    )
                )
            ),
            array(
            	'label' => esc_html__( 'Link', 'tomato' ),
            	'id' => 'spyropress_url',
            	'type' => 'text',
            	'class' => 'template view view-one view-two view-three section-full'
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
//Register Module Class Spyropress_Module_Home_Section
spyropress_builder_register_module( 'Spyropress_Module_Home_Section' );