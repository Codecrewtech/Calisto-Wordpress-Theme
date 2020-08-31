<?php
// chcek
if ( empty( $spyropress_accordions ) ) return;

global $spyropress_accordion_ids;
$spyropress_count = 0;
$spyropress_content = $spyropress_xcontent = '';
++$spyropress_accordion_ids;

foreach( $spyropress_accordions as $spyropress_accordion ) {
    ++$spyropress_count;
    $spyropress_active = ( $spyropress_count == 1 ) ? ' in' : '';
    $spyropress_heading_active = ( $spyropress_count == 1 ) ? ' active' : '';
    $spyropress_icon_active = ( $spyropress_count == 1 ) ? ' <span class="fa fa-minus"></span>' : '<span class="fa fa-plus"></span>';
    $spyropress_title = isset( $spyropress_accordion['spyropress_title'] ) ? $spyropress_accordion['spyropress_title'] : ''; 
    // content
    if( isset( $spyropress_accordion['spyropress_bucket'] ) ) {
        $spyropress_args = array(
            'post_type' => 'bucket',
            'p' => $spyropress_accordion['spyropress_bucket']
        );
        $spyropress_query = new WP_Query( $spyropress_args );
        while( $spyropress_query->have_posts() ) {
            $spyropress_query->the_post();
            $spyropress_xcontent = spyropress_get_the_content();

        }
        wp_reset_postdata();
    }
    elseif(isset( $spyropress_accordion['spyropress_content'] )){
        $spyropress_xcontent = $spyropress_accordion['spyropress_content'];
    }
    
    $spyropress_content .= '
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title ' . esc_attr( $spyropress_heading_active ) . '">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e' . esc_attr( $spyropress_accordion_ids ) . '" href="#collapse' . esc_attr( $spyropress_count ) . esc_attr( $spyropress_accordion_ids ) . '">
                '. esc_html( $spyropress_title ) .$spyropress_icon_active.'
                </a>
            </h4>
        </div>
        <div id="collapse' . esc_attr( $spyropress_count ) . esc_attr( $spyropress_accordion_ids ) . '" class="panel-collapse collapse ' . esc_attr( $spyropress_active ) . '">
            <div class="panel-body"><p>' . $spyropress_xcontent . '</p></div>
        </div>
    </div>';
}
wp_reset_postdata();
?>
<div class="panel-group" id="accordion-e1">
    <?php echo tomato_html( $spyropress_content ); ?>
</div> <!-- end tabbable -->