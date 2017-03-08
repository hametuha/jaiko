<?php


// RSS
add_theme_support( 'automatic-feed-links' );
// Title tag
add_theme_support( 'title-tag' );
// Stop jetpack
remove_action( 'wp_head', 'jetpack_og_tags' );



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

/**
 * Change title tag
 */
add_filter( 'document_title_parts', function( $title ) {
	if ( is_singular( 'add-on' ) ) {
		$new_title = [];
		foreach ( $title as $key => $val ) {
			$new_title[ $key ] = $val;
			if ( 'title' == $key ) {
				$new_title['plugin'] = __( 'WordPress Plugin', 'jaiko' );
			}
		}
		$title = $new_title;
	}
	return $title;
} );


add_action( 'wp_head', function() {
	if ( ! ( is_singular() || is_category() || is_tag() || is_tax() ) ) {
		return;
	}
	// Initial value
	$title   = wp_get_document_title();
	$image   = get_site_icon_url( 512 );
	$amp_img = $image;
	$excerpt = get_bloginfo( 'description' );
	$type    = 'article';
	$url     = '';
	$metas = [
		''   => [],
		'og' => [],
		'article' => [],
		'fb' => [],
		'twitter' => [],
	];
	// Set type
	if ( is_front_page() ) {
		$type = 'web_site';
	}
	if ( is_singular() ) {
		// This is post
		$post = get_queried_object();
		$url = get_permalink( $post );
		if ( has_post_thumbnail( $post ) ) {
			$image = get_the_post_thumbnail_url( $post, 'full' );
		}
		$excerpt = get_the_excerpt( $post );
		foreach ( [ 'category', 'post_tag' ] as $taxonomy ) {
			$terms = get_the_terms( $post, $taxonomy );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$keywords[] = $term->name;
				}
			}
		}
	} else {
		// This is taxonomy
		$term = get_queried_object();
		$url = get_term_link( $term );
		$excerpt = $term->description;
		$keywords[] = $term->name;
	}
	$keywords = [ 'WordPress', 'Plugin' ];
	$excerpt = preg_replace( '#(\r|\n)#', '', $excerpt );
	// Get image dimension
	list( $width, $height ) = jaiko_image_dimension( $image );
	$metas['og']['image:width']  = $width;
	$metas['og']['image:height'] = $height;
	// Build meta tag
	$metas = array_merge_recursive( [
		'' => [
			'description' => $excerpt,
			'keywords' => implode( ',', $keywords ),
		],
		'og' => [
			'title'            => $title,
			'url'              => $url,
			'image'            => $image,
			'description'      => $excerpt,
			'type'             => $type,
			'site_name'        => get_bloginfo( 'name' ),
			'locale'           => ( 'ja' == get_locale() ? 'ja_jp' : 'en_us' ),
			'locale:alternate' => ( 'ja' == get_locale() ? 'en_us' : 'ja_jp' ),
		],
		'article' => [
			'publisher' => 'https://www.facebook.com/gianism.info/',
		],
		'fb' => [
			'admins' => '1034317368',
			'app_id' => jaiko_fb_app_id(),
			'pages'  => jaiko_fb_page_id(),
		],
		'twitter' => [
			'card'    => $image ? 'summary_large_image' : 'summary',
			'site'    => '@wpGianism',
			'domain'  => 'gianism.info',
			'creator' => '@wpGianism',
			'title'   => $title,
			'desc'    => $excerpt,
			'image'   => $image,
		],
	], $metas );



	foreach ( $metas as $prefix => $meta ) {
		foreach ( $meta as $key => $content ) {
			switch ( $prefix ) {
				case 'og':
				case 'article':
				case 'fb':
					$property = 'property';
					break;
				default:
					$property = 'name';
					break;
			}
			$content = (array) $content;
			foreach ( $content as $c ) {
				printf(
					'<meta %s="%s" content="%s" />',
					$property,
					esc_attr( ( $prefix ? $prefix.':' : '' )  . $key ),
					esc_attr( $c )
				);
			}
		}
	}
}, 1 );
