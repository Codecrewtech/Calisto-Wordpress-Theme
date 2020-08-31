<?php
/**
 * Full with
 */
class fullwidth_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( 'Fullwidth Row', 'tomato' ),
            'description' => esc_html__( 'Fullwidth row', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_11' )
            )
        );
    }
    
    function row_wrapper( $row_ID, $row ) {
        extract( $row['options'] );
    
        // CssClass
        $spyropress_section_class = array();$spyropress_style = '';
        if( isset( $spyropress_skin ) && !empty( $spyropress_skin ) ){
            $spyropress_section_class[] = $spyropress_skin;
            if( 'special' == $spyropress_skin ){
                if( isset( $spyropress_bg) && !empty( $spyropress_bg ) ) {
                    $spyropress_value = $spyropress_bg;
                    $spyropress_img = '';
                    $spyropress_bg_contents = array();
            
                    if ( isset( $spyropress_value['background-color'] ) )
                        $spyropress_bg_contents[] = $spyropress_value['background-color'];
            
                    if ( isset( $spyropress_value['background-pattern'] ) )
                        $spyropress_img = $spyropress_value['background-pattern'];
                    elseif ( isset( $spyropress_value['background-image'] ) )
                        $spyropress_img = $spyropress_value['background-image'];
                    if ( $spyropress_img )
                        $spyropress_bg_contents[] = 'url(\'' . esc_url( $spyropress_img ) . '\')';
            
                    if ( isset( $spyropress_value['background-repeat'] ) )
                        $spyropress_bg_contents[] = $spyropress_value['background-repeat'];
            
                    if ( isset( $spyropress_value['background-attachment'] ) )
                        $spyropress_bg_contents[] = $spyropress_value['background-attachment'];
            
                    if ( isset( $spyropress_value['background-position'] ) )
                        $spyropress_bg_contents[] = $spyropress_value['background-position'];
            
                    $spyropress_style .= ( !empty( $spyropress_bg_contents ) ) ? ' background: ' . join( ' ', $spyropress_bg_contents ) . '; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;' : '';
               
                if( !empty( $spyropress_style ) )
                    $spyropress_style = 'style="' . $spyropress_style . '"';
                }
                
            }
        }
    
        $spyropress_row_html = sprintf( '
            <div id="%1$s" class="%2$s" %5$s>
                <div class="%3$s">
                    %4$s
                </div>
            </div>', $row_ID, spyropress_clean_cssclass( $spyropress_section_class ), get_row_class( true ), builder_render_frontend_columns( $row['columns'] ), $spyropress_style
        );
    
        return $spyropress_row_html; 
     }   
}
spyropress_builder_register_row( 'fullwidth_row_class' );