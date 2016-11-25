
<?php get_template_part( 'template-parts/block', 'add-on' ) ?>

<?php get_template_part( 'template-parts/block', 'mail' ) ?>

<footer class="page-footer">

	<div class="container">

		<div class="row">
			<div class="col l6 s12 footer-notice">
				<h5>Gianism.info</h5>
				<p>
					<?= get_bloginfo( 'description', 'display' ); ?>
				</p>
				<p>
					<?php _e( 'We provide you the professional information about WordPress plugins. Join us and hack WP!', 'jaiko' ) ?>
				</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5><?php _e( 'Links', 'jaiko' ) ?></h5>
				<?php wp_nav_menu( [
					'theme_location' => 'footer',
				] ) ?>
			</div>
		</div>

	</div>

	<div class="footer-copyright">

		<div class="container">
			&copy; 2016 <a href="https://hametuha.co.jp/">Hametuha INC</a>.

			<span class="footer-mention right">Proudly powered by <a href="https://wordpress.org">WordPress</a>.</span>
		</div>


	</div>

</footer>
<div class="fixed-action-btn left">
	<a class="btn-floating btn-large">
		<img class="avatar" src="<?= get_stylesheet_directory_uri() ?>/assets/img/identity/wp-login.png" alt="Gianism" />
	</a>
</div>
<div class="fixed-action-btn toolbar">
	<a class="btn-floating btn-large">
		<?php if ( is_user_logged_in() ) : ?>
			<?= get_avatar( get_current_user_id(), 150 ) ?>
		<?php else : ?>
			<i class="material-icons">mode_edit</i>
		<?php endif; ?>
	</a>
	<ul>
		<?php if ( is_user_logged_in() ) : ?>
			<li>
				<a class="waves-effect waves-light" href="<?= admin_url( 'profile.php' ) ?>">
					<i class="material-icons">settings</i> <?php _e( 'Profile', 'jaiko' ) ?>
				</a>
			</li>
			<li>
				<a class="waves-effect waves-light" href="<?= wp_logout_url( $_SERVER['REQUEST_URI'] ) ?>">
					<i class="material-icons">exit_to_app</i> <?php _e( 'Log out', 'jaiko' ) ?>
				</a>
			</li>
		<?php else : ?>
			<li>
				<a class="waves-effect waves-light" rel="nofollow" href="<?= wp_login_url( $_SERVER['REQUEST_URI'] ) ?>">
					<i class="material-icons">input</i> <?php _e( 'Log in', 'jaiko' ) ?>
				</a>
			</li>
		<?php endif; ?>
		<?php
		if ( is_singular() ) {
			$url = get_permalink( get_queried_object() );
		} else {
			$url = home_url( '/' );
		}
		$tweet = sprintf( 'https://twitter.com/intent/tweet?url=%s&via=wpGianism&related=takahashifumiki', rawurlencode( $url ) );
		?>
		<li>
			<a class="waves-effect waves-light fb-share-link" href="<?= esc_url( $url ) ?>">
				<i class="dashicons dashicons-facebook"></i> <?php _e( 'Share', 'jaiko' ) ?>
			</a>
		</li>
		<li>
			<a class="waves-effect waves-light" target="_blank" href="<?= esc_url( $tweet ) ?>">
				<i class="dashicons dashicons-twitter"></i> <?php _e( 'Tweet', 'jaiko' ) ?>
			</a>
		</li>
	</ul>
</div>
<?php wp_footer() ?>
</body>
</html>