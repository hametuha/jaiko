<?php


// RSS
add_theme_support( 'automatic-feed-links' );
// Title tag
add_theme_support( 'title-tag' );

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

/**
 * Add CSS body
 */
add_filter( 'body_class', function( $classes ){
	if ( 'ja' == get_locale() ) {
		$classes[] = 'lang-ja';
	} else {
		$classes[] = 'lang-en';
	}
	return $classes;
} );
