<?php 
    //Get Page Option Value.
    $spyropress_page_options = get_post_meta( get_the_ID(), '_page_options', true );
 
    //Check Enable Option.   
     
    $show_subcrible = get_setting( 'footer_subscribe','' );
    if( isset( $spyropress_page_options['footer_subscribe'] ) && !empty( $spyropress_page_options['footer_subscribe'] ) )
        $show_subcrible = $spyropress_page_options['footer_subscribe'];

    //if( (!isset( $spyropress_page_options['footer_subscribe'] ) || empty( $spyropress_page_options['footer_subscribe'] ) ) ||  get_setting( 'footer_subscribe' )  )return;   
    if(!empty($show_subcrible))  return;  
    
    //Get Content Value.
    $spyropress_subscribe_heading =  get_setting( 'footer_subscribe_heading' );
    $spyropress_sub_heading =  get_setting( 'footer_subscribe_sub_heading' );
    $spyropress_shortcode = get_setting( 'footer_subscribe_shortcode' );
    
    $has_subcribe_cls = '';
    if( $spyropress_subscribe_heading || $spyropress_sub_heading || $spyropress_shortcode )
        $has_subcribe_cls = 'has-subcribe';

?><!-- subscribe -->
<section class="subscribe subscribe-section <?php echo esc_attr($has_subcribe_cls); ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    //Heading.
                    if( $spyropress_subscribe_heading ){
                        echo '<h1>'. esc_html( $spyropress_subscribe_heading ) .'</h1>';
                    }
                    
                    //Heading.
                    if( $spyropress_sub_heading ){
                        echo '<p>'. esc_html( $spyropress_sub_heading ) .'</p>';
                    }
                    
                    //Shortcode.
                    if( $spyropress_shortcode ){
                       echo do_shortcode( $spyropress_shortcode );
                    }
                ?>
            </div>
        </div>
    </div>
</section>