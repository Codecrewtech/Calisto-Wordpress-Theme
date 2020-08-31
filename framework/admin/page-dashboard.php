<?php

/**
 * SpyroPress Dashboard
 *
 * Dashboard contains Latest News, Theme Info, Lates Tweets, etc.
 *
 */

global $spyropress;
?>

<div class="wrap spyropress-wrap">
	
    <?php get_spyropress_badge(); ?>
    <h1><?php echo ''.$spyropress->theme_name.' '.esc_html__( 'Dashboard', 'tomato' ); ?></h1>
    <div class="teaser-text">
		<?php _e( 'Thank you for using ThemeSquared. ThemeSquared will improve your overall web publishing experience.', 'tomato' ); ?>
	</div>
	<div class="clear"></div>
	<div id="dashboard-widgets" class="metabox-holder columns-2">
		<div id="postbox-container-1" class="postbox-container">
			<div id="dashboard_theme_info" class="postbox">
				<h3 class="hndle">
                    <?php _e( 'Theme Info', 'tomato'); ?>
				</h3>
				<div class="inside">
					<ul>
						<li>
							<?php _e( 'Framework Version:', 'tomato'); ?>
							<strong>
								<?php echo spyropress_get_version(); ?>
							</strong>
						</li>
                        <li>
							<?php _e( 'Product Version:', 'tomato'); ?>
							<strong>
								<?php echo ''.$spyropress->theme_version; ?>
							</strong>
						</li>
						<li>
							<?php _e( 'Product Support:', 'tomato'); ?>
							<?php get_support_forum_link(); ?>
						</li>
					</ul>
					<br class="clear"/>
				</div>
			</div>
		</div>
		<div id="postbox-container-2" class="postbox-container">
			<div id="dashboard_spyropress_changelog" class="postbox">
				<h3 class="hndle">
					<?php _e( 'Theme Changelog', 'tomato'); ?>
				</h3>
				<div class="inside">

 <p><b>Version 1.0.2</b></br>
                            	&nbsp;&nbsp;&nbsp;<b>Bug Removed</b></br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ( 1 Click Demo issue Fix )<br />
			</p><hr/>
                        </p> 

 <p><b>Version 1.0.1</b></br>
                            	&nbsp;&nbsp;&nbsp;<b>Bug Removed</b></br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ( Import Issue )<br />
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ( Plugins Updated )
			</p><hr/>
                        </p>						

<br class="clear"/><p><b>Initial Version 1.0.0</b></br>
                                &nbsp;&nbsp;&nbsp;<b>Theme Released</b>
				</p><br class="clear"/>
				</div>
			</div>
		</div>
		<div class="clear">
		</div>
	</div>
</div>