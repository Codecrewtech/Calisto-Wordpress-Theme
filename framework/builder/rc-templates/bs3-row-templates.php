<?php

/**
 * SpyroPress Builder
 * Default builder row types
 *
 * @author 		SpyroSol
 * @category 	Builder
 * @package 	Spyropress
 */

/**
 * One Column Row
 */
class one_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/1', 'tomato' ),
            'description' => esc_html__( 'Full width', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/1col.png' ),
            'columns' => array(
                array( 'type' => 'col_11' )
            )
        );
    }
}
spyropress_builder_register_row( 'one_col_row_class' );

/**
 * Two Column Row
 */
class two_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/2', 'tomato' ),
            'description' => esc_html__( '2 1/2 columns', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/2col.png' ),
            'columns' => array(
                array( 'type' => 'col_12' ),
                array( 'type' => 'col_12' )
            )
        );
    }
}
spyropress_builder_register_row( 'two_col_row_class' );

/**
 * Three Column Row
 */
class three_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/4', 'tomato' ),
            'description' => esc_html__( '3 1/4 columns', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/3col.png' ),
            'columns' => array(
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_13' )
            )
        );
    }
}
spyropress_builder_register_row( 'three_col_row_class' );

/**
 * Four Column Row
 */
class four_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/3', 'tomato' ),
            'description' => esc_html__( '4 1/3 columns', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/4col.png' ),
            'columns' => array(
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_14' )
            )
        );
    }
}
spyropress_builder_register_row( 'four_col_row_class' );

/**
 * Six Column Row
 */
class six_col_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/2', 'tomato' ),
            'description' => esc_html__( '6 1/6 columns', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/6col.png' ),
            'columns' => array(
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' ),
                array( 'type' => 'col_16' )
            )
        );
    }
}
spyropress_builder_register_row( 'six_col_row_class' );

/**
 * Left Sidebar Row
 */
class left_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/3 Left Sidebar', 'tomato' ),
            'description' => esc_html__( '1/3 + 2/3', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/left-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_13' ),
                array( 'type' => 'col_23' )
            )
        );
    }
}
spyropress_builder_register_row( 'left_sidebar_row_class' );

/**
 * Right Sidebar Row
 */
class right_sidebar_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/3 Right Sidebar', 'tomato' ),
            'description' => esc_html__( '2/3 + 1/3', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/right-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_23' ),
                array( 'type' => 'col_13' )
            )
        );
    }
}
spyropress_builder_register_row( 'right_sidebar_row_class' );

/**
 * Left Sidebar 2 Row
 */
class left_sidebar2_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/4 Left Sidebar', 'tomato' ),
            'description' => esc_html__( '1/4 + 3/4', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/left-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_14' ),
                array( 'type' => 'col_34' )
            )
        );
    }
}
spyropress_builder_register_row( 'left_sidebar2_row_class' );

/**
 * Right Sidebar2 Row
 */
class right_sidebar2_row_class extends SpyropressBuilderRow {

    public function __construct() {

        $this->config = array(
            'name' => esc_html__( '1/4 Right Sidebar', 'tomato' ),
            'description' => esc_html__( '3/4 + 1/4', 'tomato' ),
            'icon' => get_panel_img_path( 'layouts/right-sidebar.png' ),
            'columns' => array(
                array( 'type' => 'col_34' ),
                array( 'type' => 'col_14' )
            )
        );
    }
}
spyropress_builder_register_row( 'right_sidebar2_row_class' );

?>