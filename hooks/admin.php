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


add_filter( 'user_contactmethods', function( $methods ) {
	$methods['twitter'] = __( 'Twitter Account', 'jaiko' );
	$methods['facebook'] = __( 'Facebook Page URL', 'jaiko' );
	return $methods;
} );
