<?php


add_filter( 'comment_form_defaults', function ( $defaults ) {
	$defaults = array_merge( $defaults, [
		'comment_field' => '<div class="comment-form-comment input-field"><textarea id="comment" name="comment" class="materialize-textarea" maxlength="65525" aria-required="true" required="required"></textarea><label for="comment">' . _x( 'Comment', 'noun' ) . '</label></div>',
		'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn waves-effect" value="%4$s" />',
	] );

	return $defaults;
} );



add_filter( 'comment_class', function( $classes ){
	$classes[] = 'comment-list-item';
     return $classes;
} );

/**
 *
 */
add_filter( 'comment_text', function( $comment ){
	return sprintf( '<div class="comment-content">%s</div>', $comment );
} );