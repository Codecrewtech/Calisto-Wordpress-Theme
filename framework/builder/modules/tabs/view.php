<?php
// chcek
if ( empty( $spyropress_tabs ) ) return;

$spyropress_count = 0;
$spyropress_tab_nav = $spyropress_tabs_content = '';
foreach( $spyropress_tabs as $spyropress_tab ) {
    ++$spyropress_count;
    $spyropress_li_class = ( $spyropress_count == 1 ) ? ' class="active"' : '';
    $spyropress_active = ( $spyropress_count == 1 ) ? ' active in' : '';
    $spyropress_title = isset( $spyropress_tab['spyropress_title'] ) ? $spyropress_tab['spyropress_title'] : esc_html__( 'Tab ', 'tomato' ).$spyropress_count;
    $spyropress_content = isset( $spyropress_tab['spyropress_content'] ) ? $spyropress_tab['spyropress_content'] : '';
    
    $spyropress_tab_nav .= '<li' . $spyropress_li_class . '><a href="#tab' . esc_attr( $spyropress_count ) . '" role="tab" data-toggle="tab">' . esc_html( $spyropress_title ) . '</a></li>';
    $spyropress_tabs_content .= '<div class="tab-pane fade' . esc_attr( $spyropress_active ) . '" id="tab' . esc_attr( $spyropress_count ) . '"><p>';
    
    // content
    if( isset( $spyropress_tab['spyropress_bucket'] ) ) {
        $spyropress_args = array(
            'post_type' => 'bucket',
            'p' => $spyropress_tab['spyropress_bucket']
        );
        $spyropress_query = new WP_Query( $spyropress_args );
        while( $spyropress_query->have_posts() ) {
            $spyropress_query->the_post();
            $spyropress_tabs_content .= spyropress_get_the_content();
        }
    }
    else {
        $spyropress_tabs_content .= do_shortcode( $spyropress_content );
    }
    $spyropress_tabs_content .= '</p></div> <!-- end tab-pane -->';
}
wp_reset_query();
?>
<div class="element-tab">
    <ul class="nav nav-tabs" role="tablist">
        <?php echo ''.$spyropress_tab_nav; ?>
    </ul>
    <div class="tab-content">
        <?php echo ''.$spyropress_tabs_content; ?>
    </div>
</div> <!-- end tabbable -->