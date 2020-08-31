<?php

/**
 * Module: Gmap
 * Add google map into the page layout wherever needed.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Module_Gmap extends SpyropressBuilderModule {

    public function __construct() {

        // Widget variable settings
        $this->description = esc_html__( 'Add google map markers work with google map row only.', 'tomato' );
        $this->id_base = 'gmap_markers';
        $this->name = esc_html__( 'Google Map Markers', 'tomato' );

        // Fields
        $this->fields = array(

            
            array(
                'label' => esc_html__( 'Markers Location', 'tomato' ),
                'type' => 'sub_heading',
                'desc' => 'Find the Latitude and Longitude of your address:<br />
                        - http://universimmedia.pagesperso-orange.fr/geo/loc.htm<br />
                        - http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/'
            ),
            
            array(
                'label' => esc_html__( 'Initial Location', 'tomato' ),
                'type' => 'sub_heading'
            ),
            
            array(
                'label' => esc_html__( 'Latitude', 'tomato' ),
                'id' => 'init_lat',
                'type' => 'text'
            ),
            
            array(
                'label' => esc_html__( 'Longitude', 'tomato' ),
                'id' => 'init_long',
                'type' => 'text'
            ),
        );

        $this->create_widget();
    }

    function widget( $spyropress_args, $spyropress_instance ) {

        extract( $spyropress_args ); extract( $spyropress_instance );
        //Check.
        if( empty( $init_lat ) || empty( $init_long ) ) return;
        $key = get_setting( 'goolgle_map_key', 'AIzaSyDW40y4kdsjsz714OVTvrw7woVCpD8EbLE');
        wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key='. $key, false, false, true );
        wp_enqueue_script( 'jquery-gmap', framework_url() . 'builder/modules/gmap/map.js', false, false, true );
        
        //Google Map.
        echo '<div id="map" data-latitude="'. esc_attr( $init_lat ) .'" data-longitude="'. esc_attr( $init_long ) .'"></div>';
    }
}
//Register Module Class Spyropress_Module_Gmap
spyropress_builder_register_module( 'Spyropress_Module_Gmap' );