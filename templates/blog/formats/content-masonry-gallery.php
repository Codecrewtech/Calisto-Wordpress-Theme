<article class="blog-mason-item">
    <?php
        $spyropress_attachments = get_children( array(
            'post_parent'       => get_the_ID(),
            'post_status'       => 'inherit',
            'post_type'         => 'attachment',
            'post_mime_type'    => 'image',
            'orderby'           => 'date',
            'order'             => 'ASC'
        ) );
        
        if ( !empty( $spyropress_attachments ) ):
            $spyropress_remaining = array_splice( $spyropress_attachments, 2 );
    ?>
        <div class="post-img">
            <div class="blog-slider">
                <?php 
                    foreach( $spyropress_attachments as $spyropress_attachment ) {
                        $spyropress_id = $spyropress_attachment->ID;
                        get_image( array(
                            'attachment' => $spyropress_id,
                            'class' => 'img-responsive',
                            'before' => '<div>',
                            'after' => '</div>'
                        ));   
                    }
                    if( !empty( $spyropress_remaining ) ) {
                        foreach( $spyropress_remaining as $spyropress_remaining_item ) {
                            $spyropress_id = $spyropress_remaining_item->ID;
                            get_image( array(
                                'attachment' => $spyropress_id,
                                'class' => 'img-responsive',
                                'before' => '<div>',
                                'after' => '</div>'
                            ));   
                        }
                    }
                ?>
            </div>
            <?php spyropress_post_format_icon( get_post_format() );  //Post Formate Icon. ?>
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