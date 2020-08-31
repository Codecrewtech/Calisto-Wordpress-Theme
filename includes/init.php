<?php

/**
 * Init Theme Related Settings
 */

/** Internal Settings **/
locate_template( 'includes/version.php', true );

/**
 * Required and Recommended Plugins
 */
function spyropress_register_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $spyropress_plugins = array(
 
        // Contact Form 7
        array(
            'name'      => esc_html__('Contact Form 7','tomato'),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        
        array(
            'name'      => esc_html__('MailChimp','tomato'),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
        ),
        
        array(
            'name' => esc_html__('Post Format UI','tomato'),
            'required' => true,
            'slug' => 'wp-post-formats-develop',
            'source' => include_path() . 'plugins/wp-post-formats-develop.zip'
        ),
        
        array(
            'name' => esc_html__('Custom Post Type','tomato'),
            'required' => true,
            'slug' => 'cpt',
            'source' => include_path() . 'plugins/cpt.zip'
        ),
        
        // Woocommerce
        array(
            'name'      => esc_html__('woocommerce','tomato'),
            'slug'      => 'woocommerce',
            'required'  => true
        ),
        
        // YITH WooCommerce Wishlist
        array(
            'name'      => esc_html__('YITH WooCommerce Wishlist','tomato'),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => false
        ),

        array(
            'name'     => esc_html__('Ef3 Import and Export','tomato'),
            'slug'     => 'ef3-import-and-export',
            'source'   => 'http://spyropress.com/plugins/ef3-import-and-export.zip',
            'required' => false,
        )

    );

    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
    );

    tgmpa( $spyropress_plugins, $config );
}
add_action( 'tgmpa_register', 'spyropress_register_plugins' );

/**
 * Add modules and tempaltes to SpyroBuilder
 */
function spyropress_register_builder_modules( $modules ) {

    get_template_part( 'includes/tomato-row', 'templates' );
    
    $spyropress_custom = array(
        'modules/home-section/home-section.php',
        'modules/heading/heading.php',
        'modules/about-us/about-us.php',
        'modules/reservation/reservation.php',
        'modules/icon-teaser/icon-teaser.php',
        'modules/our-clients/clients.php',
        'modules/call-action/call-action.php',
        'modules/instagram/instagram.php',
        'modules/tabs/tabs.php',
        'modules/accordion/accordion.php',
        'modules/list-items/list-items.php',
        'modules/contact/contact.php',
        'modules/gmap/gmap.php'
    );

    return array_merge( $modules, $spyropress_custom );
}
add_filter( 'builder_include_modules', 'spyropress_register_builder_modules' );

/**
 * Define the row wrapper html
 */
function spyropress_row_wrapper( $row_ID, $row ) {
    extract( $row['options'] );
    
    // CssClass
    $spyropress_section_class = array();$spyropress_style = '';
    if( isset( $spyropress_skin ) && !empty( $spyropress_skin ) ){
        $spyropress_section_class[] = $spyropress_skin;
        if( 'special' == $spyropress_skin ||  'trusted-quote' == $spyropress_skin ){
            if( isset( $spyropress_bg) && !empty( $spyropress_bg ) ) {
                $spyropress_value = $spyropress_bg;
                $spyropress_img = '';
                $spyropress_bg_contents = array();
        
                if ( isset( $spyropress_value['background-color'] ) )
                    $spyropress_bg_contents[] = $spyropress_value['background-color'];
        
                if ( isset( $spyropress_value['background-pattern'] ) )
                    $spyropress_img = $spyropress_value['background-pattern'];
                elseif ( isset( $spyropress_value['background-image'] ) )
                    $spyropress_img = $spyropress_value['background-image'];
                if ( $spyropress_img )
                    $spyropress_bg_contents[] = 'url(\'' . esc_url( $spyropress_img ) . '\')';
        
                if ( isset( $spyropress_value['background-repeat'] ) )
                    $spyropress_bg_contents[] = $spyropress_value['background-repeat'];
        
                if ( isset( $spyropress_value['background-attachment'] ) )
                    $spyropress_bg_contents[] = $spyropress_value['background-attachment'];
        
                if ( isset( $spyropress_value['background-position'] ) )
                    $spyropress_bg_contents[] = $spyropress_value['background-position'];
        
                $spyropress_style .= ( !empty( $spyropress_bg_contents ) ) ? ' background: ' . join( ' ', $spyropress_bg_contents ) . '; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;' : '';
           
            if( !empty( $spyropress_style ) )
                $spyropress_style = 'style="' . $spyropress_style . '"';
            }
            
        }
    }
        

    $spyropress_row_html = sprintf( '
        <div id="%1$s" class="%2$s" %5$s>
            <div class="container">
                <div class="%3$s">
                    %4$s
                </div>
            </div>
        </div>', $row_ID, spyropress_clean_cssclass( $spyropress_section_class ), get_row_class( true ), builder_render_frontend_columns( $row['columns'] ), $spyropress_style
    );

    return $spyropress_row_html;
}
add_filter( 'spyropress_builder_row_wrapper', 'spyropress_row_wrapper', 10, 2 );

/**
 * Include Widgets
 */
function spyropress_register_widgets( $widgets ) {
    
    $path = dirname(__FILE__) . '/widgets/';

    $custom = array(
        $path . 'contact-info/contact.php',
        $path . 'recent-posts/recent-posts.php'
    );

    return array_merge( $widgets, $custom );
}
add_filter( 'spyropress_register_widgets', 'spyropress_register_widgets' );

/**
 * Comment Callback
 */
if( !function_exists( 'spyropress_comment' ) ) :
function spyropress_comment( $comment, $args, $depth ) {
    $spyropress_translate['comment-reply'] = get_setting( 'translate' ) ? get_setting( 'comment-reply', 'Reply' ) : esc_html__( 'Reply', 'tomato' );
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'tomato' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'tomato' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="comment-item">
            <span class="comment-image">
                <?php echo get_avatar( $comment, 70 ); ?>
            </span>
            <span class="comment-info d-text-c">
                <span><?php printf( esc_html__( '%1$s at %2$s', 'tomato' ), get_comment_date(), get_comment_time() ) ?> &nbsp; / &nbsp; <?php
                comment_reply_link( array_merge( $args, array(
                    'depth' => $depth,
                    'reply_text' => $spyropress_translate['comment-reply'],
                    'max_depth' => $args['max_depth']
                ) ) );
            ?></span> <?php comment_author(); ?>
            </span>
            <?php if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'tomato' ); ?></em><br />
            <?php
                }
                comment_text();
            ?>
        </div>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Pagination Defaults
 */
function pagination_defaults( $defaults = array() ) {
    
    $defaults['container'] = 'ul';
    $defaults['container_class'] = 'pagi_nation center-block';
    $defaults['options']['pages_text'] = false;
    $defaults['options']['prev_text'] = '&lsaquo;';
    $defaults['options']['next_text'] = '&rsaquo;';
    $defaults['options']['first_text'] = '&laquo;';
    $defaults['options']['last_text'] = '&raquo;';
    $defaults['style'] = 'list';
    
    return $defaults;
}
add_filter( 'spyropress_pagination_defaults', 'pagination_defaults' );

/**
 * oEmbed Modifier
 */
function spyropress_oembed_modifier( $spyropress_html ) {
    
    $spyropress_html = preg_replace( '/(width|height|frameborder)="\d*"\s/', "", $spyropress_html );
    
    return '<div class="video">' . $spyropress_html . '</div>';
}
add_filter( 'embed_oembed_html', 'spyropress_oembed_modifier', 10 );
add_filter( 'oembed_result', 'spyropress_oembed_modifier', 10 );