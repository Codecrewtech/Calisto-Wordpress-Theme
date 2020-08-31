<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
        <div class="col-md-5 col-sm-5">
            <?php printf( '<div class="post-date">%1$s, %2$s Comments</div>',get_the_date( 'm-d-Y' ), get_comments_number() ); ?>
        </div>
    </div>
    <hr/>
    <div class="post-format-video">
    <?php
        if( is_single() ){
            the_content();
            echo '<hr/>'; //Divider.
            comments_template( '', true ); //Comments.
        }else{
            echo spyropress_get_excerpt(); 
        }    
    ?>
    </div>
</article>