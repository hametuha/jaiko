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
