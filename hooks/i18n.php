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


add_filter( 'bogo_language_switcher_links', function( $links ) {
	$new_links = [];
	foreach ( $links as $link ) {
		if ( 'en_US' == $link['locale'] ) {
			$link['title'] = 'English';
			$link['native_name'] = 'English';
		}
		$new_links[] = $link;
	}
	return $new_links;
} );
