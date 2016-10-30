<?php
/**
 * Function and hooks
 */

load_theme_textdomain( 'jaiko', get_stylesheet_directory() . '/languages' );

add_action( 'init', function () {
	wp_register_style( 'twentysixteen-default', get_template_directory_uri() . '/style.css', [], wp_get_theme( 'twentysixteen' )->get( 'Version' ) );
	wp_register_style( 'twentysixteen-style', get_stylesheet_directory_uri() . '/assets/css/style.css', [ 'twentysixteen-default' ], wp_get_theme()->get( 'Version' ) );
} );

/**
 * Echo Google analytics tag
 */
add_action( 'wp_head', function () {
	?>
	<script>
		(function (i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		<?php if ( is_user_logged_in() ) : ?>
		ga('set', 'userId', <?= get_current_user_id() ?>);
		<?php endif; ?>
		ga('create', 'UA-1766751-11', 'auto');
		ga('send', 'pageview');

	</script>
	<?php
}, 99 );


add_action( 'init', function() {
	register_taxonomy( 'plugin', [ 'post' ], [
		'label'        => __( 'Plugins', 'jaiko' ),
		'hierarchical' => true,
		'public'       => true,
		'rewrite'      => [
			'slug'         => 'plugin',
			'with_front'   => false,
			'hierarchical' => true,
		],
	] );
} );
