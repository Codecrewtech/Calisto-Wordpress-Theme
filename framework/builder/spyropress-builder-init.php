<?php

/**
 * SpyroPress Builder
 *
 * Main builder file which loads all panels and sets up builder.
 *
 * @author        SpyroSol
 * @category    Builder
 * @package    Spyropress
 * @version     1.0.0
 */

if ( ! class_exists( 'SpyropressBuilder' ) ) {

	class SpyropressBuilder {

		/** Variblaes **********************************************/
		var $enabled_post_types = array( 'page', 'bucket', 'template' );
		var $version = '1.0.1';

		/** Private Variblaes **********************************************/
		private $builder_meta_key = '_spyropress_builder_data';
		private $post_type;

		/** Instances **********************************************/
		var $row_factory;
		var $col_factory;
		var $module_factory;
		var $columns;

		function __construct() {

			// Include required files
			$this->spyropress_includes();

			// Load Factories
			add_action( 'after_setup_theme', array( $this, 'init_factory' ), 3 );

			// Load Templates
			add_action( 'init', array( $this, 'init' ), 2 );

			if ( is_admin() ) {
				// Enqueue Scripts
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

				// Add builder class to current enabled screen
				add_action( 'admin_body_class', array( $this, 'admin_body_class' ) );

				// Some More
				add_action( 'do_meta_boxes', array( $this, 'remove_meta_boxes' ) );
				add_action( 'deleted_post', array( $this, 'delete_post_meta' ) );
			}
		}

		function spyropress_includes() {

			$spyropress_includes = array(

				/** Core Function **/
				'spyropress-builder-template-loader.php',
				'spyropress-builder-template.php',
				'spyropress-row-functions.php',
				'spyropress-column-functions.php',
				'spyropress-module-functions.php',
				'spyropress-builder-ajax-functions.php',

				/** Classes **/
				'classes/class-row.php',
				'classes/class-column.php',
				'classes/class-module.php',
			);

			foreach ( $spyropress_includes as $spyropress_include ) {
				load_template( get_template_directory() . "/framework/builder/$spyropress_include", false );
			}
		}

		/**
		 * Init Factory
		 */
		function init_factory() {

			$this->rows    = new SpyropressBuilderRows();
			$this->columns = new SpyropressBuilderColumns();
			$this->modules = new SpyropressBuilderModules();
		}

		/**
		 * Init Engine
		 */
		function init() {

			// Load Templates
			get_template_part( 'framework/builder/rc-templates/' . get_html_framework() . '-row', 'templates' );
			get_template_part( 'framework/builder/rc-templates/' . get_html_framework() . '-col', 'templates' );

			// Load Modules
			$spyropress_includes = array(

				// Row Options
				'modules/row-options/row-options.php',
				'modules/rich-text/rich-text.php'
			);

			// allow developers to add in more modules
			$spyropress_includes = array_merge( $spyropress_includes, apply_filters( 'builder_include_modules', array() ) );
			foreach ( $spyropress_includes as $spyropress_include ) {
				include_once( $spyropress_include );
			}

			// Load Builder UI on enabled post types to render builder on
			$this->enabled_post_types = apply_filters( 'builder_enabled_post_types', $this->enabled_post_types );

			// init Builder
			add_action( 'dbx_post_sidebar', array( $this, 'rednder_builder_ui' ) );
		}

		/**
		 * Enqueue Scripts and Styles
		 */
		function enqueue_scripts() {

			/**
			 * Styles
			 */
			wp_register_style( 'spyropress-builder', framework_assets_css() . 'spyropress-builder.css', '', get_core_version() );

			/**
			 * Scripts
			 */
			wp_register_script( 'builder-helper', framework_assets_js() . 'builder-helper.js', false, '1.1', true );
			wp_register_script( 'builder', framework_assets_js() . 'builder.js', array(
				'jquery-ui-position',
				'jquery-ui-sortable',
				'builder-helper'
			), '1.1', true );
			wp_enqueue_script( 'builder' );
		}

		function rednder_builder_ui() {

			if ( ! empty( $this->enabled_post_types ) &&
			     ! in_array( get_current_post_type(), $this->enabled_post_types )
			) {
				return;
			}

			// else include
			get_template_part( 'framework/builder/spyropress-builder', 'ui' );
		}

		/**
		 * Delete Meta
		 *
		 * Delete template from posts using it as layout template
		 */
		function delete_post_meta( $post_id ) {

			global $wpdb;
			$query = $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key = %s  AND meta_value = %s", '_builder_template', $post_id );
			$wpdb->query( $query );
		}

		/**
		 * Remove Featured Image Metabox
		 */
		function remove_meta_boxes() {
			remove_meta_box( 'postimagediv', 'template', 'side' );
		}

		/**
		 * Add Class to Admin Body tag.
		 */
		function admin_body_class() {
			if ( $post_type = get_current_post_type() ) {
				if ( in_array( $post_type, $this->enabled_post_types ) ) {
					return 'builder_enabled ';
				}
			}

			return '';
		}

		/** Helper Functions ********************************************************/

		/**
		 * Get Wordpress Tree
		 */
		function get_template_tree() {

			// Template Hierarchy
			$template_tree = $post_type_tree = $single_tree = $tax_tree = array();

			// Special Pages
			$special_tree = array(
				'404.php'        => esc_html__( 'Error 404', 'tomato' ),
				'home.php'       => esc_html__( 'Home Page', 'tomato' ),
				'front-page.php' => esc_html__( 'Front Page', 'tomato' ),
				'page.php'       => esc_html__( 'Generic Page', 'tomato' ),
				'single.php'     => esc_html__( 'Generic Single Post', 'tomato' ),
				'search.php'     => esc_html__( 'Search Result', 'tomato' ),
				'archive.php'    => esc_html__( 'Generic Archive', 'tomato' ),
				'category.php'   => esc_html__( 'Generic Category', 'tomato' ),
				'tag.php'        => esc_html__( 'Generic Tag', 'tomato' ),
				'author.php'     => esc_html__( 'Author', 'tomato' ),
			);

			$template_tree[] = array(
				'name'    => esc_html__( 'Special Pages', 'tomato' ),
				'options' => $special_tree
			);

			// Post Types
			$post_types = get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' );
			foreach ( $post_types as $key => $post_type ) {
				$post_type_tree[ $key ] = $post_type->labels->name;
				$single_tree[ $key ]    = $post_type->labels->name;
			}
			$template_tree[] = array(
				'name'    => esc_html__( 'Post Types', 'tomato' ),
				'options' => $post_type_tree
			);

			// Date Archive
			$date            = array(
				'year'  => 'Yearly',
				'month' => 'Monthly',
				'day'   => 'Daily'
			);
			$template_tree[] = array(
				'name'    => esc_html__( 'Date Archive', 'tomato' ),
				'options' => $date
			);

			// Taxonomies
			$taxonomies = get_taxonomies( array( '_builtin' => false ), 'objects' );
			foreach ( $taxonomies as $key => $taxonomy ) {
				if ( $taxonomy->public == 1 ) {
					$tax_tree[ $key ] = $taxonomy->labels->name;
				}
			}
			$template_tree[] = array(
				'name'    => esc_html__( 'Taxonomies', 'tomato' ),
				'options' => $tax_tree
			);
			$template_tree[] = array(
				'name'    => esc_html__( 'Singular', 'tomato' ),
				'options' => $single_tree
			);

			return $template_tree;
		}

		/**
		 * Get Partial Layout
		 */
		function get_partial_templates() {

			// Blocks
			$blocks       = array();
			$blocks['-1'] = esc_html__( 'Blank', 'tomato' );
			$blocks['-2'] = esc_html__( 'Theme Default', 'tomato' );

			// Partial Layouts
			$args        = array(
				'post_type'      => 'template',
				'posts_per_page' => - 1,
				'meta_query'     => array(
					array(
						'key'   => 'canvas_type',
						'value' => 'partial'
					)
				)
			);
			$buckets     = get_posts( $args );
			$bucket_tree = array();
			if ( ! empty( $buckets ) ) {
				foreach ( $buckets as $bucket ) {
					$bucket_tree[ $bucket->ID ] = $bucket->post_title;
				}
			}

			$blocks[] = array(
				'name'    => esc_html__( 'Partial Layouts', 'tomato' ),
				'options' => $bucket_tree
			);

			return $blocks;
		}

		function layout_metabox() {

			global $spyropress;

			// Custom Template
			$args = array(
				'post_type'      => 'template',
				'posts_per_page' => - 1,
				'meta_query'     => array( array( 'key' => 'canvas_type', 'value' => 'full' ) )
			);

			$layouts = get_posts( $args );
			if ( ! empty( $layouts ) ) {
				foreach ( $layouts as $layout ) {
					$layout_tree[ $layout->ID ] = $layout->post_title;
				}
			}

			$layout_meta['spyropress_layout'] = array(
				array(
					'name' => esc_html__( 'Layouts', 'tomato' ),
					'type' => 'heading',
					'icon' => 'general',
					'slug' => 'spyropress_layout'
				),
				array(
					'name'    => esc_html__( 'Select a Layout', 'tomato' ),
					'id'      => '_builder_template',
					'type'    => 'select',
					'options' => $layout_tree
				)
			);

			$posts = array_merge( $this->enabled_post_types, array_keys( $spyropress->
			custom_post_types ) );
			foreach ( $posts as $post_type ) {
				if ( $post_type != 'template' ) {
					if ( ! key_exists( $post_type, $spyropress->custom_post_types ) ) {
						$page_builder                                = new SpyropressCustomPostType( $post_type, $post_type );
						$spyropress->custom_post_types[ $post_type ] = $page_builder;
					} else {
						$page_builder = $spyropress->custom_post_types[ $post_type ];
					}
					$page_builder->add_cpt_meta_box(
						esc_html__( 'SpyroPress: Layout Selection', 'tomato' ),
						'', $layout_meta, array(
							'build_tabs' => false,
							'context'    => 'side',
							'priority'   => 'high'
						)
					);
				}
			}
		}

		function get_data( $post_id ) {
			return get_post_meta( $post_id, $this->builder_meta_key, true );
		}

		function save_data( $post_id, $builder_data ) {
			return update_post_meta( $post_id, $this->builder_meta_key, $builder_data );
		}

		function delete_data( $post_id ) {
			return delete_post_meta( $post_id, $this->builder_meta_key );
		}
	}

	/**
	 * Init SpyropressBuilder class
	 */

	$GLOBALS['spyropress_builder'] = new SpyropressBuilder();
}

?>