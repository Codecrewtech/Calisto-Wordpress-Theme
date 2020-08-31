<?php

/**
 * SpyroPress Builder AJAX Functions
 *
 * Functions available for ajax request from builder.
 *
 * @package		Spyropress
 * @category	Builder
 * @author		SpyroSol
 */

/** Hooks *******************************/

    add_action( 'wp_ajax_builder_do_action', 'builder_do_action' );
    
/** Functions *******************************/

/**
 * Builder AJAX Request Handler
 */
function builder_do_action() {
    global $spyropress_builder;

    // Variables
    $prefix = 'builder_';
    $fn = $prefix . $_POST['func'];
    $args = $_POST['args'];
    $builder_data = $spyropress_builder->get_data( $args['post_id'] );
 
    /** Call builder function
     * @param array $args
     * @param array $builder_data from post meta
     **/
    if(!is_array($builder_data))
        $builder_data = [];
    $json = call_user_func_array( $fn, array( $args, $builder_data ) );
    // Echo JSON data
    echo json_encode( $json );

    die();
}

/**
 * Reset Build
 */
function builder_reset_builder( $args, $builder_data ) {
    global $spyropress_builder;

    extract( $args );

    /* Deleting data if exists */
    if ( ! empty( $builder_data ) ) {

        /* Deleting data */
        $result = $spyropress_builder->delete_data( $post_id );

        /* Generate json data */
        $json['success'] = ( $result ) ? true : false;
        $json['message'] = ( $result ) ? esc_html__( 'Builder Data Reset', 'tomato' ) : esc_html__( 'Operation fails.', 'tomato' );
        $json['html'] = ( $result ) ? esc_html__( 'Builder data reset successfully.', 'tomato' ) :
            esc_html__( 'Oops! something goes wrong while resetting builder data.', 'tomato' );

        return $json;
    }
    /* If no data */
    else {
        /* Generate json data */
        $json['success'] = false;
        $json['message'] = esc_html__( 'No Builder Data', 'tomato' );
        $json['html'] = 'No Builder Data for post: ' . $post_id . '.';

        return $json;
    }
}
?>