<?php 

/**
 * SpyroPress is a theme framework for professional WordPress theme designing developed by SpyroSol.
 *
 * DON'T HACK ME!! You should NOT modify the SpyroPress theme framework to avoid issues with updates in the future.
 * It's designed to offer cutting edge flexibility - with lots of ways to manipulate output!
 *
 * @package SpyroPress
 */

/**
 * Set Max Content Width
 */

if ( ! isset( $content_width ) )
    $content_width = 726;

if( !function_exists( 'spyropress_content_width' ) ) {
    function spyropress_content_width() {
        if( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
            global $content_width;
            $content_width = 960;
        }
    }
}
add_action( 'template_redirect', 'spyropress_content_width' );

/**
 * Starting SpyroPress Engine
 */
require_once( get_template_directory() . '/framework/spyropress.php' );
require_once( get_template_directory() . '/includes/init.php' ); // Extending theme
require_once( get_template_directory() . '/includes/woocommerce-init.php' ); // Extending WooCommerce

/**
 * Add theme support for spyropress framework features
 */
add_action( 'after_setup_theme', 'spyropress_theme_setup', 4 );


function spyropress_theme_setup() {

    // Add wordpress features
    add_theme_support( 'automatic-feed-links' );

    // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
    add_theme_support( 'post-thumbnails' );
    
    // Tell the TinyMCE editor to use a custom stylesheet
    add_editor_style( assets_css() . 'editor-style.css' );
    
    // Root Relative Urls Support
    add_theme_support( 'relative-urls' );

    // SpyroPress Builder
    add_theme_support( 'spyropress-builder' );
    
    // Style Switcher
    //add_theme_support( 'theme-demo' );
	
	// Custom CSS Editor
    add_theme_support( 'spyropress-ace' );
    
    //Title
    add_theme_support( "title-tag" );
    
    //Custom Header
    $spyropress_defaults = array(
    	'default-image'          => '',
    	'random-default'         => false,
    	'width'                  => 0,
    	'height'                 => 0,
    	'flex-height'            => false,
    	'flex-width'             => false,
    	'default-text-color'     => '',
    	'header-text'            => true,
    	'uploads'                => true,
    	'wp-head-callback'       => '',
    	'admin-head-callback'    => '',
    	'admin-preview-callback' => '',
    );
    add_theme_support( 'custom-header', $spyropress_defaults );
    
    //Custom Background
    $spyropress_defaults = array(
    	'default-color'          => '',
    	'default-image'          => '',
    	'default-repeat'         => '',
    	'default-position-x'     => '',
    	'default-attachment'     => '',
    	'wp-head-callback'       => '_custom_background_cb',
    	'admin-head-callback'    => '',
    	'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $spyropress_defaults );

    // Add post formats (http://codex.wordpress.org/Post_Formats)
    add_theme_support( 'post-formats', array(
        'image',
        'video',
        'audio',
        'gallery',
        'link'
    ) );

    // Add Components
    add_theme_support( 'spyropress-components', array(
        'bucket',
        'slider',
        'testimonials',
        'page',
        'food',
        'staff',
        'recipe',
        'pricing-table',
        'gallery',
        'bootstrap-nav',
        'pagination'
    ) );
    
    // WooCommerce
    add_theme_support( 'woocommerce' );
    
    // Add Sliders
    add_theme_support( 'spyropress-sliders', array( 'flex' => esc_html__( 'Flex Slider', 'tomato' )) );

    // Add Menus
    add_theme_support( 'spyropress-core-menus', array(
        'primary' => 'Main'
    ) );

    // Add Sidebars
    $spyropress_sidebars = array(
        'primary' => array(
            'name' => esc_html__( 'Primary', 'tomato' ),
            'description' => esc_html__( 'The main (primary) widget area, most often used as a sidebar.','tomato' ),
            'before_widget' => '<div id="%1$s" class="widget side-widget %2$s">',
            'after_widget' => '</div><div class="clearfix"></div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>'
        ),
        'woocommerce' => array(
            'name' => esc_html__( 'WooCommerce', 'tomato' ),
            'description' => esc_html__( 'Sidebar loads on WooCommerce pages.','tomato' ),
            'before_widget' => '<div id="%1$s" class="widget side-widget text-left %2$s">',
            'after_widget' => '</div><div class="clearfix row"></div><div class="clearfix row"></div><div class="clearfix row"></div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>'

        )
    );
    add_theme_support( 'spyropress-core-sidebars', $spyropress_sidebars );

    // Options
    $spyropress_options = array(
        'theme' => array(
            'page_title' => esc_html__( 'Theme Options', 'tomato' ),
            'menu_title' => esc_html__( 'Theme Options', 'tomato' ),
            'isactive' => true,
            'hidden' => false
        )
    );
    add_theme_support( 'spyropress-options', $spyropress_options );
    
}

//import export demo data
require_once( get_template_directory() . '/inc/demo-data.php' );
// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

/* HTML function Theme check validator */
function tomato_html($html){
    return $html;
}
/*fix showing product filter by price*/
function update_woocommerce_version() {
    if(class_exists('WooCommerce')) {
        global $woocommerce;
        if(version_compare(get_option('woocommerce_db_version', null), $woocommerce->version, '!=')) {
            update_option('woocommerce_db_version', $woocommerce->version);
            if( !wc_update_product_lookup_tables_is_running()) {
                wc_update_product_lookup_tables();
            }
        }
    }
}
add_action('init', 'update_woocommerce_version');

/* Start check ver CPT*/
function tomato_check_plugin_version($class, $plugin_file_path){
	if( !function_exists('get_plugin_data') ){
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	$plugin = class_exists($class) ? get_plugin_data(WP_PLUGIN_DIR.'/'.$plugin_file_path) : ['Version'=> '0'];
	$plugin['Version'] = str_replace('.', '', $plugin['Version']);
	return (int)$plugin['Version'];
}
function tomato_admin_notice(){
	$cpt_version = tomato_check_plugin_version('SpyropressCustomPostType','cpt/spyropress-core.php');
	if(class_exists('SpyropressCustomPostType') && $cpt_version < 101){
		?>
		<div class="notice notice-error cpt-notice">
			<?php  ?>
			<p>
				<strong>
					<?php echo esc_html__('Custom Post Types plugin using is out of date.', 'tomato');?>
				</strong>
			</p>
			<p>
				<?php printf(__('<strong><a href="%s">Click here</a></strong> to Deactivate and then Delete Custom Post Types to update it to latest version','tomato'),
					esc_url(admin_url('plugins.php'))
				);
				?>
			</p>
		</div>
		<?php
	}
}
add_action('admin_notices', 'tomato_admin_notice', 0);

/**
 * Check framework/sytem plugin version to compatible with theme version
 * Action Deactive plugin
 * @since 2.0
 */
function deactivate_plugin_conditional() {
	$cpt_version = tomato_check_plugin_version('SpyropressCustomPostType', 'cpt/spyropress-core.php');
	if ( class_exists('SpyropressCustomPostType') && $cpt_version < 101 ) {
		deactivate_plugins('cpt/spyropress-core.php');
	}
}
add_action( 'admin_init', 'deactivate_plugin_conditional' );

/**
 * Add Admin style
 */
add_action('admin_enqueue',function(){
	$admin_style = '<style>.cpt-notice strong{font-size: 30px;color: red;}</style>';
	return $admin_style;
});

