<div class="widget-sections">
    <div class="toggle_set">
        <div class="section section-subheading toggle_trigger section-full">
            <label class="heading"><?php _e( 'Widget Extras:', 'tomato' );?></label>                
            <span class="toggle_icon">[+]</span>
        </div>
        <div class="toggle_container">
            <div class="section section-text section-full">
                <label class="heading"><?php _e( 'Container ID','tomato' ); ?> </label>
                <div class="controls">
                    <input class="field" type="text" id="<?php echo esc_attr( $widget->get_field_id( 'custom_container_id')); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'custom_container_id' ) ); ?>" value="<?php echo esc_attr( $custom_container_id);?>" />
                </div>
                <div class="description"><?php _e( 'The ID that is applied to the container.', 'tomato' );?></div>
            </div>
            <div class="section section-text section-full">
                <label class="heading"><?php _e( 'Container Class','tomato' ); ?> </label>
                <div class="controls">
                    <input class="field" type="text" id="<?php echo esc_attr( $widget->get_field_id( 'custom_container_class' ) );?>" name="<?php echo esc_attr( $widget->get_field_name( 'custom_container_class' ) );?>" type="text" value="<?php echo esc_attr( $custom_container_class );?>" />
                </div>
                <div class="description"><?php _e( 'The CssClass that is applied to the container.', 'tomato' );?></div>
            </div>
            
            <div class="section section-select section-full">
                <label class="heading"><?php _e( 'Visibility', 'tomato' ); ?></label>
                <div class="controls">
                    <select class="chosen" name="<?php echo esc_attr( $widget->get_field_name( 'custom_action' ) );?>" id="<?php echo esc_attr( $widget->get_field_id( 'custom_action' ) );?>">
                        <option value="1"<?php selected( '1', $custom_action ); ?>><?php _e( 'Show', 'tomato' );?></option>
                        <option value="0"<?php selected( '0', $custom_action ); ?>><?php _e( 'Do NOT show', 'tomato' );?></option>
                    </select>
                </div>
                <label class="heading"><?php _e( 'On', 'tomato' ); ?></label>
                <div class="controls">
                    <select class="chosen" name="<?php echo esc_attr( $widget->get_field_name( 'custom_show' ) );?>" id="<?php echo esc_attr( $widget->get_field_id( 'custom_show' ) );?>">
                        <?php
                        if ( is_array( $this->conditions ) && !empty( $this->conditions ) ) {
                            foreach ( $this->conditions as $k => $item ) {
                                printf( '<option value="%1$s"%3$s>%2$s</option>', esc_attr( $k ), $item['name'], selected( $custom_show, $k )  );
                            }
                        }
                        ?>
                	</select>
                </div>
            </div>
            <div class="section section-text section-full">
                <label class="heading"><?php _e( 'Slug/Title/ID','tomato' ); ?> </label>
                <div class="controls">
                    <input class="field" type="text" id="<?php echo esc_attr( $widget->get_field_id( 'custom_slug' ));?>" name="<?php echo esc_attr( $widget->get_field_name( 'custom_slug' ) );?>" value="<?php print htmlspecialchars( $custom_slug ); ?>" />
                </div>
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" id="<?php echo esc_attr( $widget->get_field_name( 'suppress_title' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'suppress_title' ) ) ; ?>" value="1"<?php checked( $suppress_title, '1' );?> /> <?php _e( 'Remove Title from Output', 'tomato' ); ?>
                    </label>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>