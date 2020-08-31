<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( has_post_thumbnail() ): ?>
        <div class="post-img">
            <?php 
                get_image( array( 'class' => 'img-responsive' ) ); //Thuminal Image.
                spyropress_post_format_icon( get_post_format() );  //Post Formate Icon.
            ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-7 col-sm-7">
            <h4><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
        <div class="col-md-5 col-sm-5">
            <?php printf( '<div class="post-date">%1$s, %2$s %3$s</div>',get_the_date( 'M-d-Y' ), get_comments_number(), esc_html__('Comments','tomato') ); ?>
        </div>
    </div>
    <hr>
    <?php
        if( is_single() ){
            the_content();
            echo '<hr/>'; //Divider.
            comments_template( '', true ); //Comments.
        }else{
            echo spyropress_get_excerpt(); 
        }    
    ?>
</article>