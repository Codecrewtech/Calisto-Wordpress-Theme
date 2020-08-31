<div class="builder-sections">
    <div class="toggle_set">
        <div class="section section-subheading toggle_trigger section-full">
            <label class="heading"><?php _e( 'Module Extras:', 'tomato' );?></label>                
            <span class="toggle_icon">[+]</span>
        </div>
        <div class="toggle_container">
            <div class="row-fluid">
                <div class="<?php echo esc_attr( get_admin_column_class(2)); ?>">
                    <div class="section section-text section-full">
                        <label class="heading"><?php _e( 'Container ID','tomato' ); ?> </label>
                        <div class="controls">
                            <input class="field" type="text" id="<?php echo esc_attr($widget->get_field_id( 'custom_container_id' ) )?>" name="<?php echo esc_attr( $widget->get_field_name( 'custom_container_id' ) ); ?>" value="<?php echo esc_attr( $custom_container_id);?>" />
                        </div>
                        <div class="description"><?php _e( 'The ID that is applied to the container.', 'tomato' );?></div>
                    </div>
                    </div>
                <div class="<?php echo get_admin_column_class(2); ?>">
                    <div class="section section-text section-full">
                        <label class="heading"><?php _e( 'Container Class','tomato' ); ?> </label>
                        <div class="controls">
                            <input class="field" type="text" id="<?php echo esc_attr( $widget->get_field_id( 'custom_container_class' ));?>" name="<?php echo esc_attr( $widget->get_field_name( 'custom_container_class' ));?>" type="text" value="<?php echo esc_attr( $custom_container_class );?>" />
                        </div>
                        <div class="description"><?php _e( 'The CssClass that is applied to the container.', 'tomato' );?></div>
                    </div>
                </div>
            </div>
            <?php if( isset( $widget->show_custom_css ) && $widget->show_custom_css ) : ?>
            <div class="section section-textarea section-full">
                <div class="controls">
                    <textarea class="field" id="<?php echo esc_attr( $widget->get_field_id( 'row_custom_css' ));?>" name="<?php echo esc_attr( $widget->get_field_name( 'row_custom_css' ));?>" rows="15"><?php echo esc_attr( $row_custom_css );?></textarea>
                </div>
                <div class="description">Token Available: {row_id}, {row_class}</div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="clear"></div>