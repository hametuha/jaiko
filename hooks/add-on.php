<?php
/**
 * Hooks for Add-ons
 *
 * @since 1.0.0
 * @package jaiko
 */



/**
 * Add meta boxes
 */
add_action( 'add_meta_boxes', function( $post_type ) {
	if ( 'add-on' != $post_type ) {
		return;
	}
	// Download Button
	add_meta_box( 'download_url', __( 'Download URL', 'jaiko' ), function( WP_Post $post ) {
		wp_nonce_field( 'update_add_on', '_add_on_nonce', false );
		?>
		<p>
			<label>
				WordPress<br />
				<input type="text" name="wordpress_url" class=""
				       value="<?= esc_attr( get_post_meta( $post->ID, '_wordpress_url', true ) ) ?>" />
			</label>
		</p>
		<p>
			<label>
				Github<br />
				<input type="text" name="github_url" class=""
				       value="<?= esc_attr( get_post_meta( $post->ID, '_github_url', true ) ) ?>" />
			</label>
		</p>
		<?php
	}, $post_type, 'side' );
	// Select bundle
	add_meta_box( 'bundles', __( 'Bundled Plugins', 'jaiko' ), function( WP_Post $post ) {
		$meta = get_post_meta( $post->ID, '_bundle' );
		foreach ( get_posts( [
			'post_type' => 'add-on',
			'posts_per_page' => -1,
			'post__not_in' => [ $post->ID ],
			'post_status' => 'any',
		] ) as $add_on ) {
			?>
			<label style="display: block; margin: 5px 0;">
				<input type="checkbox" value="<?= $add_on->ID ?>" name="bundle[]" <?php checked( in_array( $add_on->ID, $meta ) ) ?> />
				<?= get_the_title( $add_on ) ?>
				<small>( <?= esc_html( get_post_meta( $add_on->ID, '_locale', true ) ?: '---' )?> )</small>
			</label>
			<?php
		}
	}, $post_type, 'advanced' );
} );

/**
 * Save URLs
 */
add_action( 'save_post', function( $post_id, WP_Post $post ) {
	if ( 'add-on' != $post->post_type ) {
		return;
	}
	if ( ! isset( $_POST['_add_on_nonce'] ) || ! wp_verify_nonce( $_POST['_add_on_nonce'], 'update_add_on' ) ) {
		return;
	}
	// Set URL
	update_post_meta( $post_id, '_github_url', $_POST['github_url'] );
	update_post_meta( $post_id, '_wordpress_url', $_POST['wordpress_url'] );
	// Update bundle
	delete_post_meta( $post_id, '_bundle' );
	if ( isset( $_POST['bundle'] ) ) {
		foreach ( $_POST['bundle'] as $add_on_id ) {
			add_post_meta( $post_id, '_bundle', $add_on_id );
		}
	}
}, 10, 2 );

/**
 * Delete post meta if add on is deleted.
 */
add_action( 'delete_post', function( $post_id ) {
	global $wpdb;
	$wpdb->delete( $wpdb->postmeta, [
		'meta_key'   => '_bundle',
		'meta_value' => $post_id,
	], [ '%s', '%d' ] );
} );
