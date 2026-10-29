<?php

add_editor_style( 'assets/css/editor-style.css' );

/**
 * Add style selector
 */
add_filter( 'tiny_mce_before_init', function ( $mce_array ) {

	$mce_array['style_formats'] = json_encode( [
		[
			'title' => __( 'aside', 'jaiko' ),
			'block' => 'aside',
		],
	] );

	return $mce_array;
}, 1000 );


add_filter( 'user_contactmethods', function ( $methods ) {
	$methods['twitter']  = __( 'Twitter Account', 'jaiko' );
	$methods['facebook'] = __( 'Facebook Page URL', 'jaiko' );
	return $methods;
} );

add_filter( 'login_headerurl', function () {
	return home_url();
} );

add_action( 'login_head', function () {
	?>
<style>
	.login-message{
		padding: 10px;
		text-align: center;
		font-weight: bold;
		color: #e20000;
	}
</style>
	<?php
} );

/**
 * Add login message
 */
add_filter( 'login_message', function ( $message ) {
	$string   = esc_html__( 'To create account, SNS account is required!', 'jaiko' );
	$message .= sprintf( '<div class="login-message">%s</div>', $string );
	return $message;
} );
