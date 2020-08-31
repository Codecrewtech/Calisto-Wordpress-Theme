<?php
echo wp_kses_post( $before_widget );
    echo apply_filters( 'the_content', $rich_text );
echo wp_kses_post( $after_widget );