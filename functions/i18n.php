<?php


/**
 * Get no translation string
 *
 * @param null|int|WP_Post $post
 *
 * @return string
 */
function jaiko_no_translation( $post = null ) {
	if ( ! function_exists( 'bogo_get_post_translations' ) ) {
		return '';
	}
	$translations = bogo_get_post_translations( get_post( $post ) );
	if ( 'ja' == get_locale() ) {
		$locale = 'en_US';
		$label  = 'This post is written only in Japanese. If you want read it in English, please leave a <a href="#respond">translation request.</a>';
	} else {
		$locale = 'ja';
		$label  = 'この記事は英語のみ提供されています。日本語化のリクエストは<a href="#respond">コメントでお願いします</a>。';
	}
	if ( isset( $translations[ $locale ] ) ) {
		return '';
	} else {
		return $label;
	}
}
