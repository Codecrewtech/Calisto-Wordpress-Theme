<?php

$is_content = post_type_supports( get_current_post_type(), 'editor' );
$editor_id = 'dummy_editor';
$builder_class = $wordpress_class = '';
if( spyropress_has_builder_content() || !$is_content ) {
    $builder_class = ' nav-tab-active';
    $show_welcome = false;
}
else {
    $wordpress_class = ' nav-tab-active';
    $show_welcome = true;
}

$show_welcome = true;

?>
<div id="builder" class="builder">
    <div id="builder-tabs">
        <h2 class="nav-tab-wrapper">
            <?php if ( $is_content ) { ?>
            <a href="#postdivrich" class="nav-tab<?php echo esc_attr(  $wordpress_class ); ?>">Wordpress</a>
            <?php } ?>
            <a href="#builder-data" class="nav-tab<?php echo esc_attr( $builder_class); ?>">Builder</a>
        </h2>
    </div>
    <div id="builder-data">
        <div class="builder-header">
            <h2>SpyroPress Builder</h2>
            <div class="builder-options" class="builder-hide">
                <a class="thide module-icon-options toggle-option-list" href="#builder-option-list">Builder Options</a>
                <ul id="builder-option-list">
                    <li>
                        <a id="reset-builder-data" href="#reset-builder">Reset Data</a>
                    </li>
                </ul>
            </div>
            <div id="builder-messages">
            </div>
            <div class="clear"></div>
        </div>
        <!-- /builder-header -->
        <div class="builder-content">
            <div class="drawer-wrapper" id="builder-row-select">
                <label>Content</label>
                <?php get_template_part( 'framework/builder/builder-ui', 'welcome' ); ?>
                <div id="builder-sortables-container">
                    <?php
                        if( isset($_GET['action']) && $_GET['action'] == 'edit' && $_GET['post'] != '') {
                            builder_render_backend_rows();
                        }
                    ?>
                </div>
                <!-- /builder-sortables-container -->
                <div id="rows-loader" class="rows-loader builder-hide"></div> 
                <!-- /rows-loader -->
            </div>
        </div>
        <!-- /builder-content -->
        <div class="builder-drawer" id="builder-rows">
            <div class="drawer-wrapper" id="builder-row-select">
                <label>Choose a Row Type</label>
                <?php spyropress_builder_render_rows(); ?>
                <div class="clear"></div>
            </div>
        </div>
        <!-- /builder-row-drawer -->
        <div class="builder-drawer" id="builder-columns-container">
            <div class="drawer-wrapper" id="builder-column-select">
                <label>Choose a Column Type</label>
                <?php spyropress_builder_render_columns(); ?>
                <div class="clear"></div>
            </div>
        </div>
        <!-- /builder-columns-drawer -->
        <div class="builder-footer">
            <a href="#builder-rows" id="builder-row-add" class="button-primary pull-right">New Row</a>
            <div class="clear"></div>
        </div>
        <!-- /builder-footer -->
        <?php get_template_part( 'framework/builder/builder-ui', 'dialogs' );  ?>
        <div id="builder-media-toolbar">
        <?php
        if(!$is_content && post_type_supports( get_current_post_type(), 'thumbnail' )) {
			print '<div id="wp-' . esc_attr( $editor_id ) . '-editor-tools" class="wp-editor-tools">';
                if ( !function_exists('media_buttons') )
                    load_template(ABSPATH . 'wp-admin/includes/media.php', false );
                
                print '<div id="wp-' . esc_attr( $editor_id ) . '-media-buttons" class="hide-if-no-js wp-media-buttons">';
                    do_action('media_buttons', $editor_id);
                echo "</div>\n";
            echo "</div>\n";
		}
        ?>
        </div>
        <!-- /builder-toolbar -->
    </div>
    <!-- /builder-data -->
</div>
<div class="hidden">
<?php wp_editor('',$editor_id); ?>
</div>