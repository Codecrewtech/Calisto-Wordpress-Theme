<article class="blog-mason-item">
    <?php 
        $spyropress_video = get_post_meta( get_the_ID(), '_format_video_embed', true );
        if( $spyropress_video ): 
    ?>
        <div class="post-img">
            <?php 
                echo wp_oembed_get( $spyropress_video );            //Video.
                spyropress_post_format_icon( get_post_format() );  //Post Formate Icon.
            ?>
        </div>
    <?php endif; ?>
    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    <?php
        if( is_single() ){
            spyropress_the_content();
        }else{
            echo spyropress_get_excerpt( array( 'length' => 50, )); 
        }    
    ?>
</article>