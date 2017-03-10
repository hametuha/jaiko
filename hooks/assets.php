<?php


// Set thumbnail size
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1200, 9999 );

/**
 * Regsiter content width
 */
add_action( 'after_setup_theme', function () {
	$GLOBALS['content_width'] = 840;
}, 0 );

/**
 * Register scripts
 */
add_action( 'init', function () {
	// Material Design Icons
	wp_register_style( 'material-design-icon', 'https://fonts.googleapis.com/icon?family=Material+Icons', [], null );
	// Typekit
	wp_register_script( 'typekit', 'https://use.typekit.net/lro6chq.js', [], null, true );
	wp_add_inline_script( 'typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
	// Material Desgin js
	wp_register_script( 'materialize', get_template_directory_uri() . '/assets/js/materialize.min.js', [ 'jquery' ], '0.97.8', true );
	// Default style
	wp_register_style( 'jaiko', get_stylesheet_directory_uri() . '/assets/css/style.css', [
		'material-design-icon',
		'dashicons',
	], wp_get_theme()->get( 'Version' ) );
	wp_register_script( 'jquery-match-height', get_stylesheet_directory_uri() . '/assets/js/jquery.matchHeight-min.js', [ 'jquery' ], '1.0.1', true );
	// Default script
	wp_register_script( 'jaiko', get_stylesheet_directory_uri() . '/assets/js/jaiko.js', [ 'jquery-match-height', 'materialize' ], wp_get_theme()->get( 'Version' ), true );
} );

// Register style
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'jaiko' );
	wp_enqueue_script( 'typekit' );
	wp_enqueue_style( 'jaiko' );
	if ( is_singular() && post_type_supports( get_queried_object()->post_type, 'comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}, 11 );


/**
 * Remove default style for Mikkai
 */
add_action( 'template_redirect', function () {
	if ( 'message' == get_query_var( 'mikkai_action' ) ) {
		remove_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );
	}
}, 1 );

add_action( 'wp_footer', function () {
	?>
	<script>
		jQuery(document).ready(function ($) {
			$('.bogo-language-switcher li').each(function (index, li) {
				if (!$(li).hasClass('current')) {
					var $link = $(li).find('a');
					if (!$link.length) {
						$(li).addClass('no-translation');
					} else {
						var curLang = $link.text();
						if ( $(li).hasClass('ja') ) {
							$link.text( curLang + '版あり' );
						} else {
							$link.text( curLang + ' available.');
						}
					}
				}

			});
		});
	</script>
	<?php
}, 11 );
