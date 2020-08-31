<?php
/**
 * ThemeSquared: Recent Posts
 * The most recent posts on your site.
 *
 * @package		SpyroPress
 * @category	Widgets
 * @author		SpyroSol
 */
if (!function_exists('register_cpt_widget')) return;
class Spyropress_Widget_Recent_Posts extends SpyropressWidget {

    /**
     * Constructor
     */
    function __construct() {

        // Widget variable settings.
        $this->path =  get_template_directory().'/includes/widgets/recent-posts';
        $this->cssclass = 'recent_posts';
        $this->description = esc_html__( 'The most recent posts on your site.', 'tomato' );
        $this->id_base = 'spyropress_recent_comments';
        $this->name = esc_html__( 'ThemeSquared: Recent Posts', 'tomato' );
        
         //template.
        $this->templates['view']   = array( 'view' => 'view.php', 'label' =>__( 'Menu - List', 'tomato' ) );
        $this->templates['view-one']   = array( 'view' => 'view-one.php', 'label' =>__( 'Menu - Tile', 'tomato' ) );
        
        //Fields
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
                'type' => 'text',
            ),

            array(
                'label' => esc_html__( 'Number of products to show', 'tomato' ),
                'id' => 'spyropress_number',
                'type' => 'range_slider',
                'max' => 50
            ),
            
            array(
                'label' => esc_html__('Date', 'tomato'),
                'id' => 'spyropress_setting',
                'type' => 'checkbox',
                'options' => array(
                    'date' => esc_html__( 'Enable date for Recent Posts','tomato' ), 
                )
            )
        );

        $this->create_widget();
    }

    function widget( $spyropress_args, $spyropress_instance ) {

        // extracting info
        extract( $spyropress_args ); extract( $spyropress_instance );
        
        //Templates
        $spyropress_template = isset( $spyropress_instance['template'] ) ? $spyropress_instance['template'] : '';
        
        // get view to render
        require( $this->get_view( $spyropress_template ) );
    }

} 
// class SpyroPress_Widget_TabWidget
register_cpt_widget( 'Spyropress_Widget_Recent_Posts' );