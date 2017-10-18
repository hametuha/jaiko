<?php

/**
 * Register post type
 */
add_action( 'init', function () {
	register_post_type(
		'add-on',
		[
			'label'        => __( 'Plugin', 'jaiko' ),
			'public'       => true,
			'has_archive'  => true,
			'hierarchical' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'page-attributes' ],
			'taxonomies'   => [ 'category' ],
			'menu_icon'    => 'dashicons-admin-plugins',
			'rewrite'      => [
				'with_front' => false,
			],
		]
	);
} );


/**
 * Add rewrite rules
 */
add_filter( 'rewrite_rules_array', function( $rules ) {
	return array_merge( [
		'(en|ja)/([^/]+)/of/([^/]+)/page/(\d+)/?$' => 'index.php?lang=$matches[1]&tag=$matches[2]&category_name=$matches[3]&paged=$matches[4]',
		'(en|ja)/([^/]+)/of/([^/]+)/?$' => 'index.php?lang=$matches[1]&tag=$matches[2]&category_name=$matches[3]',
		'([^/]+)/of/([^/]+)/page/(\d+)/?$' => 'index.php?tag=$matches[1]&category_name=$matches[2]&paged=$matches[3]',
		'([^/]+)/of/([^/]+)/?$' => 'index.php?tag=$matches[1]&category_name=$matches[2]',
	], $rules );
} );

/**
 * Change query
 *
 * @param WP_Query $wp_query
 */
add_action( 'pre_get_posts', function ( &$wp_query ) {
	if ( is_admin() ) {
		return;
	}
	// If this is category
	if ( ( $wp_query->is_main_query() && $wp_query->is_category() ) || $wp_query->get( 'relates_to' ) ) {
		$wp_query->set( 'post_type', [ 'post', 'add-on' ] );
	}
} );

/**
 * Filter join if specified 'related_to'
 */
add_filter( 'posts_join', function( $join, $wp_query ) {
	global $wpdb;
	if ( ! ( $post_id = $wp_query->get( 'relates_to' ) ) ) {
		return $join;
	}
	$query = <<<SQL
		SELECT term_taxonomy_id FROM {$wpdb->term_relationships}
		WHERE object_id = %d
SQL;
	$term_ids = $wpdb->get_col( $wpdb->prepare( $query, $post_id ) );
	if ( ! $term_ids ) {
		return $join;
	}
	$wp_query->on_related_to = true;
	$term_ids = implode( ', ', array_map( 'intval', $term_ids ) );
	$join_query = <<<SQL
		INNER JOIN (
			SELECT object_id AS post_id, COUNT(term_taxonomy_id) AS score
			FROM {$wpdb->term_relationships}
			WHERE term_taxonomy_id IN ({$term_ids})
			  AND object_id != %d
			GROUP BY object_id
		) AS relates_to
		ON {$wpdb->posts}.ID = relates_to.post_id
SQL;
	return $join . $wpdb->prepare( $join_query, $post_id );
}, 10, 2 );

/**
 * Change order
 */
add_filter( 'posts_orderby', function( $orderby, $wp_query ) {
	if ( isset( $wp_query->on_related_to ) && $wp_query->on_related_to ) {
		global $wpdb;
		$orderby = "relates_to.score DESC, {$wpdb->posts}.post_date DESC";
	}
	return $orderby;
}, 10, 2 );
