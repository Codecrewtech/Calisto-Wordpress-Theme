<?php
/**
 * Default Page Template
 * 
 * @package Tomato
 * @author ThemeSuared
 * @link http://themesuared.com/tomato/
 */
 
    get_header();
    
    //Get Page Meta Value.
    $spyropress_options = get_post_meta( get_the_ID(), '_page_options', true );	
                    
    spyropress_before_main_container();
    
        get_template_part( 'templates/page', 'breadcrumb' );  //Include Page Breadcrumb Html. 
    
        spyropress_before_loop();
        
            while( have_posts() ) {
                the_post();
        
                spyropress_before_post();
                    
                    get_template_part( 'page', 'content' );
                    
                    // Page Comments 
                    if( !isset( $spyropress_options['spyropress_comments'] ) && empty( $spyropress_options['spyropress_comments'] ) ){

                    	echo '<div class="container section"><hr>';
                        	comments_template( '', true );
                    	echo '</div>';
                    }
        
                spyropress_after_post();
            }
            
        spyropress_after_loop();

    spyropress_after_main_container();

get_footer(); 