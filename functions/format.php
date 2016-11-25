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
