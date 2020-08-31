<?php $class = (!get_setting('sticky_menu'))? 'navbar-fixed-top' : '';?>
<nav class="navbar <?php echo esc_attr( $class ); ?>">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'tomato' ); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php spyropress_logo( array( 'brand' => true ) )  //Site Logo.?>
        </div>
        <?php 
            //Get Page Option Value.
            $spyropress_page_options = get_post_meta( get_the_ID(), '_page_options', true );
            
            if( isset( $spyropress_page_options['onepage_menu'] ) ):
                
                $spyropress_menu = wp_nav_menu( array(
                    'container' => 'div',
                    'container_id' => 'navbar',
                    'container_class' => 'navbar-collapse collapse',
                    'menu_class' => 'nav navbar-nav navbar-right',
                    'menu_id' => '',
                    'menu' => $spyropress_page_options['onepage_menu'],
                    'echo' => false,
                    'walker' => new Bootstrapwp_Walker_Nav_Menu
                ) );
            
            else:
            
                $spyropress_menu = spyropress_get_nav_menu( array(
                    'container' => 'div',
                    'container_id' => 'navbar',
                    'container_class' => 'navbar-collapse collapse',
                    'menu_class' => 'nav navbar-nav navbar-right',
                    'menu_id' => '',
                    'echo' => false,
                    'walker' => new Bootstrapwp_Walker_Nav_Menu
                ),'primary' );
                
            endif;
                
            $spyropress_url = ( is_front_page() ) ? '#' : home_url('/#');
            echo str_replace( '#HOME_URL#', $spyropress_url, $spyropress_menu );
        ?>
    </div>
</nav>