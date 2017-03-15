<?php get_header(); ?>
<?php the_post(); ?>
<section class="page-wrapper">

	<div class="article-thumbnail forum-thumbnail">
		<div class="forum-logo center">
			<p>
				<i class="material-icons">question_answer</i>
			</p>
		</div>
	</div>

	<div class="container">

		<div class="row">

			<article class="col s12 l9 article-body forum-body">

				<div class="forum-header">
					<h1>
						<small><?php _e( 'Support Forum', 'jaiko' ) ?></small>
						<?php the_title() ?>
					</h1>
				</div>

				<?php if ( is_singular( 'forum' ) ) : ?>
					<div class="article-excerpt">
						<?php echo wpautop( get_queried_object()->post_content ) ?>
					</div>
				<?php endif; ?>

				<div class="forum-language-notation">
					<p>
						<i class="material-icons">translate</i>
						<?php
						if ( ! is_user_logged_in() ) {
							printf(
								'このフォーラムは日本語でも利用できます。<a href="%s">ログイン</a>して、言語設定を変更してください。',
								wp_login_url( $_SERVER['REQUEST_URI'] )
							);
						} else {
							$url = admin_url( 'profile.php' );
							if ( 'ja' != get_locale() ) {
								printf( '日本語で利用する場合は<a href="%s" target="_blank">プロフィール</a>で言語設定を変更してください。', $url );
							} else {
								printf( 'You can change language setting <a href="%s">here</a>.', $url );
							}
						}
						?>
					</p>
				</div><!-- //.language-notation -->

				<?php jaiko_ad( 'after-title' ); ?>

				<div class="forum-content">
					<?php the_content(); ?>
					<div style="clear:both;"></div>
				</div>

				<div class="row">

					<div class="col s12 m6">
						<div class="ad-title">SPONSORED LINK</div>
						<div class="follow-ad">
							<?php jaiko_ad( 'after-title' ); ?>
						</div>
					</div>

					<div class="col s12 m6">
						<div class="ad-title">SPONSORED LINK</div>
						<div class="follow-ad">
							<?php jaiko_ad( 'after-title' ); ?>
						</div>
					</div>

				</div>

			</article>

			<div class="col s12 l3 sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ) ?>
			</div>

		</div>

	</div>

</section>

<?php get_footer(); ?>

