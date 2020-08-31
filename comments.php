<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) return;
    
    //Translation Option
    $spyropress_translate['comment'] = get_setting( 'translate' ) ? get_setting( 'translate-comment', 'Comment' ) : esc_html__( 'Comment', 'tomato' );
    $spyropress_translate['comments'] = get_setting( 'translate' ) ? get_setting( 'translate-comments', 'Comments' ) : esc_html__( 'Comments', 'tomato' );
    $spyropress_translate['comments-off'] = get_setting( 'translate' ) ? get_setting( 'translate-comments-off', 'Comments are closed.' ) : esc_html__( 'Comments are closed.', 'tomato' );

?>

<div class="comments-area">
<?php if ( ! comments_open() ) { echo '<p class="no-comments">' . esc_html( $spyropress_translate['comments-off'] ) . '</p>'; } ?>
	<?php if ( have_comments() ) { ?>
        <h3>
		 <?php
            $num_comments = get_comments_number();
            if( $num_comments != 1 )
                printf( '%1$s <span>( %2$s )</span> ', esc_html( $spyropress_translate['comments'] ), number_format_i18n( $num_comments ) );
            else
                printf( '%1$s <span>( %2$s )</span> ', esc_html( $spyropress_translate['comment'] ), number_format_i18n( $num_comments ) );
        ?>
		</h3>

		<ul class="commentlist">
			<?php
				wp_list_comments( array(
					'format'      => 'html5',
					'short_ping'  => true,
                    'callback' => 'spyropress_comment'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'tomato' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'tomato' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'tomato' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

	<?php
        }
    ?>

    <div id="respond" class="comment-respond">
        <?php
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
            $spyropress_fields = array();
            $spyropress_fields['author'] = '<div class="row"><div class="col-md-6"><input id="author" name="author" type="text" class="text" placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />';
            $spyropress_fields['email'] = '<input id="email" name="email" type="text" class="text" placeholder="Email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />';
            $spyropress_fields['url'] = '<input id="url" name="url" type="text" class="text" placeholder="Website" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>';
            $spyropress_fields['cookies'] = '<div class="col-md-12"><p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                             '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'tomato' ) . '</label></p></div>'; 
            
            $spyropress_class = ( is_user_logged_in() )? 'col-md-12' : 'col-md-6';
            $spyropress_start_tag = ( is_user_logged_in() )? '<div class="row">' : '';
            
            $spyropress_args = array(
                'fields' => $spyropress_fields,
                'comment_field' => $spyropress_start_tag.'<div class="'. esc_attr( $spyropress_class ) .'"><textarea id="comment" name="comment" class="text textarea" placeholder="Message"></textarea></div>',
                'format' => 'html5',
                'label_submit' => esc_html__( 'Post Comment', 'tomato' ), 
                'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'tomato' ) . '</p>',
                'comment_notes_after' => ''
            );
        
            ob_start();
            comment_form( $spyropress_args );
            $spyropress_comment_form = ob_get_clean();
        
            $spyropress_comment_form = str_replace( '<p class="form-submit">', '<p class="col-md-12">', $spyropress_comment_form );
            $spyropress_comment_form = str_replace( 'class="submit"', 'class="btn btn-default btn-block"', $spyropress_comment_form );
        
            print(''.$spyropress_comment_form);
        ?>
    </div>
</div>