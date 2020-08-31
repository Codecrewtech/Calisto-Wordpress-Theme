<?php 
    //Get Page Option Value.
    $spyropress_page_options = get_post_meta( get_queried_object_id(), '_page_options', true );
    if( isset( $spyropress_page_options['page_breadcrumb'] ) || get_setting( 'page_breadcrumb' ) ){
        return;   //check breadcrumb enable / disable options.
    }
   
    //Get page short description.
    $spyropress_page_breadcrumb_dec = isset( $spyropress_page_options['page_breadcrumb_dec'] )? '<p>'. esc_html( $spyropress_page_options['page_breadcrumb_dec'] ) .'</p>' : '<p>'. esc_html( get_setting( 'page_breadcrumb_dec' ) ) .'</p>';        
   
    //Get page breadcrumb background
    $spyropress_page_breadcrumb_bg = isset( $spyropress_page_options['page_breadcrumb_bg'] )? $spyropress_page_options['page_breadcrumb_bg'] : get_setting_array( 'page_breadcrumb_bg' );       
   
    //Set page breadcrumb options.
    $spyropress_style = '';
    if( isset( $spyropress_page_breadcrumb_bg) && !empty( $spyropress_page_breadcrumb_bg ) ) {
        $spyropress_value = $spyropress_page_breadcrumb_bg;
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
   
    //Translation Theme Options
    $spyropress_translate['blog-title'] = get_setting( 'translate' ) ? get_setting( 'blog-title', '<span>Our</span> Blog' ) : esc_html__( 'Our Blog', 'tomato' );
    $spyropress_translate['cat-title'] = get_setting( 'translate' ) ? get_setting( 'cat-title', 'Category: <strong>%s</strong>' ) : esc_html__( 'Category: %s', 'tomato' );
    $spyropress_translate['tag-title'] = get_setting( 'translate' ) ? get_setting( 'tag-title', 'Tag: <strong>%s</strong>' ) : esc_html__( 'Tag: %s', 'tomato' );
    $spyropress_translate['day-title'] = get_setting( 'translate' ) ? get_setting( 'day-title', 'Daily: <strong>%s</strong>' ) : esc_html__( 'Daily: %s', 'tomato' );
    $spyropress_translate['month-title'] = get_setting( 'translate' ) ? get_setting( 'month-title', 'Monthly: <strong>%s</strong>' ) : esc_html__( 'Monthly: %s', 'tomato' );
    $spyropress_translate['year-title'] = get_setting( 'translate' ) ? get_setting( 'year-title', 'Yearly: <strong>%s</strong>' ) : esc_html__( 'Yearly: %s', 'tomato' );
    $spyropress_translate['search-title'] = get_setting( 'translate' ) ? get_setting( 'search-title', 'Search results: <strong>%s</strong>' ) : esc_html__( 'Search results: %s', 'tomato' );
    $spyropress_translate['404-title'] = get_setting( 'translate' ) ? get_setting( 'error-404-title', 'Ooops... Error <strong>404</strong>' ) : esc_html__( 'Ooops... Error 404', 'tomato' );
    $spyropress_translate['recipies-title'] = get_setting( 'translate' ) ? get_setting( 'recipies-title', 'Recipies' ) : esc_html__( 'Recipies', 'tomato' );
    
?>
  
<section class="page_header" <?php echo ''.$spyropress_style; ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="text-uppercase">
                    <?php 
                    	if( is_singular( 'recipe' ) ):
                    	    echo ''.$spyropress_translate['recipies-title'];		
                        elseif( is_home() || is_single() && !is_singular( 'portfolio' ) ) :
                            echo wp_kses( $spyropress_translate['blog-title'], array( 'strong' => array() ) );
                        elseif ( is_category() ) :
                        	printf( wp_kses( $spyropress_translate['cat-title'], array( 'strong' => array() ) ), single_cat_title( '', false ) );
                        elseif ( is_tag() ) :
                        	printf( wp_kses( $spyropress_translate['tag-title'], array( 'strong' => array() ) ), single_tag_title( '', false ) );
                        elseif ( is_day() ) :
                        	printf( wp_kses( $spyropress_translate['day-title'], array( 'strong' => array() ) ), get_the_date() );
                        elseif ( is_month() ) :
                        	printf( wp_kses( $spyropress_translate['month-title'], array( 'strong' => array() ) ), get_the_date( _x( 'F Y', 'monthly archives date format', 'tomato' ) ) );
                        elseif ( is_year() ) :
                        	printf( wp_kses( $spyropress_translate['year-title'], array( 'strong' => array() ) ), get_the_date( _x( 'Y', 'yearly archives date format', 'tomato' ) ) );
                        elseif( is_search() ):
                            printf( wp_kses( $spyropress_translate['search-title'], array( 'strong' => array() ) ), get_search_query() );
                        elseif( is_404() ):
                            echo wp_kses( $spyropress_translate['404-title'], array( 'strong' => array() ) );
                        else :
                        	echo get_the_title( get_queried_object_id() );
                        endif;
                     ?>
                </h2>
                <?php echo wp_kses( $spyropress_page_breadcrumb_dec, array( 'p' => array(), 'br' => array() ) ); ?>
            </div>
        </div>
    </div>
</section>