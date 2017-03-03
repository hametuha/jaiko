<?php


/**
 * Get how to read content
 *
 * @param null|int|WP_Post $post
 *
 * @return string
 */
function jaiko_how_to_read( $post = null ) {
	if ( ! defined( 'CHIRAMISE_VERSION' ) ) {
		return '';
	}
	if ( chiramise_should_check( $post ) && ! chiramise_can_read( $post ) ) {
		$url = wp_login_url( get_permalink( $post ) );
		$label = sprintf( __( 'This article is only for registered user. To continue reading another %1$d%% of content, please <a href="%2$s" rel="nofollow">login</a>.', 'jaiko' ), chiramise_content_ratio(), esc_url( $url ) );
		$html = <<<HTML
<div class="chiramise">
{$label}
</div>
HTML;
		return $html;
	} else {
		return '';
	}
}

/**
 * Show google ad
 *
 * @param $position
 */
function jaiko_ad( $position ) {
	switch ( $position ) {
		case 'after-title':
			?>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Gianism AfterTitle -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-0087037684083564"
			     data-ad-slot="8984022445"
			     data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<?php
			break;
		case 'after-content':
			?>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Gianism After content -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-0087037684083564"
			     data-ad-slot="7646890046"
			     data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<?php
			break;
		default:
			break;
	}
}


/**
 * Create pagination
 *
 * @param WP_Query $query
 * @return string
 */
function jaiko_pagination( $query = null ) {

	if ( is_null( $query ) ) {
		global $wp_query;
		$query = $wp_query;
	}

	$big = 999999999; // need an unlikely integer

	$pagination = paginate_links( [
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '/%#%',
		'current' => max( 1, $query->get( 'paged' ) ),
		'total' => $query->max_num_pages,
	    'prev_text' => '<i class="material-icons">chevron_left</i>',
		'next_text' => '<i class="material-icons">chevron_right</i>',
	] );

	$out = [];
	foreach ( explode( "\n", $pagination ) as $link ) {
		if ( false !== strpos( $link, 'current' ) ) {
			$out[] = sprintf( '<li class="active"><a>%s</a></li>', $link );
		} elseif ( false !== strpos( $link, 'dots' ) ) {
			$out[] = sprintf( '<li class="disabled"><a>%s</a></li>', $link );
		} else {
			$out[] = sprintf( '<li class="waves-effect">%s</li>', $link );
		}
	}

	echo '<ul class="pagination">' . implode( "\n", $out ) . '</ul>';
}

/**
 * Get posts
 *
 * @param null|int|WP_Post $post
 *
 * @return array
 */
function jaiko_add_ons_query( $post = null ) {
	return get_posts( [
		'post_type'      => 'add-on',
		'post_status'    => 'publish',
	    'post_parent'    => $post->ID,
	    'posts_per_page' => -1,
	] );
}

/**
 * Return add-on's category
 *
 * @param null|int|WP_Post $post
 *
 * @return WP_Term
 */
function jaiko_add_on_category( $post = null ) {
	$post = get_post( $post );
	$post_id = $post->post_parent ?: $post->ID;
	$categories = get_the_category( $post_id );
	foreach ( $categories as $category ) {
		return $category;
	}
	return null;
}

/**
 * Get add on number
 *
 * @param null|int|WP_Post $post
 *
 * @return int
 */
function jaiko_add_on_count( $post = null ) {
	$post = get_post( $post );
	return count( jaiko_add_ons_query( $post ) );
}

/**
 * Count license and show good result.
 *
 * @param int    $length
 * @param string $type
 * @todo Allow various situations.
 * @return string
 */
function jaiko_calc_row_class( $length, $type = 'license' ) {
	switch ( $length ) {
		case 1:
			return 's12';
			break;
		case 2:
			return 's6';
			break;
		case 4:
			return 's6 l3';
			break;
		default:
			return 's4';
			break;
	}
}
