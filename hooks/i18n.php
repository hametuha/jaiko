<?php

// Register theme domain
load_theme_textdomain( 'jaiko', get_stylesheet_directory() . '/languages' );

/**
 * Add translation support
 *
 * @param array $post_types
 */
add_filter( 'bogo_localizable_post_types', function( $post_types ){
	$post_types[] = 'add-on';
	$post_types[] = 'announce';
	return $post_types;
} );
