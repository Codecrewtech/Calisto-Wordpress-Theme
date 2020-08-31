<?php
//check
if ( empty( $spyropress_lists ) )return;

//Module Contents.
echo '<p class="list '. esc_attr( $spyropress_list_style ) .'">';
    foreach ( $spyropress_lists as $spyropress_list ){
        //fontawsome Icon.
        $spyropress_icon = isset( $spyropress_list['spyropress_icon'] )? '<i class="fa '. esc_attr( $spyropress_list['spyropress_icon'] ) .'"></i> ' : '';
        echo '<span>'.  wp_kses( $spyropress_icon, array( 'i' => array( 'class' => array() ) ) ) . esc_html( $spyropress_list['spyropress_item'] ) . '</span>';
    }
echo '<p>';