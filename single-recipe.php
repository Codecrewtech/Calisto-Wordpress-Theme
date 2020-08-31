<?php 
/**
 * Portfolio Single Template
 * 
 * @package Tomato
 * @author ThemeSuared
 * @link http://themesuared.com/tomato/
 */

    //Translation Theme Options
    $spyropress_translate['recipe-direction'] = get_setting( 'translate' ) ? get_setting( 'recipe-direction', 'Direction' ) : esc_html__( 'Direction', 'tomato' );
    $spyropress_translate['recipe-ingredients'] = get_setting( 'translate' ) ? get_setting( 'recipe-ingredients', 'Ingredients' ) : esc_html__( 'Ingredients', 'tomato' );
    $spyropress_translate['recipe-descriptions'] = get_setting( 'translate' ) ? get_setting( 'recipe-descriptions', 'Descriptions' ) : esc_html__( 'Descriptions', 'tomato' );
    $spyropress_translate['recipe-nutrition'] = get_setting( 'translate' ) ? get_setting( 'recipe-nutrition', 'Nutrition' ) : esc_html__( 'Nutrition', 'tomato' );
    $spyropress_translate['recipe-nutrient'] = get_setting( 'translate' ) ? get_setting( 'recipe-nutrient', 'Nutrient' ) : esc_html__( 'Nutrient', 'tomato' );
    $spyropress_translate['recipe-dv'] = get_setting( 'translate' ) ? get_setting( 'recipe-dv', 'DV' ) : esc_html__( 'DV', 'tomato' );
    $spyropress_translate['recipe-dv-percentage'] = get_setting( 'translate' ) ? get_setting( 'recipe-dv-percentage', '%DV' ) : esc_html__( '%DV', 'tomato' );
    
    get_header(); 

    spyropress_before_main_container(); 
    
    	get_template_part( 'templates/page', 'breadcrumb' );  //Include Page Breadcrumb Html.
 ?>
<section class="recipie-single single-recipe">
    <div class="container">
        <div class="row">
            <?php 
                spyropress_before_loop(); 
                  if( have_posts() ) {  
                    while( have_posts() ) {

                        the_post();
                        spyropress_before_post();
                        
                        //Meta data Information.
                        $spyropress_data = get_post_meta( get_the_ID(), '_recipe_details', true );
             
            ?>
                    <div class="col-md-6">
                        <?php 
                            //Check And Print Gallery.
                            if( isset($spyropress_data['gallery']) && !empty ($spyropress_data['gallery']) &&  $spyropress_data['display'] == 'gallery' ) {
                                $spyropress_ids = explode( ',', str_replace( array( '[gallery ids=', ']', '"' ), '', $spyropress_data['gallery'] ) );
                                if ( !empty( $spyropress_ids ) ) {
                                    $spyropress_gallery_item = $spyropress_gallery_nav = '';
                                    foreach( $spyropress_ids as $spyropress_id ) {
                                        $spyropress_gallery_item .= get_image( array(
                                            'attachment' => $spyropress_id,
                                            'width' => 9999,
                                            'responsive' => true,
                                            'echo' => false,
                                            'class' => 'img-responsive',
                                            'before' => '<div>',
                                            'after' => '</div>'
                                        ));         
                                        
                                        $spyropress_gallery_nav .= get_image( array(
                                            'attachment' => $spyropress_id,
                                            'width' => 9999,
                                            'responsive' => true,
                                            'echo' => false,
                                            'class' => 'img-responsive',
                                            'before' => '<div>',
                                            'after' => '</div>'
                                        ));                                        
                                    }
                                    
                                    echo '<div class="single-recipe-carousel">'. $spyropress_gallery_item .'</div><div class="single-recipe-carousel-nav">'. $spyropress_gallery_nav .'</div>';
                                }
                                
                             }elseif( isset($spyropress_data['video']) && !empty ($spyropress_data['video']) &&  $spyropress_data['display'] == 'video' ) {
                                echo '<div class="single-recipe-image"><div class="video">'. wp_oembed_get( $spyropress_data['video'],array( 'height' => '300' ) ). '</div></div>';
    
                             }elseif( has_post_thumbnail() ) {
                                 get_image( array( 'before'=> '<div class="single-recipe-image">', 'after' => '</div>', 'class' => 'img-responsive' ) );
    
                             }
                        ?>
                        <div class="clearfix"></div>
                        <h3><?php echo esc_html( $spyropress_translate['recipe-direction'] ); ?></h3>
                        <br>
                        <?php 
                            if( isset( $spyropress_data['directions'] ) ){
                                echo '<ol class="directions-list">';
                                    foreach( $spyropress_data['directions'] as $spyropress_direction ){
                                        echo '<li>'. esc_html( $spyropress_direction['direction_item'] ) .'</li>';
                                    }
                                echo '</ol>';
                            }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                        <div class="ingredients">
                            <h4 class="title"><?php echo esc_html( $spyropress_translate['recipe-ingredients'] ); ?></h4>
                            <?php 
                                if( isset( $spyropress_data['ingredients'] ) ){
                                    echo '<ul>';
                                        foreach( $spyropress_data['ingredients'] as $spyropress_ingredient ){
                                            if (isset($spyropress_ingredient['ingredients_item'])) {
                                                echo '<li><i class="fa fa-check-square-o"></i>'. esc_html( $spyropress_ingredient['ingredients_item'] ) .'</li>';
                                            }
                                        }
                                    echo '</ul>';
                                }
                            ?>
                        </div>
                        <h3 class="heading-bottom-line"><?php echo esc_html( $spyropress_translate['recipe-descriptions'] ); ?></h3>
                        <?php if( isset( $spyropress_data['descriptions'] ) ){ echo wp_kses( $spyropress_data['descriptions'], array( 'p' => array() ) ); }?>
                        <div class="nutrition-table">
                            <h3 class="heading-bottom-line"><?php echo esc_html( $spyropress_translate['recipe-nutrition'] ); ?></h3>
                            <?php if( isset( $spyropress_data['nutritions'] ) ): ?>
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <th><?php echo esc_html( $spyropress_translate['recipe-nutrient'] ); ?></th>
                                                <th><?php echo esc_html( $spyropress_translate['recipe-dv'] ); ?></th>
                                                <th><?php echo esc_html( $spyropress_translate['recipe-dv-percentage'] ); ?></th>
                                            </tr>
                                            <?php 
                                                //Table Contents.
                                                foreach( $spyropress_data['nutritions'] as $spyropress_nutrition ){
                                                    echo '<tr>';
                                                        if( isset( $spyropress_nutrition['nutrient'] ) ){
                                                            echo '<td>'. esc_html( $spyropress_nutrition['nutrient'] ) .'</td>';
                                                        }
                                                        if( isset( $spyropress_nutrition['dv'] ) ){
                                                            echo '<td>'. esc_html( $spyropress_nutrition['dv'] ) .'</td>';
                                                        }
                                                        if( isset( $spyropress_nutrition['dv_percentage'] ) ){
                                                            echo '<td>'. esc_html( $spyropress_nutrition['dv_percentage'] ) .'%<span class="progressbar"><span class="level-'. esc_attr( $spyropress_nutrition['dv_percentage'] ) .'"></span></span></td>';
                                                        }
                                                    echo '</tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
             <?php 
                        spyropress_after_post();
                   }
                   
                }else{
                    echo '<h3>'.esc_html__( 'Sorry No Post Where Found', 'tomato' ).'</h3>';
                } 
                spyropress_after_post(); 
            ?>
        </div>
    </div>
</section>
<?php  
    get_template_part( 'templates/related', 'recipe' );  //include related recipe.    
    spyropress_after_main_container(); 
get_footer(); 