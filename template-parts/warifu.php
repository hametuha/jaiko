<?php
if ( 'add-on' != get_post_type() ) {
	return;
}
$restore = false;
if ( function_exists( 'bogo_get_post_translation' ) && ( 'ja' == get_locale() ) && ( $translation = bogo_get_post_translation( get_the_ID(), 'en_US' ) ) ) {
	$restore = true;
	remove_filter( 'home_url', 'bogo_home_url' );
	$post = $translation;
	setup_postdata( $translation );
}

if ( warifu_guid() ) {
	?>
	<div class="product-support">
		<div class="product-buy">
			<h2 class="product-buy-title"><?php _e( 'Get product license!', 'jaiko' ); ?></h2>
			<p class="product-buy-desc"><?php _e( 'Grab license at <strong>Gumroad</strong> and download a copy. You can get any time for any site!', 'jaiko' ) ?></p>
			<?= warifu_gumroad_button(); ?>
		</div>
		<?php warifu_form( __( 'Product Support by Plugin Author', 'jaiko' ) ); ?>
		<?php
		if ( defined( 'MIKKAI_VERSION' ) && is_user_logged_in() ) {
			if ( $thread = mikkai_owned_thread() ) {
				$user = get_userdata( get_current_network_id() );
				printf( '<p class="product-buy-desc">%s</p>', sprintf( esc_html__( 'Welcome back %s! Please open chat box if you need our support!', 'jaiko' ), $user->display_name ) );
				printf( '<a href="%s" class="waves-effect btn">%s</a>', mikkai_message_url( $thread->ID ), __( 'Open support chat', 'jaiko' ) );
			} else {
				mikkai_child_thread_button( $post );
			}
		}
		?>
	</div>
	<?php
}

if ( $restore ) {
	wp_reset_postdata();
	add_filter( 'home_url', 'bogo_home_url' );
}