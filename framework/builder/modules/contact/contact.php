<?php

/**
 * Contact Info
 * Quickly add contact info to your sidebar e.g. address, phone, email.
 *
 * @package		SpyroPress
 * @category	Modules
 * @author		SpyroSol
 */

class SpyroPress_Module_Contact extends SpyropressBuilderModule {

    private static $counter = 1;

    /**
     * Constructor
     */
    function __construct() {

        // Widget variable settings.
        $this->path =  get_template_directory().'/framework/builder/modules/contact';
        $this->cssclass = 'contact-info';
        $this->description = esc_html__( 'Quickly add contact info', 'tomato' );
        $this->id_base = 'spyropress_contact';
        $this->name = esc_html__( 'Contact Info', 'tomato' );

        $this->fields = array(
            array(
                'label' => esc_html__( 'Title', 'tomato' ),
                'id' => 'spyropress_title',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Address', 'tomato' ),
                'id' => 'spyropress_address',
                'type' => 'textarea',
                'rows' => 3
            ),
        
            array(
                'label' => esc_html__( 'Email', 'tomato' ),
                'id' => 'spyropress_email',
                'type' => 'text',
            ),
            array(
                'label' => esc_html__( 'Phone', 'tomato' ),
                'id' => 'spyropress_phone',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Contact Form', 'tomato' ),
                'id' => 'spyropress_contact_frm',
                'type' => 'text',
                'desc' => esc_html__( 'Insert Contact Form Seven Sortcode', 'tomato' )
            ),
            
            array(
                'label' => esc_html__( 'Timing', 'tomato' ),
                'type' => 'toggle',
            ),
                array(
                    'label' => esc_html__( 'Title', 'tomato' ),
                    'id' => 'spyropress_sub_title',
                    'type' => 'text',
                ),
                
                array(
                    'label' => esc_html__( 'Timing', 'tomato' ),
                    'id' => 'spyropress_times',
                    'type' => 'repeater',
                    'item_title' => 'title',
                    'fields' => array(
                        
                        array(
                            'label' => esc_html__( 'Time Start', 'tomato' ),
                            'id' => 'spyropress_start',
                            'type' => 'text'
                        ),
                        
                        array(
                            'label' => esc_html__( 'Time End', 'tomato' ),
                            'id' => 'spyropress_end',
                            'type' => 'text'
                        ),
            
                        array(
                            'label' => esc_html__( 'Day', 'tomato' ),
                            'id' => 'spyropress_day',
                            'type' => 'text'
                        ) 
                    )
                ),
            
            array(
                'type' => 'toggle_end',
            ),
            
            array(
                'label' => esc_html__( 'Social Network Icons', 'tomato' ),
                'type' => 'toggle',
            ),
                array(
                    'label' => esc_html__( 'Title', 'tomato' ),
                    'id' => 'spyropress_icon_title',
                    'type' => 'text',
                ),
                
                array(
            		'label' => esc_html__( 'Social', 'tomato' ),
            		'type' => 'repeater',
                    'id' => 'spyropress_socials',
                    'hide_label' => true,
                    'item_title' => 'icon',
                    'fields' => array(
                        array(
                            'label' => esc_html__( 'Soccial Icon', 'tomato' ),
                            'id' => 'spyropress_icon',
                            'type' => 'select',
                            'options' => spyropress_get_options_social()
                        ),
            
                        array(
                            'label' => esc_html__( 'Link', 'tomato' ),
                            'id' => 'spyropress_link',
                            'type' => 'text',
                        )
                    )
            	),
                
            array(
                'type' => 'toggle_end',
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
//Register Module Class SpyroPress_Module_Contact
spyropress_builder_register_module( 'SpyroPress_Module_Contact' );