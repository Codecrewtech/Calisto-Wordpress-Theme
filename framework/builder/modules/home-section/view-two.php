<section class="home-section no-bg" >
    <!-- Video Background - Here you need to replace the videoURL with your youtube video URL -->
    <?php if( $spyropress_video ): ?>
        <a id="bgndVideo" class="player mb_YTVPlayer" data-property="{videoURL:'<?php echo esc_url( $spyropress_video ); ?>',containment:'body',autoPlay:true, mute:true, startAt:0, opacity:1}" style="display: none; background-image: none; background-position: initial; background-repeat: initial;" title="<?php echo esc_attr( $spyropress_video_title ); ?>"><?php esc_html_e( 'youtube', 'tomato' )?></a>        
    <?php endif; ?>
    <div class="tittle-block">
        <?php 
            //Logo
            if( $spyropress_logo ):
                spyropress_logo( array( 'tag' => 'div', 'container_class' => 'logo', 'class' => 'site-logo', 'img' => $spyropress_logo ) );
            endif;
            
            //Module Heading
            if( $spyropress_heading ):
                echo '<h1>'. esc_html( $spyropress_heading ) .'</h1>';
            endif;
            
            //Module Sub Heading
            if( $spyropress_sub_heading ):
                echo '<h2>'. esc_html( $spyropress_sub_heading ) .'</h2>';
            endif;
         ?>
    </div>
    <?php if( $spyropress_url ): ?>
        <div class="scroll-down hidden-xs">
            <a href="<?php echo esc_url( $spyropress_url ); ?>">
                <img src="<?php echo esc_url( assets_img( 'arrow-down.png' ) ); ?>" alt="down-arrow" />
            </a>
        </div>
    <?php endif; ?>
</section>