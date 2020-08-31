<?php
/**
 * Contact Info Widget
 * Quickly add contact info to your sidebar e.g. address, phone, email.
 *
 * @package		SpyroPress
 * @category	Widgets
 * @author		SpyroSol
 */
if (!function_exists('register_cpt_widget')) return;
class SpyroPress_Widget_Contact extends SpyropressWidget {

    private static $counter = 1;
    /**
     * Constructor
     */
    function __construct() {

        // Widget variable settings.
        $this->path =  get_template_directory().'/includes/widgets/contact-info';
        $this->cssclass = 'contacts-widget';
        $this->description = esc_html__( 'Quickly add contact info to your sidebar e.g. address, phone, email.', 'tomato' );
        $this->id_base = 'spyropress_contact';
        $this->name = esc_html__( 'ThemeSquared: Contact Info', 'tomato' );
        
        //Fields
        $this->fields = array(

            array(
                'label' => esc_html__( 'Title', 'tomato' ),
                'id' => 'spyropress_title',
                'type' => 'text',
            ),
            
            array(
                'label' => esc_html__( 'Social', 'tomato' ),
                'type' => 'sub_heading'
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
                'label' => esc_html__( 'Address', 'tomato' ),
                'id' => 'spyropress_address',
                'type' => 'text',
            ),

            array(
                'label' => esc_html__( 'Phone', 'tomato' ),
                'id' => 'spyropress_phone',
                'type' => 'text',
            ),

            array(
                'label' => esc_html__( 'Email', 'tomato' ),
                'id' => 'spyropress_email',
                'type' => 'text',
            )
        );

        $this->create_widget();

    }

    function widget( $spyropress_args, $spyropress_instance ) {

        // extracting info
        extract( $spyropress_args ); extract( $spyropress_instance  );

        // get view to render
        require( $this->get_view() );
    }

} 
// class SpyroPress_Widget_Contact
register_cpt_widget( 'SpyroPress_Widget_Contact' );