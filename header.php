<?php
/*
 * Core Spyropress header template
 *
 * Customise this in your child theme by:
 * - Using hooks and your own functions
 * - Using the 'header-content' template part
 * - For example 'header-content-category.php' for category view or 'header-content.php' (fallback if location specific file not available)
 * - Copying this file to your child theme and customising - it will over-ride this file
 *
 * @package Spyropress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if( !get_setting( 'page-loader' ) ): ?>
    <div class="preloder animated">
        <div class="scoket">
            <?php 
                //Loader Image.
                if( $spyropress_loader_bg = get_setting( 'loader_bg' ) ){
                    echo '<img src="'. esc_url( $spyropress_loader_bg ) .'"  />';
                }
            ?>
            
        </div>
    </div>
<?php
    endif; 
    spyropress_wrapper(); 
        spyropress_before_header();

        spyropress_before_header_content();
        spyropress_get_template_part('part=templates/header-content');
        spyropress_after_header_content();
        
      spyropress_after_header(); 