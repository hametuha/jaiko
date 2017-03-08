<?php
/**
 * Query
 *
 * @package jaiko
 * @since 1.1.2
 */

/**
 * Get related post
 *
 * @param null|int|WP_Post $post
 * @param array $args
 *
 * @return array
 */
function jaiko_related_posts( $post = null, $args = [] ) {
	$post = get_post( $post );
	$default = [
		'post_status' => 'publish',
		'posts_per_page' => 10,
	];
	switch ( $post->post_type ) {
		case 'add-on':
			$cats = [];
			foreach ( get_the_category( $post->ID ) as $cat ) {
				$cats[] = $cat->term_id;
			}
			$default['cat'] = $cats;
			break;
		default:
			$default['post_type']  = $post->post_type;
			$default['relates_to'] = $post->ID;
			break;
	}
	$args = wp_parse_args( $args, $default );
	return get_posts( $args );
}
