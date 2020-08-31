<?php
/**
 * Override WooCommerce default widgets for the markup
 */

//check plugin activation. 
if(!class_exists('WooCommerce') || !function_exists('register_cpt_widget')) return;

class Spyropress_WC_Widget_Product_Tag_Cloud extends WC_Widget_Product_Tag_Cloud {

    public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_tag_cloud';
		$this->widget_description = __( 'Your most used product tags in cloud format.', 'tomato' );
		$this->widget_id          = 'woocommerce_product_tag_cloud';
		$this->widget_name        = __( 'WooCommerce Product Tags', 'tomato' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Product Tags', 'tomato' ),
				'label' => __( 'Title', 'tomato' )
			)
		);
		WC_Widget::__construct();
	}
    
    public function widget( $args, $instance ) {

  		extract( $args );

		$current_taxonomy = $this->get_current_taxonomy($instance);

		if ( empty( $instance['title'] ) ) {
			$tax   = get_taxonomy( $current_taxonomy );
			$title = apply_filters( 'widget_title', $tax->labels->name, $instance, $this->id_base );
		} else {
			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		}

		echo wp_kses_post( $before_widget );

		if ( $title )
			echo wp_kses_post( $before_title . $title . $after_title );
        echo '<div class="tagcloud">';
    		wp_tag_cloud( apply_filters( 'woocommerce_product_tag_cloud_widget_args', array(
                'taxonomy' => $current_taxonomy,
                'unit' => 'px',
                'largest' => 12,
                'smallest' => 12
            ) ) );
        echo '</div>';

        

        echo wp_kses_post( $after_widget );

	}
}
register_cpt_widget( 'Spyropress_WC_Widget_Product_Tag_Cloud' );

class Spyropress_WC_Widget_Top_Rated_Products extends WC_Widget_Top_Rated_Products {

	public function widget($args, $instance) {
        
		//if ( $this->get_cached_widget( $args ) || !function_exists('remove_cpt_filter'))
        if (!function_exists('remove_cpt_filter')) return;

		ob_start();
		extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number = absint( $instance['number'] );

		add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );

		$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = WC()->query->get_meta_query();

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {

			echo wp_kses_post( $before_widget );

			if ( $title )
				echo wp_kses_post( $before_title . $title . $after_title );

			echo '<ul class="recent-products">';

			while ( $r->have_posts() ) {
				$r->the_post();
				wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) );
			}

			echo '</ul>';


		}

		remove_cpt_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );

		wp_reset_postdata();

		$content = ob_get_clean();

		echo tomato_html( $content );

		//$this->cache_widget( $args, $content );
	}
}
register_cpt_widget( 'Spyropress_WC_Widget_Top_Rated_Products' );

class Spyropress_Widget_Products extends WC_Widget_Products {

    public function widget( $args, $instance ) {

		//if ( $this->get_cached_widget( $args ) )
		//	return;

		ob_start();
		extract( $args );

		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = absint( $instance['number'] );
		$show        = sanitize_title( $instance['show'] );
		$orderby     = sanitize_title( $instance['orderby'] );
		$order       = sanitize_title( $instance['order'] );
		$show_rating = false;

    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'no_found_rows'  => 1,
    		'order'          => $order == 'asc' ? 'asc' : 'desc'
    	);

    	$query_args['meta_query'] = array();

    	if ( empty( $instance['show_hidden'] ) ) {
			$query_args['meta_query'][] = WC()->query->visibility_meta_query();
			$query_args['post_parent']  = 0;
		}

		if ( ! empty( $instance['hide_free'] ) ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}

	    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	    $query_args['meta_query']   = array_filter( $query_args['meta_query'] );

    	switch ( $show ) {
    		case 'featured' :
    			$query_args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
    			break;
    		case 'onsale' :
    			$product_ids_on_sale = wc_get_product_ids_on_sale();
				$product_ids_on_sale[] = 0;
				$query_args['post__in'] = $product_ids_on_sale;
    			break;
    	}

    	switch ( $orderby ) {
			case 'price' :
				$query_args['meta_key'] = '_price';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			case 'rand' :
    			$query_args['orderby']  = 'rand';
				break;
			case 'sales' :
				$query_args['meta_key'] = 'total_sales';
    			$query_args['orderby']  = 'meta_value_num';
				break;
			default :
				$query_args['orderby']  = 'date';
    	}

		$r = new WP_Query( $query_args );

		if ( $r->have_posts() ) {

			echo wp_kses_post( $before_widget );

			if ( $title )
				echo wp_kses_post( $before_title . $title . $after_title );

			echo '<ul class="recent-products">';

			while ( $r->have_posts()) {
				$r->the_post();
				wc_get_template( 'content-widget-product.php', array( 'show_rating' => $show_rating ) );
			}

			echo '</ul>';

			echo wp_kses_post( $after_widget );
		}

		wp_reset_postdata();

		$content = ob_get_clean();

		echo tomato_html( $content );

		//$this->cache_widget( $args, $content );
	}
}
register_cpt_widget( 'Spyropress_Widget_Products' );

class Spyropress_WC_Widget_Recently_Viewed extends WC_Widget_Recently_Viewed {

    function widget($args, $instance) {

		$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
		$viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

		if ( empty( $viewed_products ) )
			return;

		ob_start();
		extract( $args );

		$title  = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number = absint( $instance['number'] );

	    $query_args = array( 'posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'post__in' => $viewed_products, 'orderby' => 'rand' );

		$query_args['meta_query'] = array();
	    $query_args['meta_query'][] = WC()->query->stock_status_meta_query();
	    $query_args['meta_query'] = array_filter( $query_args['meta_query'] );

		$r = new WP_Query($query_args);

		if ( $r->have_posts() ) {

			echo wp_kses_post( $before_widget );

			if ( $title )
				echo wp_kses_post( $before_title . $title . $after_title );

			echo '<ul class="recent-products">';

			while ( $r->have_posts()) {
				$r->the_post();
				wc_get_template( 'content-widget-product.php' );
			}

			echo '</ul>';

			echo wp_kses_post( $after_widget );
		}

		wp_reset_postdata();

		$content = ob_get_clean();

		echo tomato_html( $content );
	}  

}
register_cpt_widget( 'Spyropress_WC_Widget_Recently_Viewed' );


class Spyropress_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews {

    public function widget( $args, $instance ) {
		global $comments, $comment, $woocommerce;
		////if ( $this->get_cached_widget( $args ) )
		//	//return;
		ob_start();
		extract( $args );
		$title    = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number   = absint( $instance['number'] );
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );
		if ( $comments ) {
			echo wp_kses_post( $before_widget );
			if ( $title ) echo wp_kses_post( $before_title . $title . $after_title );
			echo '<ul class="recent-products">';
			foreach ( (array) $comments as $comment ) {
				$_product = wc_get_product( $comment->comment_post_ID );
				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
				$rating_html = wc_get_rating_html( $_product->get_average_rating() );  //$_product->get_rating_html( $rating );
                ?>
                <li>
                    <?php echo str_replace( 'wp-post-image', 'img-responsive', $_product->get_image() ); ?>
                    <div class="rpp-info">
                        <a href="<?php echo esc_url( get_permalink( $comment->comment_ID ) ); ?>"><?php echo wp_kses_post( $_product->get_title() ); ?></a>
                        <?php echo tomato_html( $rating_html ); ?>
                        <span><?php echo sprintf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'tomato' ) . '</span>', get_comment_author() ); ?></span>
                    </div>
                </li>
                <?php
			}
			echo '</ul>';
			echo wp_kses_post( $after_widget );
		}
		$content = ob_get_clean();
		echo tomato_html( $content );
		////$this->cache_widget( $args, $content );
	}
}
register_cpt_widget( 'Spyropress_WC_Widget_Recent_Reviews' );

class Spyropress_WC_Widget_Layered_Nav extends WC_Widget_Layered_Nav {

    public function widget( $args, $instance ) {
		global $_chosen_attributes;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
			return;

		$current_term 	= is_tax() ? get_queried_object()->term_id : '';
		$current_tax 	= is_tax() ? get_queried_object()->taxonomy : '';
		$title 			= apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$taxonomy 		= isset( $instance['attribute'] ) ? wc_attribute_taxonomy_name($instance['attribute']) : '';
		$query_type 	= isset( $instance['query_type'] ) ? $instance['query_type'] : 'and';
		$display_type 	= isset( $instance['display_type'] ) ? $instance['display_type'] : 'list';

		if ( ! taxonomy_exists( $taxonomy ) )
			return;

	    $get_terms_args = array( 'hide_empty' => '1' );

		$orderby = wc_attribute_orderby( $taxonomy );

		switch ( $orderby ) {
			case 'name' :
				$get_terms_args['orderby']    = 'name';
				$get_terms_args['menu_order'] = false;
			break;
			case 'id' :
				$get_terms_args['orderby']    = 'id';
				$get_terms_args['order']      = 'ASC';
				$get_terms_args['menu_order'] = false;
			break;
			case 'menu_order' :
				$get_terms_args['menu_order'] = 'ASC';
			break;
		}

		$terms = get_terms( $taxonomy, $get_terms_args );

		if ( count( $terms ) > 0 ) {

			ob_start();

			$found = false;

			echo wp_kses_post( $before_widget . $before_title . $title . $after_title );

			// Force found when option is selected - do not force found on taxonomy attributes
			if ( ! is_tax() && is_array( $_chosen_attributes ) && array_key_exists( $taxonomy, $_chosen_attributes ) )
				$found = true;

			if ( $display_type == 'dropdown' ) {

				// skip when viewing the taxonomy
				if ( $current_tax && $taxonomy == $current_tax ) {

					$found = false;

				} else {

					$taxonomy_filter = str_replace( 'pa_', '', $taxonomy );

					$found = false;

					echo '<select id="dropdown_layered_nav_' . $taxonomy_filter . '">';

					echo '<option value="">' . sprintf( esc_html__( 'Any %s', 'tomato' ), wc_attribute_label( $taxonomy ) ) .'</option>';

					foreach ( $terms as $term ) {

						// If on a term page, skip that term in widget list
						if ( $term->term_id == $current_term )
							continue;

						// Get count based on current view - uses transients
						$transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_id ) );

						if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

							$_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

							set_transient( $transient_name, $_products_in_term, YEAR_IN_SECONDS );
						}

						$option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

						// If this is an AND query, only show options with count > 0
						if ( $query_type == 'and' ) {

							$count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

							if ( $count > 0 )
								$found = true;

							if ( $count == 0 && ! $option_is_set )
								continue;

						// If this is an OR query, show all options so search can be expanded
						} else {

							$count = sizeof( array_intersect( $_products_in_term, WC()->query->unfiltered_product_ids ) );

							if ( $count > 0 )
								$found = true;

						}

						echo '<option value="' . esc_attr( $term->term_id ) . '" '.selected( isset( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' .$taxonomy_filter ] : '' , $term->term_id, false ) . '>' . $term->name . '</option>';
					}

					echo '</select>';

					wc_enqueue_js("

						jQuery('#dropdown_layered_nav_$taxonomy_filter').change(function(){

							location.href = '" . esc_url_raw( preg_replace( '%\/page/[0-9]+%', '', add_query_arg('filtering', '1', remove_query_arg( array( 'page', 'filter_' . $taxonomy_filter ) ) ) ) ) . "&filter_$taxonomy_filter=' + jQuery('#dropdown_layered_nav_$taxonomy_filter').val();

						});

					");

				}

			} else {

				// List display
				echo "<ul class='recent-products'>";

				foreach ( $terms as $term ) {

					// Get count based on current view - uses transients
					$transient_name = 'wc_ln_count_' . md5( sanitize_key( $taxonomy ) . sanitize_key( $term->term_id ) );

					if ( false === ( $_products_in_term = get_transient( $transient_name ) ) ) {

						$_products_in_term = get_objects_in_term( $term->term_id, $taxonomy );

						set_transient( $transient_name, $_products_in_term );
					}

					$option_is_set = ( isset( $_chosen_attributes[ $taxonomy ] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) );

					// skip the term for the current archive
					if ( $current_term == $term->term_id )
						continue;

					// If this is an AND query, only show options with count > 0
					if ( $query_type == 'and' ) {

						$count = sizeof( array_intersect( $_products_in_term, WC()->query->filtered_product_ids ) );

						if ( $count > 0 && $current_term !== $term->term_id )
							$found = true;

						if ( $count == 0 && ! $option_is_set )
							continue;

					// If this is an OR query, show all options so search can be expanded
					} else {

							$count = sizeof( array_intersect( $_products_in_term, WC()->query->unfiltered_product_ids ) );

							if ( $count > 0 )
								$found = true;

					}

					$arg = 'filter_' . sanitize_title( $instance['attribute'] );

					$current_filter = ( isset( $_GET[ $arg ] ) ) ? explode( ',', $_GET[ $arg ] ) : array();

					if ( ! is_array( $current_filter ) )
						$current_filter = array();

					$current_filter = array_map( 'esc_attr', $current_filter );

					if ( ! in_array( $term->term_id, $current_filter ) )
						$current_filter[] = $term->term_id;

					// Base Link decided by current page
					if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
						$link = home_url('/');
					} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
						$link = get_post_type_archive_link( 'product' );
					} else {
						$link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
					}

					// All current filters
					if ( $_chosen_attributes ) {
						foreach ( $_chosen_attributes as $name => $data ) {
							if ( $name !== $taxonomy ) {

								// Exclude query arg for current term archive term
								while ( in_array( $current_term, $data['terms'] ) ) {
									$key = array_search( $current_term, $data );
									unset( $data['terms'][$key] );
								}

								// Remove pa_ and sanitize
								$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );

								if ( ! empty( $data['terms'] ) )
									$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );

								if ( $data['query_type'] == 'or' )
									$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
							}
						}
					}

					// Min/Max
					if ( isset( $_GET['min_price'] ) )
						$link = add_query_arg( 'min_price', $_GET['min_price'], $link );

					if ( isset( $_GET['max_price'] ) )
						$link = add_query_arg( 'max_price', $_GET['max_price'], $link );

					// Orderby
					if ( isset( $_GET['orderby'] ) )
						$link = add_query_arg( 'orderby', $_GET['orderby'], $link );

					// Current Filter = this widget
					if ( isset( $_chosen_attributes[ $taxonomy ] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) {

						$class = 'class="chosen"';

						// Remove this term is $current_filter has more than 1 term filtered
						if ( sizeof( $current_filter ) > 1 ) {
							$current_filter_without_this = array_diff( $current_filter, array( $term->term_id ) );
							$link = add_query_arg( $arg, implode( ',', $current_filter_without_this ), $link );
						}

					} else {

						$class = '';
						$link = add_query_arg( $arg, implode( ',', $current_filter ), $link );

					}

					// Search Arg
					if ( get_search_query() )
						$link = add_query_arg( 's', get_search_query(), $link );

					// Post Type Arg
					if ( isset( $_GET['post_type'] ) )
						$link = add_query_arg( 'post_type', $_GET['post_type'], $link );

					// Query type Arg
					if ( $query_type == 'or' && ! ( sizeof( $current_filter ) == 1 && isset( $_chosen_attributes[ $taxonomy ]['terms'] ) && is_array( $_chosen_attributes[ $taxonomy ]['terms'] ) && in_array( $term->term_id, $_chosen_attributes[ $taxonomy ]['terms'] ) ) )
						$link = add_query_arg( 'query_type_' . sanitize_title( $instance['attribute'] ), 'or', $link );

					echo '<li ' . $class . '>';

					echo ( ''.$count > 0 || $option_is_set ) ? '<a href="' . esc_url( apply_filters( 'woocommerce_layered_nav_link', $link ) ) . '">' : '<span>';

					echo esc_html( $term->name );

                    echo ' <small class="count">(' . $count . ')</small>';

					echo ( ''.$count > 0 || $option_is_set ) ? '</a>' : '</span>';

					echo '</li>';

				}

				echo "</ul>";

			} // End display type conditional

			echo wp_kses_post( $after_widget );

			if ( ! $found )
				ob_end_clean();
			else
				echo ob_get_clean();
		}
	}
}
register_cpt_widget( 'Spyropress_WC_Widget_Layered_Nav' );

class Spyropress_Widget_Price_Filter extends WC_Widget_Price_Filter {
    
    /**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wp, $wp_the_query;

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) ) {
			return;
		}

		if ( ! $wp_the_query->post_count ) {
			return;
		}

		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : '';
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : '';

		wp_enqueue_script( 'wc-price-slider' );

		// Remember current filters/search
		$fields = '';

		if ( get_search_query() ) {
			$fields .= '<input type="hidden" name="s" value="' . get_search_query() . '" />';
		}

		if ( ! empty( $_GET['post_type'] ) ) {
			$fields .= '<input type="hidden" name="post_type" value="' . esc_attr( $_GET['post_type'] ) . '" />';
		}

		if ( ! empty ( $_GET['product_cat'] ) ) {
			$fields .= '<input type="hidden" name="product_cat" value="' . esc_attr( $_GET['product_cat'] ) . '" />';
		}

		if ( ! empty( $_GET['product_tag'] ) ) {
			$fields .= '<input type="hidden" name="product_tag" value="' . esc_attr( $_GET['product_tag'] ) . '" />';
		}

		if ( ! empty( $_GET['orderby'] ) ) {
			$fields .= '<input type="hidden" name="orderby" value="' . esc_attr( $_GET['orderby'] ) . '" />';
		}

		if ( ! empty( $_GET['min_rating'] ) ) {
			$fields .= '<input type="hidden" name="min_rating" value="' . esc_attr( $_GET['min_rating'] ) . '" />';
		}

		if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
			foreach ( $_chosen_attributes as $attribute => $data ) {
				$taxonomy_filter = 'filter_' . str_replace( 'pa_', '', $attribute );

				$fields .= '<input type="hidden" name="' . esc_attr( $taxonomy_filter ) . '" value="' . esc_attr( implode( ',', $data['terms'] ) ) . '" />';

				if ( 'or' == $data['query_type'] ) {
					$fields .= '<input type="hidden" name="' . esc_attr( str_replace( 'pa_', 'query_type_', $attribute ) ) . '" value="or" />';
				}
			}
		}

		// Find min and max price in current result set
		$prices = $this->get_filtered_price();
		$min    = floor( $prices->min_price );
		$max    = ceil( $prices->max_price );

		if ( $min === $max ) {
			return;
		}

		$this->widget_start( $args, $instance );

		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}

		/**
		 * Adjust max if the store taxes are not displayed how they are stored.
		 * Min is left alone because the product may not be taxable.
		 * Kicks in when prices excluding tax are displayed including tax.
		 */
		if ( wc_tax_enabled() && 'incl' === get_option( 'woocommerce_tax_display_shop' ) && ! wc_prices_include_tax() ) {
			$tax_classes = array_merge( array( '' ), WC_Tax::get_tax_classes() );
			$class_max   = $max;

			foreach ( $tax_classes as $tax_class ) {
				if ( $tax_rates = WC_Tax::get_rates( $tax_class ) ) {
					$class_max = $max + WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax( $max, $tax_rates ) );
				}
			}

			$max = $class_max;
		}

		echo '<form method="get" action="' . esc_url( $form_action ) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="' . esc_attr( $min_price ) . '" data-min="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_min_amount', $min ) ) . '" placeholder="' . esc_attr__( 'Min price', 'tomato' ) . '" />
					<input type="text" id="max_price" name="max_price" value="' . esc_attr( $max_price ) . '" data-max="' . esc_attr( apply_filters( 'woocommerce_price_filter_widget_max_amount', $max ) ) . '" placeholder="' . esc_attr__( 'Max price', 'tomato' ) . '" />
					<div class="price_label pull-right" style="display:none;">
						' . __( 'Price:', 'tomato' ) . ' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
                    <button type="submit" class="btn btn-default btn-sm">' . __( 'Filter', 'tomato' ) . '</button>
					' . $fields . '
					<div class="clear"></div>
				</div>
			</div>
		</form>';

		$this->widget_end( $args );
	}
}
register_cpt_widget( 'Spyropress_Widget_Price_Filter' );

class Spyropress_WC_Widget_Layered_Nav_Filters extends WC_Widget_Layered_Nav_Filters {


	public function widget( $args, $instance ) {
		global $_chosen_attributes, $woocommerce;

		extract( $args );

		if ( ! is_post_type_archive( 'product' ) && ! is_tax( get_object_taxonomies( 'product' ) ) )
			return;

		$current_term 	= is_tax() ? get_queried_object()->term_id : '';
		$current_tax 	= is_tax() ? get_queried_object()->taxonomy : '';
		$title          = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		// Price
		$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : 0;
		$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : 0;

		if ( count( $_chosen_attributes ) > 0 || $min_price > 0 || $max_price > 0 ) {

			echo wp_kses_post( $before_widget );
			if ( $title ) {
				echo wp_kses_post( $before_title . $title . $after_title );
			}

			echo '<ul class="recent-products">';

			// Attributes
			if (!is_null($_chosen_attributes)){
				foreach ( $_chosen_attributes as $taxonomy => $data ) {

					foreach ( $data['terms'] as $term_id ) {
						$term 				= get_term( $term_id, $taxonomy );
						$taxonomy_filter 	= str_replace( 'pa_', '', $taxonomy );
						$current_filter 	= ! empty( $_GET[ 'filter_' . $taxonomy_filter ] ) ? $_GET[ 'filter_' . $taxonomy_filter ] : '';
						$new_filter			= array_map( 'absint', explode( ',', $current_filter ) );
						$new_filter			= array_diff( $new_filter, array( $term_id ) );

						$link = remove_query_arg( 'filter_' . $taxonomy_filter );

						if ( sizeof( $new_filter ) > 0 )
							$link = add_query_arg( 'filter_' . $taxonomy_filter, implode( ',', $new_filter ), $link );

						echo '<li class="chosen"><a title="' . esc_html__( 'Remove filter', 'tomato' ) . '" href="' . esc_url( $link ) . '">' . $term->name . '</a></li>';
					}
				}
			}

			if ( $min_price ) {
				$link = remove_query_arg( 'min_price' );
				echo '<li class="chosen"><a title="' . esc_html__( 'Remove filter', 'tomato' ) . '" href="' . esc_url( $link ) . '">' . esc_html__( 'Min', 'tomato' ) . ' ' . wc_price( $min_price ) . '</a></li>';
			}

			if ( $max_price ) {
				$link = remove_query_arg( 'max_price' );
				echo '<li class="chosen"><a title="' . esc_html__( 'Remove filter', 'tomato' ) . '" href="' . esc_url( $link ) . '">' . esc_html__( 'Max', 'tomato' ) . ' ' . wc_price( $max_price ) . '</a></li>';
			}

			echo "</ul>";

			echo wp_kses_post( $after_widget );
		}
	}
}

register_cpt_widget( 'Spyropress_WC_Widget_Layered_Nav_Filters' );

class Spyropress_WC_Widget_Product_Categories extends WC_Widget_Product_Categories {
    /**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wp_query, $post;

		$c             = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
		$h             = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
		$s             = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
		$d             = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
		$o             = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
		$dropdown_args = array( 'hide_empty' => false );
		$list_args     = array( 'show_count' => $c, 'hierarchical' => $h, 'taxonomy' => 'product_cat', 'hide_empty' => false );

		// Menu Order
		$list_args['menu_order'] = false;
		if ( $o == 'order' ) {
			$list_args['menu_order'] = 'asc';
		} else {
			$list_args['orderby']    = 'title';
		}

		// Setup Current Category
		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if ( is_tax( 'product_cat' ) ) {

			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

		} elseif ( is_singular( 'product' ) ) {

			$product_category = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent' ) );

			if ( $product_category ) {
				$this->current_cat   = end( $product_category );
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			}

		}

		// Show Siblings and Children Only
		if ( $s && $this->current_cat ) {

			// Top level is needed
			$top_level = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => 0,
					'hierarchical' => true,
					'hide_empty'   => false
				)
			);

			// Direct children are wanted
			$direct_children = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => $this->current_cat->term_id,
					'hierarchical' => true,
					'hide_empty'   => false
				)
			);

			// Gather siblings of ancestors
			$siblings  = array();
			if ( $this->cat_ancestors ) {
				foreach ( $this->cat_ancestors as $ancestor ) {
					$ancestor_siblings = get_terms(
						'product_cat',
						array(
							'fields'       => 'ids',
							'parent'       => $ancestor,
							'hierarchical' => false,
							'hide_empty'   => false
						)
					);
					$siblings = array_merge( $siblings, $ancestor_siblings );
				}
			}

			if ( $h ) {
				$contents = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
			} else {
				$contents = array_merge( $direct_children );
			}

			$dropdown_args['include'] = implode( ',', $contents );
			$list_args['include']     = implode( ',', $contents );

			if ( empty( $contents ) ) {
				return;
			}

		} elseif ( $s ) {
			$dropdown_args['depth']        = 1;
			$dropdown_args['child_of']     = 0;
			$dropdown_args['hierarchical'] = 1;
			$list_args['depth']            = 1;
			$list_args['child_of']         = 0;
			$list_args['hierarchical']     = 1;
		}

		$this->widget_start( $args, $instance );

		// Dropdown
		if ( $d ) {
			$dropdown_defaults = array(
				'show_counts'        => $c,
				'hierarchical'       => $h,
				'show_uncategorized' => 0,
				'orderby'            => $o,
				'selected'           => $this->current_cat ? $this->current_cat->slug : ''
			);
			$dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

			// Stuck with this until a fix for http://core.trac.wordpress.org/ticket/13258
			wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );

			wc_enqueue_js( "
				jQuery( '.dropdown_product_cat' ).change( function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '" . esc_js( home_url( '/' ) ) . "';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_cat=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_cat=' + jQuery(this).val();
						}
						location.href = this_page;
					}
				});
			" );

		// List
		} else {

			require( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

			$list_args['walker']                     = new WC_Product_Cat_List_Walker;
			$list_args['title_li']                   = '';
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = __('No product categories exist.', 'tomato' );
			$list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$list_args['current_category_ancestors'] = $this->cat_ancestors;

			echo '<ul class="shop-cat">';

			     wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

			echo '</ul>';
		}

		$this->widget_end( $args );
	}
 }
 register_cpt_widget( 'Spyropress_WC_Widget_Product_Categories' );