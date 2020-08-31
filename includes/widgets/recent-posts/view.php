<?php
//Check
if( empty( $spyropress_number ) ) return;
    
    //Query Post.
    $spyropress_r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $spyropress_number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
    
    //Check Post Items.   
    if ($spyropress_r->have_posts()) :
        
        //Date Check.
        $spyropress_show_date = ( isset( $spyropress_setting ) && !empty( $spyropress_setting ) )? true : false;
        
        $before_widget;
            
            //Widget Title.
            if ( $spyropress_title ){
              echo wp_kses_post( $before_title .$spyropress_title. $after_title );  
            } 
            
            while ( $spyropress_r->have_posts() ) : 
                $spyropress_r->the_post();
                
                ?>
                
                <div class="footer-blog clearfix">
                    <a href="<?php echo esc_url( get_permalink() ) ?>">
                        <?php  get_image( array( 'class' => 'img-responsive footer-photo', 'crop' => true, 'responsive' => true, 'width' => 80, 'height' => 71 ) ); ?> 
                        <?php the_title('<p class="footer-blog-text">', '</p>'); ?>
                        <?php if ( $spyropress_show_date ) : ?>
                            <p class="footer-blog-date"><?php echo get_the_date('d m Y'); ?></p>
                        <?php endif; ?>
                    </a>
                 </div>

                <?php
                
            endwhile;
            
        $after_widget;
        
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

    endif;  