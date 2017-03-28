<?php
/**
 * Add-on related functions
 */


/**
 * Get bundle posts
 *
 * @param null|int|WP_Post $post
 *
 * @return array
 */
function jaiko_bundles( $post = null ) {
	$post = get_post( $post );
	if ( ! ( $bundle = get_post_meta( $post->ID, '_bundle' ) ) ) {
		return [];
	}
	return get_posts( [
		'post_type'      => 'add-on',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		'post__in'       => $bundle,
	] );
}

/**
 * Get bundle parents
 *
 * @param null|int|WP_Post $post
 *
 * @return array
 */
function jaiko_get_bundle_parents( $post = null ) {
	$post = get_post( $post );
	return get_posts( [
		'post_type' => 'add-on',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => [ 'menu_order' => 'DESC' ],
		'meta_query' => [
			[
				'key' => '_bundle',
				'value' => $post->ID,
			],
		],
	] );
}
