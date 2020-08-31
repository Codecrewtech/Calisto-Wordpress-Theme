<?php

/**
 * Module: Sub-Pages
 * A list of sub-page titles or excerpts.
 *
 * @author 		SpyroSol
 * @category 	BuilderModules
 * @package 	Spyropress
 */

class Spyropress_Row_Options extends SpyropressBuilderModule {

    public function __construct() {

        $this->cssclass = 'row-options';
        $this->description = esc_html__( 'Set row options and styling here.', 'tomato' );
        $this->id_base = 'spyropress_row_options';
        $this->name = esc_html__( 'Row Options', 'tomato' );
        $this->show_custom_css = true;

        $locations = get_registered_nav_menus();
        $menus = wp_get_nav_menus();
        $menu_options = array();

        if ( isset( $locations ) && count( $locations ) > 0 && isset( $menus ) && count( $menus ) > 0 ) {
            foreach ( $menus as $menu ) {
                $menu_options[$menu->term_id] = $menu->name;
            }
        }

        // Fields
        $this->fields = array(

            array(
                'id' => 'show',
                'type' => 'checkbox',
                'options' => array(
                    '1' => '<strong>' . esc_html__( 'Disable this row temporarily', 'tomato' ) . '</strong>'
                )
            ),

            array(
                'label' => esc_html__( 'Section Skin', 'tomato' ),
                'id' => 'spyropress_skin',
                'type' => 'select',
                'class' => 'enable_changer section-full',
                'options' => array(
                    'special' => esc_html__( 'Special Section','tomato' ),
                    'trusted-quote' => esc_html__( 'Quote Section','tomato' ),
                    'subscribe-section' => esc_html__( 'Subscribe Section','tomato' ),
                    'menu2' => esc_html__( 'Menu Section', 'tomato' ),
                    'services' => esc_html__( 'Services Section', 'tomato' ),
                    'team' => esc_html__( 'Team Section', 'tomato' ),
                    'main-content contact-content' => esc_html__( 'Contact Section', 'tomato' )
                )
            ),
            
            array(
                'label' => esc_html__( 'Section Background', 'tomato' ),
                'id' => 'spyropress_bg',
                'class' => 'spyropress_skin special trusted-quote section-full',
                'type' => 'background'
            )
        );

        if( !empty( $menu_options ) ) {

            $this->fields[] = array(
                'label' => esc_html__( 'OnePage Menu Builder', 'tomato' ),
                'type' => 'sub_heading'
            );

            $this->fields[] = array(
                'label' => esc_html__( 'Select Menu', 'tomato' ),
                'id' => 'menu_id',
                'type' => 'select',
                'options' => $menu_options
            );

            $this->fields[] = array(
                'label' => esc_html__( 'Menu Label', 'tomato' ),
                'id' => 'menu_label',
                'type' => 'text'
            );
        }

        $this->create_widget();

        add_filter( 'builder_save_row_css', array( $this, 'compile_css' ), 10, 3 );
    }

    function after_validate_fields( $instance = '' ) {

        if(
            isset( $instance['menu_id'] ) && isset( $instance['menu_label'] ) &&
            !empty( $instance['menu_id'] ) && !empty( $instance['menu_label'] )
        ) {

            $key = sanitize_key( $instance['menu_label'] );
            if( isset( $instance['custom_container_id'] ) && !empty( $instance['custom_container_id'] ) )
                 $key = $instance['custom_container_id'];
            else
                $instance['custom_container_id'] = $key;
            $menu_link = '#HOME_URL#' . $key;
            
            $is_link = false;
            $menu_item_id = $menu_item_position = 0;

            $menu_items = wp_get_nav_menu_items( $instance['menu_id'] );
            foreach ( $menu_items as $menu_item ) {
                if ( $menu_item->url == $menu_link ) {
                    $menu_item_id = $menu_item->ID;
                    $menu_item_position = $menu_item->menu_order;
                    break;
                }
            }
            
            wp_update_nav_menu_item( $instance['menu_id'], $menu_item_id, array(
                'menu-item-title' => $instance['menu_label'],
                'menu-item-classes' => 'internal',
                'menu-item-url' => $menu_link,
                'menu-item-position' => $menu_item_position,
                'menu-item-status' => 'publish'
            ) );
            
            update_option( 'menu_check', true );
        }
        return $instance;
    }

    function compile_css( $row_id, $instance, $old_instance ) {

        $row_id = isset( $instance['custom_container_id'] ) ? $instance['custom_container_id'] : $row_id;
        $row_class = isset( $instance['custom_container_class'] ) ? $instance['custom_container_class'] : '';
        $insertion = '';

        // row custom css
        if ( isset( $instance['row_custom_css'] ) && $instance['row_custom_css'] ) {
            $custom_css = $instance['row_custom_css'];

            /**
             * @deprecated {this_row}
             * @version 3.10
             */
            $custom_css = str_replace( '{this_row}', '#' . $row_id, $custom_css );

            /**
             * @since 3.10
             */
            $custom_css = str_replace( '{row_id}', '#' . $row_id, $custom_css );
            $custom_css = str_replace( '{row_class}', '.' . spyropress_uglify_cssclass( $row_class ), $custom_css );

            $insertion .= $custom_css;
        }

        return $insertion;
    }
}