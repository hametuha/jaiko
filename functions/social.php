<?php

/**
 * Get Facebook app id
 *
 * @return string
 */
function jaiko_fb_app_id() {
	return '983379265125123';
}

/**
 * Get facebook page id
 *
 * @return string
 */
function jaiko_fb_page_id() {
	return '1785292191708936';
}

/**
 * Return facebook article property
 *
 * @return string
 */
function jaiko_ogp_type() {
	if ( is_front_page() ) {
		return 'og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#';
	} else {
		return 'og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#';
	}
}

/**
 * Get image dimension
 *
 * @param string $url
 *
 * @return array
 */
function jaiko_image_dimension( $url ) {
	$none = [ 0, 0 ];
	$path = str_replace( trailingslashit( get_option( 'home' ) ), ABSPATH, $url );
	if ( ! file_exists( $path ) ) {
		return $none;
	}
	return getimagesize( $path ) ?: $none;
}
