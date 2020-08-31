<?php
/**
* Theme Options
*
* @author 		SpyroSol
* @category 	Admin
* @package 	Spyropress
*/

global $spyropress_theme_settings;

$spyropress_theme_settings['general'] = array(

   array(
      'label' => esc_html__( 'General Settings', 'tomato' ),
      'type' => 'heading',
      'slug' => 'generalsettings',
      'icon' => 'module-icon-general'
   ),

   array(
      'label' => esc_html__( 'Custom Logo', 'tomato' ),
      'desc' => esc_html__( 'Upload a logo for your site or specify an image URL directly.', 'tomato' ),
      'id' => 'logo',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Custom Favicon', 'tomato' ),
      'desc' => esc_html__( 'Upload a favicon for your site or specify an icon URL directly.<br/>Accepted formats: ico, png, gif<br/>Dimension: 16px x 16px.', 'tomato' ),
      'id' => 'custom_favicon',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Apple Touch Icon (small)', 'tomato' ),
      'desc' => esc_html__( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 57px x 57px.', 'tomato' ),
      'id' => 'apple_small',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Apple Touch Icon (medium)', 'tomato' ),
      'desc' => esc_html__( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 72px x 72px.', 'tomato' ),
      'id' => 'apple_medium',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Apple Touch Icon (large)', 'tomato' ),
      'desc' => esc_html__( 'Upload apple favicon.<br/>Accepted formats: png<br/>Dimension: 114px x 114px.', 'tomato' ),
      'id' => 'apple_large',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Page Loader', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Page Loader', 'tomato' ),
      'id' => 'page-loader',
      'type' => 'checkbox',
      'options' => array(
         '1' => esc_html__( 'Disable Page Loader', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Loader Image', 'tomato' ),
      'desc' => esc_html__( 'Upload a image or specify an image URL directly for Page Loader.', 'tomato' ),
      'id' => 'loader_bg',
      'type' => 'upload'
   ),

); // End General Settings

$spyropress_skins = get_option( '_spyropress_porto_skins', array() );

$spyropress_skin_options = array();
foreach( $spyropress_skins as $k => $skin ) {
   $spyropress_skin_options[$k] = '<span class="skin-item" style="background:' . spyropress_validate_setting( $skin['color'], 'colorpicker', 'skin_color', array() ) . ';"><span>' . $skin['name'] . '</span></span><a href="#" data-name="' . $k . '" class="skin-remove-item button-red">Delete Skin</a>';
}

$spyropress_theme_settings['layout'] = array(

   array(
      'label' => esc_html__( 'Layout Options', 'tomato' ),
      'type' => 'heading',
      'slug' => 'layout',
      'icon' => 'module-icon-layout'
   ),



   array(
      'label' => esc_html__( 'Layout Options', 'tomato' ),
      'type' => 'sub_heading',
   ),

   array(
      'label' => esc_html__( 'Theme Layout', 'tomato' ),
      'id' => 'theme_layout',
      'type' => 'radio_img',
      'class' => 'enable_changer section-full',
      'desc' => esc_html__( 'Select which layout you want for theme.', 'tomato' ),
      'options' => array(
         'wide' => array(
            'title' => esc_html__( 'Full Layout', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/full.png' )
         ),
         'boxed' => array(
            'title' => esc_html__( 'Box Layout', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/full.png' )
         )
      ),'std' => 'wide'
   ),

   array(
      'label' => esc_html__( 'Boxed Background', 'tomato' ),
      'id' => 'boxed_bg',
      'class' => 'theme_layout boxed',
      'type' => 'background',
      'use_pattern' => true,
      'patterns' => array(
         assets_img( 'patterns/wood_pattern.png' ) => 'Wood Pattern',
         assets_img( 'patterns/shattered.png' ) => 'Shattered',
         assets_img( 'patterns/vichy.png' ) => 'Vichy',
         assets_img( 'patterns/random_grey_variations.png' ) => 'Random Grey Variations',
         assets_img( 'patterns/irongrip.png' ) => 'Irongrip',
         assets_img( 'patterns/gplaypattern.png' ) => 'Gplaypattern',
         assets_img( 'patterns/diamond_upholstery.png' ) => 'Diamond Upholstery',
         assets_img( 'patterns/denim.png' ) => 'Denim',
         assets_img( 'patterns/crissXcross.png' ) => 'CrissXcross',
         assets_img( 'patterns/climpek.png' ) => 'Climpek',
      ),
      'selector' => 'body'
   ),

   array(
      'label' => esc_html__( 'Skin Options', 'tomato' ),
      'type' => 'sub_heading',
   ),

   array(
      'label' => esc_html__( 'Select skin', 'tomato' ),
      'id' => 'theme_skin',
      'class' => 'skin-selector section-full',
      'type' => 'radio',
      'options' => $spyropress_skin_options
   ),

   array(
      'type' => 'skin_generator',
      'id' => 'skins'
   ),

   array(
      'label' => esc_html__( 'Custom CSS', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'custom_css_textarea',
      'type' => 'textarea',
      'rows' => 12,
      'class' => 'section-full'
   )

); // End Layout Options

$spyropress_theme_settings['header'] = array(

   array(
      'label' => esc_html__( 'Header Customization', 'tomato' ),
      'type' => 'heading',
      'slug' => 'header',
      'icon' => 'module-icon-layout'
   ),
   array(
      'label' => esc_html__( 'Page Breadcrumb', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Sticky Menu', 'tomato' ),
      'id' => 'sticky_menu',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable or disable Header Sticky Menu.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Page Breadcrumb', 'tomato' ),
      'id' => 'page_breadcrumb',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable or disable page breadcrumb.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Page Breadcrumb Background', 'tomato' ),
      'desc' => esc_html__( 'Choose background style for Page bradcrumb background.', 'tomato' ),
      'id' => 'page_breadcrumb_bg',
      'type' => 'background'
   ),

   array(
      'label' => esc_html__( 'Page Breadcrumb', 'tomato' ),
      'desc' => esc_html__( 'Insert short description about the page', 'tomato' ),
      'id' => 'page_breadcrumb_dec',
      'type' => 'textarea',
      'rows' => 3
   )
);

$spyropress_theme_settings['footer'] = array(

   array(
      'label' => esc_html__( 'Footer Customization', 'tomato' ),
      'type' => 'heading',
      'slug' => 'footer',
      'icon' => 'module-icon-footer'
   ),

   array(
      'label' => esc_html__( 'Footer Background', 'tomato' ),
      'id' => 'footer_bg',
      'type' => 'upload'
   ),

   array(
      'label' => esc_html__( 'Footer Widget Areas', 'tomato' ),
      'id' => 'footer_layout',
      'type' => 'radio_img',
      'desc' => esc_html__( 'Select how many footer widget areas you want to display.', 'tomato' ),
      'options' => array(
         '0col' => array(
            'title' => esc_html__( 'No Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/0col.png' )
         ),
         '1col' => array(
            'title' => esc_html__( '1 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/1col.png' )
         ),
         '2col' => array(
            'title' => esc_html__( '2 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/2col.png' )
         ),
         '3col' => array(
            'title' => esc_html__( '3 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/3col.png' )
         ),
         '4col' => array(
            'title' => esc_html__( '4 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/4col.png' )
         ),
         '6col' => array(
            'title' => esc_html__( '6 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/6col.png' )
         ),
         'h2col' => array(
            'title' => esc_html__( 'Half-n-2 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/half_2col.png' )
         ),
         '2hcol' => array(
            'title' => esc_html__( '2-n-Half Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/2col_half.png' )
         ),
         'h3col' => array(
            'title' => esc_html__( 'Half-n-3 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/half_3col.png' )
         ),
         '3hcol' => array(
            'title' => esc_html__( '3-n-Half Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/3col_half.png' )
         ),
         't4col' => array(
            'title' => esc_html__( 'Third-n-4 Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/third_4col.png' )
         ),
         '4tcol' => array(
            'title' => esc_html__( '4-n-Third Column', 'tomato' ),
            'img' => get_panel_img_path( 'layouts/4col_third.png' )
         )
      ),
      'std' => '3col'
   ),

   array(
      'label' => esc_html__( 'Copyright', 'tomato' ),
      'desc' => esc_html__( 'Custom HTML and Text that will appear in the footer of your theme.', 'tomato' ),
      'id' => 'footer_copyright',
      'type' => 'editor'
   ),

   array(
      'label' => esc_html__( 'Footer Subscribe', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Footer Subscribe', 'tomato' ),
      'id' => 'footer_subscribe',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable or disable footer subscribe.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Subscribe Heading', 'tomato' ),
      'id' => 'footer_subscribe_heading',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Subscribe Sub Heading', 'tomato' ),
      'id' => 'footer_subscribe_sub_heading',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Subscribe Shortcode', 'tomato' ),
      'desc' => esc_html__( 'Insert Mailchamp Shortcode', 'tomato' ),
      'id' => 'footer_subscribe_shortcode',
      'type' => 'text'
   ),

); // END FOOTER

$spyropress_theme_settings['post'] = array(

   array(
      'label' => esc_html__( 'Post Options', 'tomato' ),
      'type' => 'heading',
      'slug' => 'post',
      'icon' => 'module-icon-post'
   ),

   array(
      'label'    => esc_html__( 'Layout', 'tomato' ),
      'type'    => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Blog Layout', 'tomato' ),
      'id' => 'blog_layout',
      'type' => 'select',
      'class' => 'enable_changer section-full',
      'options' => array(
         'large' => esc_html__( 'Full Width', 'tomato' ),
         'sidebar' => esc_html__( 'Sidebar', 'tomato' ),
         'masonry' => esc_html__( 'Masonry', 'tomato' ),
      ),
      'std' => 'large'
   ),

   array(
      'label' => esc_html__( 'Sidebar Position', 'tomato' ),
      'id' => 'blog_sidebar_position',
      'class' => 'section-full blog_layout sidebar',
      'type' => 'select',
      'options' => array(
         'left' => esc_html__( 'Left Side', 'tomato' ),
         'right' => esc_html__( 'Right Side', 'tomato' )
      ),
      'std' => 'right'
   ),

   array(
      'label' => esc_html__( 'Single Sidebar Position', 'tomato' ),
      'id' => 'blog_single_sidebar_position',
      'class' => 'section-full',
      'type' => 'select',
      'options' => array(
         'left' => esc_html__( 'Left Side', 'tomato' ),
         'right' => esc_html__( 'Right Side', 'tomato' )
      ),
      'std' => 'right'
   ),

   array(
      'label' => esc_html__( 'Excerpt Settings', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Length by', 'tomato' ),
      'id' => 'excerpt_by',
      'type' => 'select',
      'options' => array (
         '' => '',
         'words' => esc_html__( 'Words', 'tomato' ),
         'chars' => esc_html__( 'Character', 'tomato' ),
      ),
      'std' => 'words'
   ),

   array(
      'label' => esc_html__( 'Length', 'tomato' ),
      'desc' => esc_html__( 'Set the length of excerpt.', 'tomato' ),
      'id' => 'excerpt_length',
      'type' => 'text',
      'std' => 30
   ),

   array(
      'label' => esc_html__( 'Ellipsis', 'tomato' ),
      'desc' => esc_html__( 'This is the description field, again good for additional info.', 'tomato' ),
      'id' => 'excerpt_ellipsis',
      'type' => 'text',
      'std' => '&hellip;'
   ),

   array(
      'label' => esc_html__( 'Before Text', 'tomato' ),
      'desc' => esc_html__( 'This is the description field, again good for additional info.', 'tomato' ),
      'id' => 'excerpt_before_text',
      'type' => 'text',
      'std' => '<p>'
   ),

   array(
      'label' => esc_html__( 'After Text', 'tomato' ),
      'desc' => esc_html__( 'This is the description field, again good for additional info.', 'tomato' ),
      'id' => 'excerpt_after_text',
      'type' => 'text',
      'std' => '</p>'
   ),

   array(
      'label' => esc_html__( 'Read More', 'tomato' ),
      'id' => 'excerpt_link_to_post',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable or disable Read more link.', 'tomato' ),
      ),
      'std' => 1
   ),

   array(
      'label' => esc_html__( 'Link Text', 'tomato' ),
      'desc' => esc_html__( 'A text for Read More button.', 'tomato' ),
      'id' => 'excerpt_link_text',
      'type' => 'text',
      'std' => 'Continue Reading..'
   ),
   /* hiden because not word*/
   array(
      'label' => esc_html__( 'Author Box', 'tomato' ),
      'desc' => esc_html__( 'A box to display about author on single page.', 'tomato' ),
      'type' => 'sub_heading',
      'class' => 'hidden',
   ),

   array(
      'desc' => esc_html__( 'A box to display about author.', 'tomato' ),
      'id' => 'meta_authorbox',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable author box.', 'tomato' ),
      ),
      'std' => '1',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Author Title', 'tomato' ),
      'desc' => esc_html__( 'Write the title.', 'tomato' ),
      'id' => 'authorbox_title',
      'type' => 'text',
      'std' => esc_html__( 'About the Author', 'tomato' ),
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Author Name Prefix', 'tomato' ),
      'desc' => esc_html__( 'The prefix display before author name.', 'tomato' ),
      'id' => 'authorbox_prefix',
      'type' => 'text',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Related Posts', 'tomato' ),
      'desc' => esc_html__( 'Show related posts on single page.', 'tomato' ),
      'type' => 'sub_heading',
      'class' => 'hidden',
   ),

   array(
      'id' => 'related_enable',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable related posts.', 'tomato' ),
      ),
      'std' => '1',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Related Posts Title', 'tomato' ),
      'desc' => esc_html__( 'Write the title.', 'tomato' ),
      'id' => 'related_title',
      'type' => 'text',
      'std' => esc_html__( 'Related Posts', 'tomato' ),
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Number Of Posts', 'tomato' ),
      'desc' => esc_html__( 'Set the number of related post.', 'tomato' ),
      'id' => 'related_number',
      'type' => 'range_slider',
      'max' => '20',
      'std' => 4,
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Related Posts By', 'tomato' ),
      'desc' => esc_html__( 'Choose the tag or category to show related post.', 'tomato' ),
      'id' => 'related_by',
      'type' => 'select',
      'options' => array(
         'tags' => esc_html__( 'Tags', 'tomato' ),
         'category' => esc_html__( 'Category', 'tomato' )
      ),
      'std' => 'tags',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Excerpt Word Count', 'tomato' ),
      'desc' => esc_html__( 'Set the length of word for related post.', 'tomato' ),
      'id' => 'related_number_excerpt',
      'type' => 'range_slider',
      'max' => '80',
      'std' => 10,
      'class' => 'hidden',
   )

); // End Blog Settings

$spyropress_theme_settings['woocommerce'] = array(

   array(
      'label' => esc_html__( 'WooCommerce Options', 'tomato' ),
      'type' => 'heading',
      'slug' => 'woocommerce',
      'icon' => 'module-icon-post',
      'selected' => true
   ),

   array(
      'label' => esc_html__( 'Layout', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Shop Layout', 'tomato' ),
      'id' => 'shop_layout',
      'class' => 'enable_changer section-full',
      'type' => 'select',
      'options' => array(
         'full' => esc_html__( 'Full Width', 'tomato' ),
         'sidebar' => esc_html__( 'Sidebar', 'tomato' ),
      ),
      'std' => 'full'
   ),

   array(
      'label' => 'Sidebar Position',
      'id' => 'shop_sidebar_pos',
      'class' => 'shop_layout sidebar section-full',
      'type' => 'select',
      'options' => array(
         'left'  =>  esc_html__( 'Left Sidebar', 'tomato' ),
         'right' =>  esc_html__( 'Right Sidebar', 'tomato' )
      ),
      'std' => 'right'
   ),


   array(
      'label' => esc_html__( 'Top Bar' , 'tomato' ),
      'id' => 'shop_loop_top_bar',
      'type' => 'checkbox',
      'desc' => esc_html__( 'Enable features at the Shop page.', 'tomato' ),
      'options' => array(
         'result_count' => esc_html__( 'Show Result Count', 'tomato' ),
         'filter' => esc_html__( 'Show Catalog Ordering', 'tomato' ),
         'pagination' => esc_html__( 'Show Pagination', 'tomato' ),
      )
   ),

   array(
      'label' => 'Pagination Position',
      'id' => 'shop_pagination_pos',
      'type' => 'select',
      'options' => array(
         'top'  =>  esc_html__( 'Top', 'tomato' ),
         'bottom' =>  esc_html__( 'Bottom', 'tomato' ),
         'both' =>  esc_html__( 'Both', 'tomato' )
      ),
      'std' => 'bottom'
   ),

   array(
      'label' => esc_html__( 'Product Limit', 'tomato' ),
      'desc' => esc_html__( 'Set the number of product per page.', 'tomato' ),
      'id' => 'shop_loop_product_per_page',
      'type' => 'range_slider',
      'max' => '20',
      'std' => 12
   ),
   array(
      'label' => esc_html__( 'Product Columns', 'tomato' ),
      'id' => 'shop_loop_product_columns',
      'desc' => esc_html__( 'Set the number of columns for shop.', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 4
   ),

   array(
      'label' => esc_html__( 'Product Single Page Settings', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Single Layout', 'tomato' ),
      'id' => 'shop_single_layout',
      'class' => 'enable_changer section-full',
      'type' => 'select',
      'options' => array(
         'full' => esc_html__( 'Full Width', 'tomato' ),
         'sidebar' => esc_html__( 'Sidebar', 'tomato' ),
      ),
      'std' => 'full'
   ),

   array(
      'label' => 'Sidebar Position',
      'id' => 'shop_single_sidebar_pos',
      'class' => 'shop_single_layout sidebar section-full',
      'type' => 'select',
      'options' => array(
         'left'  =>  esc_html__( 'Left Sidebar', 'tomato' ),
         'right' =>  esc_html__( 'Right Sidebar', 'tomato' )
      ),
      'std' => 'right'
   ),

   array(
      'label' => esc_html__( 'Social Sharing', 'tomato' ),
      'id' => 'shop_single_sharing',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable social sharing', 'tomato' ),
         
      ),
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Products Tabs', 'tomato' ),
      'id' => 'shop_single_tabs',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Disable product tabs on product page.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Related Products', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'shop_related_items',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Disable related products.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Related Products Limit', 'tomato' ),
      'id' => 'shop_related_items_limit',
      'desc' => esc_html__( 'Set the number of related product.', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 30
   ),

   array(
      'label' => esc_html__( 'Related Product Columns', 'tomato' ),
      'id' => 'shop_related_columns',
      'desc' => esc_html__( 'Set the number of columns for related products', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 4
   ),

   array(
      'label' => esc_html__( 'Up Sell Products', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'shop_upsell',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Disable up sell products.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Up Sell Products Limit', 'tomato' ),
      'id' => 'shop_upsell_limit',
      'desc' => esc_html__( 'Set the number of up sell product.', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 30
   ),
   array(
      'label' => esc_html__( 'Up Sell Product Columns', 'tomato' ),
      'id' => 'shop_upsell_columns',
      'desc' => esc_html__( 'Set the number of columns for up sell products', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 4
   ),

   array(
      'label' => esc_html__( 'Mini Cart Settings', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'mini_cart_hide_if_empty',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Hide if cart is empty', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Mini Cart Items', 'tomato' ),
      'id' => 'mini_cart_items',
      'desc' => esc_html__( 'Set the number of cart items to display', 'tomato' ),
      'type' => 'range_slider',
      'std' => 1,
      'max' => 10
   ),

   array(
      'label' => esc_html__( 'Cross Sell Products', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'shop_cross_sell',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Disable cross sell products.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Cros Sell Products Limit', 'tomato' ),
      'id' => 'shop_cross_sell_limit',
      'desc' => esc_html__( 'Set the number of cross sell product.', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 30
   ),

   array(
      'label' => esc_html__( 'Cross Sell Product Columns', 'tomato' ),
      'id' => 'shop_cross_sell_columns',
      'desc' => esc_html__( 'Set the number of columns for cross sell products', 'tomato' ),
      'type' => 'range_slider',
      'std' => 4,
      'max' => 4
   )

);

$spyropress_theme_settings['recipe'] = array(

   array(
      'label' => esc_html__( 'Recipe Options', 'tomato' ),
      'type' => 'heading',
      'slug' => 'recipe',
      'icon' => 'module-icon-post'
   ),

   array(
      'id' => 'recipe_related_enable',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable related recipe posts.', 'tomato' ),
      ),
      'std' => '1'
   ),

   array(
      'label' => esc_html__( 'Title', 'tomato' ),
      'id' => 'recipe-title',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Featured Recipe'
   ),

   array(
      'label' => esc_html__( 'Number Of Posts', 'tomato' ),
      'desc' => esc_html__( 'Set the number of related post.', 'tomato' ),
      'id' => 'recipe_related_number',
      'type' => 'range_slider',
      'max' => '20',
      'std' => 7
   ),

   array(
      'label' => esc_html__( 'Related Posts By', 'tomato' ),
      'desc' => esc_html__( 'Choose the recent or category to show related recipe post.', 'tomato' ),
      'id' => 'recipe_related_by',
      'type' => 'select',
      'options' => array(
         'recent' => esc_html__( 'Recent', 'tomato' ),
         'category' => esc_html__( 'Category', 'tomato' )
      ),
      'std' => 'recent'
   )


);//End Recipe Settings.

$spyropress_theme_settings['translate'] = array(

   array(
      'label' => esc_html__( 'Translate', 'tomato' ),
      'type' => 'heading',
      'slug' => 'translate',
      'icon' => 'module-icon-docs'
   ),

   array(
      'label' => esc_html__( 'General', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'desc' => esc_html__( 'Turn it off if you want to use .mo .po files for more complex translation.', 'tomato' ),
      'id' => 'translate',
      'type' => 'checkbox',
      'options' => array(
         1 => esc_html__( 'Enable Translate', 'tomato' ),
      ),
      'std' => '1'
   ),

   array(
      'label' => esc_html__( 'Home', 'tomato' ),
      'desc' => esc_html__( 'Breadcrumb and Menu', 'tomato' ),
      'id' => 'translate-home',
      'type' => 'text',
      'std' => 'Home',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Menu', 'tomato' ),
      'desc' => esc_html__( 'Responsive Menu', 'tomato' ),
      'id' => 'nav-menu',
      'type' => 'text',
      'std' => 'Menu',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Search Placeholder', 'tomato' ),
      'desc' => esc_html__( 'Search widget', 'tomato' ),
      'id' => 'search-placeholder',
      'type' => 'text',
      'std' => 'Search..'
   ),

   array(
      'label' => esc_html__( 'Search Button', 'tomato' ),
      'desc' => esc_html__( 'Search widget button', 'tomato' ),
      'id' => 'search-btn',
      'type' => 'text',
      'std' => 'Go',
      'class' => 'hidden',
   ),

   array(
      'label' => esc_html__( 'Blog & Archives', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'id' => 'translate-comment',
      'type' => 'text',
      'label' => esc_html__('Comment', 'tomato'),
      'desc' => esc_html__('Text to display when there is one comment', 'tomato'),
      'std' => 'Comment'
   ),

   array(
      'id' => 'translate-comments',
      'type' => 'text',
      'label' => esc_html__('Comments', 'tomato'),
      'desc' => esc_html__('Text to display when there are more than one comments', 'tomato'),
      'std' => 'Comments'
   ),

   array(
      'id' => 'translate-comments-off',
      'type' => 'text',
      'label' => esc_html__('Comments closed', 'tomato'),
      'desc' => esc_html__('Text to display when comments are disabled', 'tomato'),
      'std' => 'Comments are closed.'
   ),

   array(
      'id' => 'comment-reply',
      'type' => 'text',
      'label' => esc_html__('Reply', 'tomato'),
      'desc' => esc_html__('Text to display on comment Reply Button', 'tomato'),
      'std' => 'Reply'
   ),

   array(
      'label' => esc_html__( 'Blog', 'tomato' ),
      'desc' => esc_html__( 'Blog', 'tomato' ),
      'id' => 'blog-title',
      'type' => 'text',
      'std' => '<span>Our</span> Blog'
   ),

   array(
      'label' => esc_html__( 'Category', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'cat-title',
      'type' => 'text',
      'std' => '<span>Category:</span> %s'
   ),

   array(
      'label' => esc_html__( 'Tag', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'tag-title',
      'type' => 'text',
      'std' => '<span>Tag:</span> %s'
   ),

   array(
      'label' => esc_html__( 'Day', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'day-title',
      'type' => 'text',
      'std' => '<span>Daily:</span> %s'
   ),

   array(
      'label' => esc_html__( 'Month', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'month-title',
      'type' => 'text',
      'std' => '<span>Monthly:</span> %s'
   ),

   array(
      'label' => esc_html__( 'Year', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'year-title',
      'type' => 'text',
      'std' => '<span>Yearly:</span> %s'
   ),

   array(
      'label' => esc_html__( 'Archive', 'tomato' ),
      'desc' => esc_html__( 'Archive', 'tomato' ),
      'id' => 'archive-title',
      'type' => 'text',
      'std' => 'Archives'
   ),

   array(
      'label' => esc_html__( 'Recipies', 'tomato' ),
      'desc' => esc_html__( 'Blog', 'tomato' ),
      'id' => 'recipies-title',
      'type' => 'text',
      'std' => 'Recipies'
   ),

   array(
      'label' => esc_html__( 'Search', 'tomato' ),
      'desc' => esc_html__( 'Search result page', 'tomato' ),
      'id' => 'search-title',
      'type' => 'text',
      'std' => 'Search results: <span>%s</span>'
   ),

   array(
      'label' => esc_html__( 'Recipe Single Page', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Direction', 'tomato' ),
      'id' => 'recipe-direction',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Direction'
   ),

   array(
      'label' => esc_html__( 'Ingredients', 'tomato' ),
      'id' => 'recipe-ingredients',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Ingredients'
   ),

   array(
      'label' => esc_html__( 'Descriptions', 'tomato' ),
      'id' => 'recipe-descriptions',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Descriptions'
   ),

   array(
      'label' => esc_html__( 'Nutrition', 'tomato' ),
      'id' => 'recipe-nutrition',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Nutrition'
   ),

   array(
      'label' => esc_html__( 'Nutrient', 'tomato' ),
      'id' => 'recipe-nutrient',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'Nutrient'
   ),

   array(
      'label' => esc_html__( 'DV', 'tomato' ),
      'id' => 'recipe-dv',
      'type' => 'text',
      'class' => 'section-full',
      'std' => 'DV'
   ),

   array(
      'label' => esc_html__( '%DV', 'tomato' ),
      'id' => 'recipe-dv-percentage',
      'type' => 'text',
      'class' => 'section-full',
      'std' => '%DV'
   ),

   array(
      'label' => esc_html__( 'Error 404', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Title', 'tomato' ),
      'desc' => esc_html__( '404', 'tomato' ),
      'id' => 'error-404-title',
      'type' => 'text',
      'std' => '404'
   ),

   array(
      'label' => esc_html__( 'Subtitle', 'tomato' ),
      'desc' => esc_html__( 'We are sorry, but the page you are looking for does not exist.', 'tomato' ),
      'id' => 'error-404-subtitle',
      'type' => 'text',
      'std' => 'We are sorry, but the page you are looking for does not exist.'
   ),

   array(
      'label' => esc_html__( 'Button', 'tomato' ),
      'desc' => esc_html__( 'Back to home', 'tomato' ),
      'id' => 'error-404-btn',
      'type' => 'text',
      'std' => 'Back to home'
   ),

);

$spyropress_theme_settings['plugins'] = array(

   array(
      'label' => esc_html__( 'Settings', 'tomato' ),
      'type' => 'heading',
      'slug' => 'plugins',
      'icon' => 'module-icon-general'
   ),

   array(
      'label' => esc_html__( 'Email Settings', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Sender Name', 'tomato' ),
      'desc' => esc_html__( 'For example sender name is "WordPress".', 'tomato' ),
      'id' => 'mail_from_name',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Sender Email Address', 'tomato' ),
      'desc' => esc_html__( 'For example sender email address is wordpress@yoursite.com.', 'tomato' ),
      'id' => 'mail_from_email',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Twitter oAuth Settings', 'tomato' ),
      'type' => 'sub_heading'
   ),

   array(
      'label' => esc_html__( 'Twitter Username', 'tomato' ),
      'id' => 'twitter_username',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Consumer Key', 'tomato' ),
      'id' => 'twitter_consumer_key',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Consumer Secret', 'tomato' ),
      'id' => 'twitter_consumer_secret',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Access Token', 'tomato' ),
      'id' => 'twitter_access_token',
      'type' => 'text'
   ),

   array(
      'label' => esc_html__( 'Access Token Secret', 'tomato' ),
      'id' => 'twitter_access_token_secret',
      'type' => 'text'
   ),
   array(
      'label' => esc_html__( 'Google Map API', 'tomato' ),
      'type' => 'sub_heading',
   ),
   array(
      'label' => esc_html__( 'KEY', 'tomato' ),
      'id' => 'goolgle_map_key',
      'desc'   => esc_html__( "Get key on", 'tomato' ). 
      '<br/> https://developers.google.com/maps/documentation/javascript/tutorial',
      'type' => 'text'
   ),
   array(
      'label' => esc_html__( 'WP-Pagenavi', 'tomato' ),
      'type' => 'toggle'
   ),

   array(
      'label' => esc_html__( 'Text For Number Of Pages', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_pages_text',
      'desc' =>   '%CURRENT_PAGE% - ' . esc_html__( 'The current page number.', 'tomato' ) .
      '<br />%TOTAL_PAGES% - ' . esc_html__( 'The total number of pages.', 'tomato' ),
      'std' => esc_html__( 'Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'tomato' ),
   ),

   array(
      'label' => esc_html__( 'Text For Current Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_current_text',
      'desc' => '%PAGE_NUMBER% - '.__( 'The page number.', 'tomato' ),
      'std' => '%PAGE_NUMBER%'
   ),

   array(
      'label' => esc_html__( 'Text For Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_page_text',
      'desc' => '%PAGE_NUMBER% - ' .__( 'The page number.', 'tomato' ),
      'std' => '%PAGE_NUMBER%'
   ),

   array(
      'label' => esc_html__( 'Text For First Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_first_text',
      'desc' => '%TOTAL_PAGES% - ' .__( 'The total number of pages.', 'tomato' ),
      'std' => '&laquo; First'
   ),

   array(
      'label' => esc_html__( 'Text For Last Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_last_text',
      'desc' => '%TOTAL_PAGES% - ' .__( 'The total number of pages.', 'tomato' ),
      'std' => 'Last &raquo;'
   ),

   array(
      'label' => esc_html__( 'Text For Previous Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_prev_text',
      'std' => '&laquo;'
   ),

   array(
      'label' => esc_html__( 'Text For Next Page', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_next_text',
      'std' => '&raquo;'
   ),

   array(
      'label' => esc_html__( 'Text For Previous &hellip;', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_dotleft_text',
      'std' => '&hellip;'
   ),

   array(
      'label' => esc_html__( 'Text For Next &hellip;', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_dotright_text',
      'std' => '&hellip;'
   ),

   array(
      'label' => esc_html__( 'Page Navigation Text', 'tomato' ),
      'type' => 'sub_heading',
      'desc' => esc_html__( 'Leaving a field blank will hide that part of the navigation.', 'tomato' ),
   ),

   array(
      'label' => esc_html__( 'Always Show Page Navigation', 'tomato' ),
      'type' => 'checkbox',
      'id' => 'pagination_always_show',
      'options' => array(
         1 => esc_html__( 'Show navigation even if there\'s only one page.', 'tomato' ),
      )
   ),

   array(
      'label' => esc_html__( 'Number Of Pages To Show', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_num_pages',
      'std' => 5
   ),

   array(
      'label' => esc_html__( 'Number Of Larger Page Numbers To Show', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_num_larger_page_numbers',
      'desc' => esc_html__( 'Larger page numbers are in addition to the normal page numbers. They are useful when there are many pages of posts.', 'tomato' ),
      'std' => 3
   ),

   array(
      'label' => esc_html__( 'Show Larger Page Numbers In Multiples Of', 'tomato' ),
      'type' => 'text',
      'id' => 'pagination_larger_page_numbers_multiple',
      'desc' => esc_html__( 'For example, if mutiple is 5, it will show: 5, 10, 15, 20, 25', 'tomato' ),
      'std' => 10
   ),

   array(
      'type' => 'toggle_end'
   ),

); // END PLUGINS

$spyropress_theme_settings['separator'] = array(

   array ( 'type' => 'separator' )

); // END Separator

$spyropress_theme_settings['import'] = array(

   array (
      'label' => esc_html__( 'Import / Export', 'tomato' ),
      'type' => 'heading',
      'slug' => 'import-export',
      'icon' => 'module-icon-import'
   ),

   array(
      'type' => 'import_dummy'
   ),

   array(
      'type' => 'import'
   ),

   array(
      'type' => 'export'
   ),
); // END Import/Export

$spyropress_theme_settings['support'] = array(

   array (
      'label' => esc_html__( 'Support', 'tomato' ),
      'type' => 'heading',
      'slug' => 'support',
      'icon' => 'module-icon-support'
   ),

   array(
      'id' => 'admin/docs-support.php',
      'type' => 'include'
   )

); // END Separator