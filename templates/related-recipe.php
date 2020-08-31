<?php
//Check.
if( !get_setting( 'recipe_related_enable', false ) ) return;
//Get Post Limit
$spyropress_limit = get_setting( 'recipe_related_number', 4 );
$spyropress_related_by = get_setting( 'recipe_related_by' );

global $post;

//Default Arguments.
$spyropress_args = array(
    'post__not_in'      => array( $post->ID ),
    'posts_per_page'    => $spyropress_limit,
    'ignore_sticky_posts'  => 1,
    'post_type'         => 'recipe'
);

// by category
if( 'category' == $spyropress_related_by ) {
    $spyropress_categories = wp_get_post_terms( $post->ID, 'recipe_category' );

    if ( $spyropress_categories ) {
        $spyropress_category_ids = array();

        foreach( $spyropress_categories as $spyropress_individual_category ){
            $spyropress_category_ids[] = $spyropress_individual_category->term_id;
            $spyropress_args['tax_query'] = array(
                array(
                    'taxonomy' => 'recipe_category',
                    'field' => 'id',
                    'terms' => $spyropress_category_ids
                )
            );
        }    
    }
}

//Custom Query.
$spyropress_my_query = new wp_query( $spyropress_args );

if( $spyropress_my_query->have_posts() ) {

?>
<section class="featured-recipie">
    <div class="container">
        <?php 
            //Module Title. 
            if( get_setting( 'recipe-title' , 'Featured Recipe' ) ){
                echo '<hr/><h3>'. esc_html( get_setting( 'recipe-title' , 'Featured Recipe' ) ) .'</h3>';
            }
        ?>
        <div class="row">
            <div class="featured-recipies">
                <?php
                    while( $spyropress_my_query->have_posts() ) {
                        $spyropress_my_query->the_post();
                        
                        //recipe meta information.
                        $spyropress_data = get_post_meta( get_the_ID(), '_recipe_details', true );
                        
                        $spyropress_reviews = '';
                        if( isset( $spyropress_data['star'] ) ){
                            $spyropress_stars = '';
                            //Rating logic.
                            $spyropress_star = 5 - $spyropress_data['star'];
                            //Diactive Star
                            for( $i=0; $i < $spyropress_star; $i++ ){
                                $spyropress_stars .= '<span class="fa fa-star"></span>';    
                            }
                            //Active Star
                            for( $j=0; $j < $spyropress_data['star']; $j++ ){
                                $spyropress_stars .= '<span class="fa fa-star active"></span>';    
                            }
                            
                            $spyropress_reviews .= '<div class="rc-ratings">'. $spyropress_stars .'</div>';
                        }
                        
                        echo '
                        <div class="fp-content">
                            <a href="'. get_permalink() .'">
                                '. get_image( array( 'echo' => false, 'class' => 'img-responsive' ) ) .'
                                <h4>'. get_the_title() .'</h4>
                            </a>
                            '. wp_kses( $spyropress_reviews, array( 'div' => array( 'class' => array() ), 'span' => array( 'classs' => array() ) ) ) .'
                        </div>';
                        
                    }
                    wp_reset_query();
                ?>
            </div>
        </div>
    </div>
</section>
<?php }