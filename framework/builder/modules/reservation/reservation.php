<?php
/**
 * Module: Reservation
 * Add Table Reservation Form into the page layout wherever needed.
 */

class Spyropress_Module_Reservation extends SpyropressBuilderModule {
    
    public function __construct() {
        
         // Widget variable settings.
         $this->path =  get_template_directory().'/framework/builder/modules/reservation';
        $this->cssclass = 'spyropress_reservation';
        $this->description = esc_html__( 'Add Table Reservation Form into the page layout wherever needed.', 'tomato' );
        $this->id_base = 'spyropress_reservation';
        $this->name = esc_html__( 'Reservation Form', 'tomato' );
        
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
                'label' => esc_html__( 'Contact Form Seven', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view section-full',
                'id' => 'spyropress_contact_frm'
            ),
            
            array(
                'label' => esc_html__( 'Restaurant Id', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view-one section-full',
                'id' => 'spyropress_restaurant_id',
                'std' => '66241'
            ),
            
            array(
                'label' => esc_html__( 'Date', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view-one section-full',
                'id' => 'spyropress_date',
                'std' => 'Date'
            ),
            
            array(
                'label' => esc_html__( 'Guests', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view-one section-full',
                'id' => 'spyropress_guests',
                'std' => 'Guests'
            ),
            
            array(
                'label' => esc_html__( 'Time', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view-one section-full',
                'id' => 'spyropress_time',
                'std' => 'Time'
            ),
            
            array(
                'label' => esc_html__( 'Button', 'tomato' ),
                'type'  => 'text',
                'class' => 'template view-one section-full',
                'id' => 'spyropress_btn',
                'std' => 'Make Reservation'
            ),
            
            array(
                'label' => esc_html__( 'Form Footer', 'tomato' ),
                'type'  => 'text',
                'id' => 'spyropress_frm_footer'
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
//Register Class Spyropress_Module_Reservation.
spyropress_builder_register_module( 'Spyropress_Module_Reservation' );