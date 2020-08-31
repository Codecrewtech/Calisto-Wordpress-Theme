<?php
$framework = wp_is_writable( framework_path() );
$assets = wp_is_writable( template_path() . 'assets/css/' );

$status = ( $framework && $assets ) ? '<span class="badge-success">' . esc_html__( 'OK', 'tomato' ) . '</span>' : '<span class="badge-error">' . esc_html__( 'ERROR', 'tomato' ) . '</span>';
$writable_msg = '<span class="badge-success">' . esc_html__( 'Writable', 'tomato' ) . '</span>';
$not_writable_msg = '<span class="badge-error">' . esc_html__( 'Not Writable', 'tomato' ) . '</span>';
?>
<h3>
	<?php _e( 'System Status! ', 'tomato' ); echo ''.$status; ?>
</h3>
<br />
<div class="row-fluid">
    <div class="span2"><strong><?php _e( 'Framework Directory:', 'tomato' ) ?></strong></div>
    <div class="span6"><?php echo framework_path(); ?></div>
    <div class="span2"><?php echo ( ''.$framework ) ? $writable_msg : $not_writable_msg; ?></div>
</div>
<div class="row-fluid">
    <div class="span2"><strong><?php _e( 'CSS Directory:', 'tomato' ) ?></strong></div>
    <div class="span6"><?php echo template_path() . 'assets/css/'; ?></div>
    <div class="span2"><?php echo ( ''.$assets ) ? $writable_msg : $not_writable_msg; ?></div>
</div>
<br />