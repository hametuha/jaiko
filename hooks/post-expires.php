<?php

/**
 * Register post type and cron
 */
add_action( 'init', function() {
	register_post_type( 'announce', [
		'label'      => __( 'Announcement', 'jaiko' ),
	    'public'     => false,
	    'show_ui'    => true,
	    'menu_icon' => 'dashicons-megaphone',
	    'supports'   => [ 'title', 'editor', 'author' ],
	] );

	if ( ! wp_next_scheduled( 'jaiko_post_expiration' ) ) {
		wp_schedule_event( current_time( 'timestamp', true ), 'hourly', 'jaiko_post_expiration' );
	}
} );

/**
 * Add metabox
 */
add_action( 'add_meta_boxes', function( $post_type ) {
	if ( 'announce' == $post_type ) {
		add_meta_box( 'jaiko-expires', __( 'Expiration Setting', 'jaiko' ), function( $post ) {
			wp_nonce_field( 'update_expiration', '_expire_nonce', false );
			?>
			<label style="display: block;">
				<?php _e( 'Expires at', 'jaiko' ) ?><br />
				<input name="expires" type="text" value="<?= esc_attr( get_post_meta( $post->ID, '_expires', true ) ) ?>" />
			</label>
			<?php
		}, 'announce', 'side' );
	}
} );

/**
 * Save date
 */
add_action( 'save_post', function( $post_id, $post ) {
	if ( wp_is_post_autosave( $post ) || wp_is_post_revision( $post ) ) {
		return;
	}
	if ( ! isset( $_POST['_expire_nonce'] ) || ! wp_verify_nonce( $_POST['_expire_nonce'], 'update_expiration' ) ) {
		return;
	}
	$date = trim( $_POST['expires'] );
	if ( ! preg_match( '#\d{4}-\d{2}-\d{2}#u', $date ) ) {
		$date = '';
	}
	if ( $date ) {
		update_post_meta( $post_id, '_expires', $date );
	} else {
		delete_post_meta( $post_id, '_expires' );
	}
}, 10, 2 );

/**
 * Expires post
 */
add_action( 'jaiko_post_expiration', function() {
	$today = date_i18n( 'Y-m-d' );
	foreach ( get_posts( [
		'post_type'        => 'announce',
	    'post_status'      => 'publish',
	    'posts_per_page'   => -1,
	    'suppress_filters' => false,
	    'meta_query'       => [
	    	[
	    		'key'      => '_expires',
		        'value'    => $today,
		        'compare'  => '<',
		        'type'     => 'date',
		    ],
	    ],
	] ) as $post ) {
		wp_update_post( [
			'ID' => $post->ID,
		    'post_status' => 'private',
		] );
	}
} );
