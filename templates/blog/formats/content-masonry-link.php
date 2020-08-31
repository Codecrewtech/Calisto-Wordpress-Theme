<article class="blog-mason-item">
    <?php if( has_post_thumbnail() ): ?>
        <div class="post-img">
            <?php 
                get_image( array( 'class' => 'img-responsive' ) ); //Thuminal Image.
                spyropress_post_format_icon( get_post_format() );  //Post Formate Icon.
            ?>
        </div>
    <?php endif; ?>
    <h4><a target="_blank" href="<?php echo get_post_meta( get_the_ID(), '_format_link_url', true ); ?>"><?php the_title(); ?></a></h4>
    <?php
        if( is_single() ){
            spyropress_the_content();
        }else{
            echo spyropress_get_excerpt( array( 'length' => 50, )); 
        }    
    ?>
</article>