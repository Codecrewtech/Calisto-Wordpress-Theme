<?php
//Check
if( empty( $spyropress_number ) ) return;
    
    //Query Post.
    $spyropress_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $spyropress_number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
    
    //Check Post Items.   
    if ($spyropress_r->have_posts()) :
        
        //Date Check.
        $spyropress_show_date = ( isset( $spyropress_setting ) && !empty( $spyropress_setting ) )? true : false;
        
        echo wp_kses_post( $before_widget );
            
            //Widget Title.
            if ( $spyropress_title ){
              echo wp_kses_post( $before_title .$spyropress_title. $after_title );  
            } 
            
            echo '<ul class="recent-post">'; 
            
            while ( $spyropress_r->have_posts() ) : 
                $spyropress_r->the_post();
                
                ?>
                
                <li>
                    <?php  get_image( array( 'class' => 'img-responsive footer-photo', 'crop' => true, 'responsive' => true, 'width' => 85, 'height' => 67 ) ); ?> 
                    <div class="rp-info">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php if ( $spyropress_show_date ) : ?>
                            <span><?php echo get_the_date('M-d-Y'); ?></span>
                        <?php endif; ?>
                    </div>
                 </li>

                <?php
                
            endwhile;
            
            echo '</ul>';
            
        echo wp_kses_post( $after_widget );
        
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

    endif;  