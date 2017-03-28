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


// ------------------------------
//
// Show download URL
//
//
$url = [];
if ( $wordpress = get_post_meta( get_the_ID(), '_wordpress_url', true ) ) {
	$url[] = [ $wordpress, 'wordpress', esc_html__( 'Download', 'jaiko' ), 'light-blue accent-4' ];
}
if ( $github    = get_post_meta( get_the_ID(), '_github_url', true ) ) {
	$url[] = [ $github, 'share', esc_html__( 'View on Github', 'jaiko' ), 'blue-grey lighten-3' ];
}
if ( $url ) :
	?>
	<div class="download-section">
		<div class="download-header">
			<h2 class="download-title"><?php _e( 'Download', 'jaiko' ); ?></h2>
			<p class="download-desc">
				<?php _e( 'Yes, they are open source and any pull requests are welcome!', 'jaiko' ) ?>
			</p>
		</div>
		<div class="row">
			<?php foreach ( $url as list( $href, $dashicons, $label, $color ) ) : ?>
				<div class="col <?= jaiko_calc_row_class( count( $url ) ) ?>">
					<a href="<?= esc_url( $href ) ?>" class="waves-effect waves-light btn-large <?= $color ?>">
						<span class="dashicons dashicons-<?= $dashicons ?>"></span>
						<?= $label  ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
endif;





// ------------------------------
//
// Show License Support if exists.
//
//

if ( $licenses = warifu_license_posts() ) :
	?>

	<div class="product-support">
		<div class="product-buy">
			<h2 class="product-buy-title"><?php _e( 'Get Supported', 'jaiko' ); ?></h2>
			<p class="product-buy-desc">
				<?php _e( 'Grab license at <strong>Gumroad</strong> and premium support!', 'jaiko' ) ?>
			</p>
		</div>
		<div class="row license-row">
			<?php foreach ( $licenses as $license ) : ?>
			<div class="license-col col <?= jaiko_calc_row_class( count( $licenses ) ) ?>">
				<div class="license-item">
					<h3 class="license-item-title" data-mh="license-title"><?= esc_html( get_the_title( $license ) ) ?></h3>
					<?php if ( $license->post_content ) : ?>
					<div class="license-item-desc" data-mh="license-content">
						<?= apply_filters( 'the_content', $license->post_content ) ?>
					</div>
					<?php endif; ?>
					<div class="license-item-price">
						&yen; <?= esc_html( warifu_price( $license ) ?: '---' ) ?>
					</div>
					<div class="license-item-count">
						<?php esc_html_e( 'Allows installing ', 'jaiko' ) ?>
						<?php if ( ! ( $count = warifu_limit( $license ) ) ) : ?>
							<strong><?php esc_html_e( 'infinite sites!', 'jaiko' ) ?></strong>
						<?php else : ?>
							<?php printf( _n( '%s site.', '%s sites.', $count, 'jaiko' ), $count ) ?>
						<?php endif; ?>
					</div>
					<div class="license-item-buy">
						<?= warifu_gumroad_button( $license, [ 'label' => __( 'See Detail', 'jaiko' ) ] ); ?>
					</div>
				</div>
			</div><!-- //.license-col  -->
			<?php endforeach; ?>
		</div>

		<div class="product-notice row">
			<div class="col s6 m3 product-notice-item">
				<i class="material-icons">confirmation_number</i>
				<p class="product-notice-title" data-mh="product-notice"><?php esc_html_e( 'License Manager', 'jaiko' ) ?></p>
				<p class="product-notice-desc">
					<?php printf(
						__( 'Do you have license already? We are developing license manager. Stay tuned on our <a href="%s">news letter</a>!', 'jaiko' ),
						'#mc_embed_signup'
					); ?>
				</p>
			</div>
			<div class="col s6 m3 product-notice-item">
				<i class="material-icons">forum</i>
				<p class="product-notice-title" data-mh="product-notice"><?php esc_html_e( 'Chat & Forum', 'jaiko' ) ?></p>
				<p class="product-notice-desc">
					<?php
						_e( '<a href="/forums/">Forum</a> is available! We are also working on chats support.', 'jaiko' );
					?>
				</p>
				<div class="fb-messengermessageus"
					 messenger_app_id="<?= jaiko_fb_app_id() ?>"
					 page_id="<?= jaiko_fb_page_id() ?>"
					 color="blue"
					 size="standard">
				</div>
			</div>
			<div style="clear:left" class="hide-on-med-and-up"></div>
			<div class="col s6 m3 product-notice-item">
				<i class="material-icons">attach_money</i>
				<p class="product-notice-title" data-mh="product-notice"><?php esc_html_e( '30 Days Refund', 'jaiko' ) ?></p>
				<p class="product-notice-desc">
					<?php printf(
						__( 'All of our premium plugins are refundable within 30 days. Please refer our <a href="%s">refund policy</a>.', 'jaiko' ),
						get_permalink( get_page_by_path( 'refund' . ( 'ja' == get_locale() ? '-ja' : '' ) ) )
					); ?>
				</p>
			</div>
			<div class="col s6 m3 product-notice-item">
				<i class="material-icons">done_all</i>
				<p class="product-notice-title" data-mh="product-notice"><?php esc_html_e( 'Yes, GPL.', 'jaiko' ) ?></p>
				<p class="product-notice-desc">
					<?php printf(
						__( 'We respect <a href="%1$s">WordPress license policy</a> and most of our plugins are <strong>100%% GPL</strong>. Why "most"? Because sometimes we prefer <a href="%2$s">MIT</a>.', 'jaiko' ),
						'https://make.wordpress.org/community/handbook/wordcamp-organizer/first-steps/helpful-documents-and-templates/100-gpl-vetting-checklist/',
						'https://opensource.org/licenses/MIT'
					); ?>
				</p>
			</div>
		</div>
	</div><!-- //.product-support" -->
	<?php
endif;


if ( $restore ) {
	wp_reset_postdata();
	add_filter( 'home_url', 'bogo_home_url' );
}


