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
	update_post_meta( $post_id, '_github_url', $_POST['github_url'] );
	update_post_meta( $post_id, '_wordpress_url', $_POST['wordpress_url'] );
}, 10, 2 );
