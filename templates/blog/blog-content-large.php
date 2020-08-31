<div class="col-md-10 col-md-offset-1">
    <?php   
        if ( have_posts() ): 

            while( have_posts() ):
                
                the_post();
                spyropress_before_post();
                    get_template_part( 'templates/blog/formats/content',get_post_format()); 
                spyropress_after_post();
            
            endwhile;
            
            //Navigation Link.
            $spyropress_defaults = array(
        		'before'           => '<div class="clearfix"></div><ul class="pagi_nation">',
                'after'            => '</li></ul>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => '</li><li>',
                'nextpagelink'     => esc_html__( 'Next page', 'tomato' ),
                'previouspagelink' => esc_html__( 'Previous page', 'tomato' ),
                'pagelink'         => '%',
                'echo'             => 1
        	);                  
            //wp_link_pages( $spyropress_defaults );
            
            //Pagination.
            wp_pagenavi( array( 'before' => '<div class="clearfix"></div>' ) ); 
            
        else:
            echo '<h5>'. esc_html__( 'Sorry, no posts matched your criteria.', 'tomato' ) .'</h5>';
        endif; 
    ?>
</div>