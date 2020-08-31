<?php
/**
 * Blog Page Template
 * 
 * @package Tomato
 * @author ThemeSuared
 * @link http://themesuared.com/tomato/
 */

    get_header();
    
    spyropress_before_main_container(); 
        get_template_part( 'templates/page', 'breadcrumb' );  //Include Page Breadcrumb Html.
        $spyropress_position = get_setting( 'blog_single_sidebar_position', 'right' ); 
?>
        <div class="blog-content">
                <div class="container">
                    <div class="row">
                        <?php 
                            if( is_active_sidebar( 'primary' ) ):
                                if( 'left' == $spyropress_position ) :
                        ?>
                            <aside class="col-md-3">
                                <?php dynamic_sidebar( 'primary' ); ?>
                            </aside>
                        <?php   
                                endif;
                             endif;    
                        ?>
                        <div class="col-md-9">
                            <?php
                            spyropress_before_loop();
                            if( have_posts() ) {
                                while( have_posts() ) {
                                    the_post();
                                    
                                    spyropress_before_post();
                                        get_template_part( 'templates/blog/formats/content', get_post_format() );  
                                    spyropress_after_post();
                                }
                            
                                //Single Navigation Link.
    	                        $spyropress_defaults = array(
                            		'before'           => '<nav><ul class="pager"><li>',
                                    'after'            => '</li></ul></nav>',
                                    'link_before'      => '',
                                    'link_after'       => '',
                                    'next_or_number'   => 'number',
                                    'separator'        => '</li><li>',
                                    'nextpagelink'     => esc_html__( 'Next page', 'tomato' ),
                                    'previouspagelink' => esc_html__( 'Previous page', 'tomato' ),
                                    'pagelink'         => '%',
                                    'echo'             => 1
                            	);
                                wp_link_pages( $spyropress_defaults );
        
                            }else{
                                echo '<h3>'.esc_html__( 'Sorry No Post Where Found', 'tomato' ).'</h3>';
                            } 
                            spyropress_after_loop();
                        ?>
                    </div>
                   <?php 
                        if( is_active_sidebar( 'primary' ) ):
                            if( 'right' == $spyropress_position ) :
                    ?>
                        <aside class="col-md-3">
                            <?php dynamic_sidebar( 'primary' ); ?>
                        </aside>
                    <?php   
                            endif;
                         endif;    
                    ?>
                </div>
            </div>
        </div>
<?php 
    spyropress_after_main_container(); 
get_footer(); 