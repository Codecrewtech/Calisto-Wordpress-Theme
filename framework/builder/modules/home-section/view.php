<section class="home-section"  <?php if( $spyropress_bg_image )echo 'style="background: url('. esc_url( $spyropress_bg_image ) .') no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;"' ?>>
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