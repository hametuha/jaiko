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

	// Material Desgin js
	wp_register_script( 'materialize', get_template_directory_uri() . '/assets/js/materialize.min.js', [ 'jquery' ], '0.97.8', true );

	wp_register_style( 'jaiko', get_stylesheet_directory_uri() . '/assets/css/style.css', [
		'material-design-icon',
		'dashicons',
	], wp_get_theme()->get( 'Version' ) );
	wp_register_script( 'jaiko', get_stylesheet_directory_uri() . '/assets/js/jaiko.js', [ 'materialize' ], wp_get_theme()->get( 'Version' ), true );

} );

// Register style
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'jaiko' );
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
							$link.text( curLang + '版があります' );
						} else {
							$link.text('Also available in ' + curLang + '.');
						}
					}
				}
			});
		});
	</script>
	<?php
}, 11 );

/**
 * Load typekit
 */
add_action( 'wp_footer', function () {
	?>
	<script>
		(function (d) {
			var config                                                                 = {
				    kitId        : 'lro6chq',
				    scriptTimeout: 3000,
				    async        : true
			    },
			    h = d.documentElement, t = setTimeout(function () {
				    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
			    }, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a;
			h.className += " wf-loading";
			tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
			tk.async = true;
			tk.onload = tk.onreadystatechange = function () {
				a = this.readyState;
				if (f || a && a != "complete" && a != "loaded")return;
				f = true;
				clearTimeout(t);
				try {
					Typekit.load(config)
				} catch (e) {
				}
			};
			s.parentNode.insertBefore(tk, s)
		})(document);
	</script>
	<?php
}, 9999 );
