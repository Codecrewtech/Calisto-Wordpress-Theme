<?php

/**
 * Widgets init
 *
 * Init the widgets.
 *
 * @class       Widgets
 * @package		Spyropress
 * @category	class
 */

class SpyropressWidgets {

    private $conditions;

    function __construct() {

        $this->generate_conditions();
        $this->spyropress_includes();

        // Hooks
        add_action( 'init', array( $this, 'init' ) );
        add_filter( 'widget_text', 'shortcode_unautop' );
        add_filter( 'widget_text', 'do_shortcode' );
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
        add_filter( 'get_archives_link', array( $this, 'archive_span_count' ) );
        add_filter( 'wp_list_categories', array( $this, 'apply_span_count' ) );

        if( class_exists( 'advanced_text' ) ) {
            remove_action( 'atw_condition_fields', 'atw_add_condition_fields', 10 );
        }
    }

    function spyropress_includes() {

        // Allow child themes/plugins to add widgets to be loaded.
        $widgets = apply_filters( 'spyropress_register_widgets', array() );

        if( !empty( $widgets ) ) {
            foreach ( $widgets as $widget ) {
                include_once( $widget );
            }
        }
    }

    function init() {
        add_filter( 'widget_display_callback', array( $this, 'apply_widget_visibility' ), 10, 3 );
        add_filter( 'dynamic_sidebar_params', array( $this, 'apply_widget_styles' ) );
    }

    function widgets_init() {

        /** Add and update field values in widget **/
        if ( is_admin() ) {
            add_filter( 'widget_update_callback', array( $this, 'widget_extras_update' ), 10, 2 );
            add_filter( 'in_widget_form', array( $this, 'widget_extras_form' ), 10, 3 );
        }

        $this->spyropress_unregister_widgets();
    }

    function spyropress_unregister_widgets() {

        $unregister_widgets = apply_filters( 'spyropress_unregister_widgets', array() );

        if( !empty( $unregister_widgets ) && function_exists('unregister_cpt_widget') ) {
            foreach ( $unregister_widgets as $widget ) {
	            unregister_cpt_widget( $widget );
            }
        }
    }

    function widget_extras_form( $widget, $return, $instance ) {

        $widget_settings = '';
        if ( ! $instance ) {
            $widget_settings = get_option( $widget->option_name );
            if( isset( $widget_settings[$widget->number] ) )
                $instance = $widget_settings[$widget->number];
        }

        // if module
        if ( isset( $widget->is_builder ) && $widget->is_builder ) {
            $defaults = array(
                'custom_container_id' => '',
                'custom_container_class' => '',
                'row_custom_css' => ''
            );

            $args = shortcode_atts( $defaults, $instance );
            extract( $args );

            get_template_part( 'framework/spyroprss-module', 'extras' );
        }
        else {
            $defaults = array(
                'custom_container_id' => '',
                'custom_container_class' => '',
                'custom_action' => '1',
                'custom_show' => '',
                'custom_slug' => '',
                'suppress_title' => ''
            );

            $args = shortcode_atts( $defaults, $instance );
            extract( $args );

            get_template_part( 'framework/spyroprss-widget', 'extras' );
        }
    }

    function widget_extras_update( $instance, $new_instance ) {
        
        if(
            isset( $instance['menu_id'] ) && isset( $instance['menu_label'] ) &&
            !empty( $instance['menu_id'] ) && !empty( $instance['menu_label'] )
        ) {
            $new_instance['custom_container_id'] = $instance['custom_container_id'];
        }
        if ( isset( $new_instance['custom_container_id'] ) && !empty( $new_instance['custom_container_id'] ) )
            $instance['custom_container_id'] = $new_instance['custom_container_id'];
        else
            unset( $instance['custom_container_id'] );

        if ( isset( $new_instance['custom_container_class'] ) && !empty( $new_instance['custom_container_class'] ) )
            $instance['custom_container_class'] = $new_instance['custom_container_class'];
        else
            unset( $instance['custom_container_class'] );
        
        if ( isset( $new_instance['row_custom_css'] ) && !empty( $new_instance['row_custom_css'] ) )
            $instance['row_custom_css'] = $new_instance['row_custom_css'];
        else
            unset( $instance['row_custom_css'] );

        if ( isset( $new_instance['custom_action'] ) )
            $instance['custom_action'] = $new_instance['custom_action'];

        if ( isset( $new_instance['custom_show'] ) )
            $instance['custom_show'] = $new_instance['custom_show'];

        if ( isset( $new_instance['custom_slug'] ) && !empty( $new_instance['custom_slug'] ) )
            $instance['custom_slug'] = $new_instance['custom_slug'];
        else
            unset( $instance['custom_slug'] );

        if ( isset( $new_instance['suppress_title'] ) && !empty( $new_instance['suppress_title'] ) )
            $instance['suppress_title'] = $new_instance['suppress_title'];
        else
            unset( $instance['suppress_title'] );

        return $instance;
    }

    function apply_widget_styles( $params ) {

        global $wp_registered_widgets;

        $widget_id = $params[0]['widget_id'];
        $widget_obj = $wp_registered_widgets[$widget_id];
        $widget_opt = get_option( $widget_obj['callback'][0]->option_name );
        $widget_num = $widget_obj['params'][0]['number'];

        $defaults = array(
            'custom_container_id' => '',
            'custom_container_class' => '',
            'template' => '',
        );

        $cssclass = shortcode_atts( $defaults, $widget_opt[$widget_num] );
        extract( $cssclass );

        if (
            isset( $widget_obj['callback'][0]->templates ) &&
            !empty( $widget_obj['callback'][0]->templates ) &&
            isset( $widget_obj['callback'][0]->templates[$template]['class'] )
            
        )
            $template = $widget_obj['callback'][0]->templates[$template]['class'];

        // custom id
        if ( '' != $custom_container_id )
            $params[0]['before_widget'] = preg_replace( '/id=".*?"/', 'id="' . $custom_container_id . '"', $params[0]['before_widget'], 1 );

        // cusotm class
        $cssclass = array();
        $cssclass[] = $template;
        $cssclass[] = $custom_container_class;
        $cssclass = spyropress_clean_array( $cssclass );

        if( !empty( $cssclass ) ) {
            $count = 1;
            $params[0]['before_widget'] = str_replace( 'class="', 'class="' . implode( ' ', $cssclass ) . ' ', $params[0]['before_widget'], $count );
        }

        return $params;
    }

    function apply_widget_visibility( $instance, $widget_obj = null, $args = false ) {
        global $post;

        // unset title
        if ( isset( $instance['suppress_title'] ) && false != $instance['suppress_title'] )
            unset( $instance['title'] );

        if( !isset( $instance['custom_action'] ) ) return $instance;

        $slug = '';
        $action = $instance['custom_action'];
        if ( isset( $instance['custom_show'] ) )
            $show = $instance['custom_show'];
        if ( isset( $instance['custom_slug'] ) )
            $slug = $instance['custom_slug'];

        // Do the conditional tag checks.
        $arg = explode( '|', $slug );

        // Checking if $show in not numeric - in that case we have older version conditions
        $code = $this->conditions[$show]['code'];

        $num = count( $arg );
        $i = 1;

        foreach ( $arg as $k => $v ) {

            $ids = explode( ",", $v );
            $str = '';
            $values = array();

            //wrap each value into quotation marks
            foreach ( $ids as $val )
                if ( $val != "" ) $values[] = '"' . $val . '"';

            $str = ( 1 == count( $values ) ) ? $values[0] : 'array(' . implode( ',', $values ) . ')';

            //if multiple values, then put them into an array
            if ( 1 < $num ) $code = str_replace( '$arg' . $i, $str, $code );
            else  $code = str_replace( '$arg', $str, $code );
            $i++;
        }

        if ( $code != false && $action == '1' ) {

            $code = "if($code){ return true; }else{ return false; }";

            return $instance;

        }
        elseif ( $code != false ) {

            $code = "if($code){ return false; }else{ return true; }";
            return $instance;
        }

        return false;
    }
    
    function archive_span_count( $link_html ) {
        return str_replace( '</a>', '</a><span>', $link_html ) . '</span>';
    }
    
    function apply_span_count( $html ) {
        $html = str_replace( '</a>', '</a> <span>', $html );
        $html = str_replace( '</li>', '</span></li>', $html );
        return $html;
    }

    private function generate_conditions() {

        $this->conditions = array(
            array(
                'name' => esc_html__( 'All', 'tomato' ),
                'code' => 'true',
            ),
            array(
                'name' => esc_html__( 'Home Page', 'tomato' ),
                'code' => 'is_home()',
            ),
            array(
                'name' => esc_html__( 'Front Page', 'tomato' ),
                'code' => 'is_front_page()',
            ),
            array(
                'name' => esc_html__( 'Sticky Post', 'tomato' ),
                'code' => 'is_sticky($arg)',
            ),
            array(
                'name' => esc_html__( 'Single Post', 'tomato' ),
                'code' => 'is_single($arg)',
            ),
            array(
                'name' => esc_html__( 'Page', 'tomato' ),
                'code' => 'is_page($arg)',
            ),
            array(
                'name' => esc_html__( 'Child of Page ID', 'tomato' ),
                'code' => '(int)$arg == $post->post_parent',
            ),
            array(
                'name' => esc_html__( 'Post Type', 'tomato' ),
                'code' => 'is_singular($arg)',
            ),
            array(
                'name' => esc_html__( 'Category', 'tomato' ),
                'code' => 'is_category($arg)',
            ),
            array(
                'name' => esc_html__( 'Post in Category', 'tomato' ),
                'code' => 'in_category($arg)',
            ),
            array(
                'name' => esc_html__( 'Tag', 'tomato' ),
                'code' => 'is_tag($arg)',
            ),
            array(
                'name' => esc_html__( 'Post has Tag', 'tomato' ),
                'code' => 'has_tag($arg)',
            ),
            array(
                'name' => esc_html__( 'Taxonomy', 'tomato' ),
                'code' => 'is_tax($arg)',
            ),
            array(
                'name' => esc_html__( 'Post Type Archive', 'tomato' ),
                'code' => 'is_post_type_archive($arg)',
            ),
            array(
                'name' => esc_html__( 'Blog', 'tomato' ),
                'code' => 'is_home() || is_archive()',
            ),
            array(
                'name' => esc_html__( 'Search Results Page', 'tomato' ),
                'code' => 'is_search()',
            ),
            array(
                'name' => esc_html__( 'QueryString', 'tomato' ),
                'code' => 'is_querystring($arg)',
            )
        );
    }
}
?>