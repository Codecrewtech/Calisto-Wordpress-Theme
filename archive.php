<?php
/**
 * Blog Search Page Template
 * 
 * @package Tomato
 * @author ThemeSuared
 * @link http://themesuared.com/tomato/
 */
 
 get_header(); 
    spyropress_before_main_container();
    
    get_template_part( 'templates/page', 'breadcrumb' );  //Include Page Breadcrumb Html. 
?>
<div class="blog-content">
    <div class="container">
        <div class="row">
            <?php 
                $spyropress_layout = ( isset( $_GET['blog'] ) )? $_GET['blog'] : get_setting( 'blog_layout', 'large' );
                get_template_part( 'templates/blog/blog-content', esc_html( $spyropress_layout ) ); 
            ?>
        </div>
    </div>
</div>
<?php 
    spyropress_after_main_container(); 
 get_footer(); 
