<?php get_header();
the_post(); ?>


<main class="article-wrapper">

	<div class="article-jumbotron">
		<h1 class="article-jumbotron-title"><?php the_title() ?></h1>
		<div class="article-jumbotron-image">
			<img width="150" height="150" src="<?= get_stylesheet_directory_uri() ?>/assets/img/identity/wp-login.png"
			     alt="Gianism">
		</div>
		<div class="article-jumbotron-text">
			<?php the_content() ?>
		</div>
		<div class="article-jumbotron-btn">
			<a class="btn" href="https://wordpress.org/plugins/gianism/"><?php _e( 'Install Gianism', 'jaiko' ) ?></a>
		</div>
		<?php get_template_part( 'template-parts/language', 'changer' ) ?>
	</div>


	<section class="front-section">

		<div class="front-block front-cards-block">

			<div class="front-cards-video youtube-bg">
				<iframe data-width="560" data-height="315"
						src="https://www.youtube.com/embed/JXl3EMPmXkY?rel=0&autoplay=1&showinfo=0&loop=1&controls=0&wmode=transparent"
						frameborder="0" allowfullscreen="true"></iframe>
			</div>

			<div class="container">

				<div class="front-cards">
					<?php
					$counter = 0;
					$rows = [];
					foreach ( [
						[ 'facebook', __( 'Log in with Facebook.', 'jaiko' ), '#3b5998' ],
						[ 'twitter', __( 'Why not twitter?', 'jaiko' ), '#1da1f2' ],
						[ 'google', __( 'Google? Yes, of course.', 'jaiko' ), '#dd4b39' ],
						[ 'instagram', __( 'Also Instagram. True.', 'jaiko' ), '#833ab4' ],
						[ 'github', __( 'We have add-ons like Github, mixi and so on.', 'jaiko' ), '#333' ],
						[ 'setup', __( 'Service API available for experienced developers.', 'jaiko' ), '#4D8E26' ],
						[ 'graph', __( 'Every service extensible like Google Analytics, Facebook Graph API and so on.', 'jaiko' ), '#176B86' ],
						[ 'heart', __( 'We have support plan in case you are lost yourself.', 'jaiko' ), '#E03A01' ],
					] as $card ) {
						$index = (int) floor( $counter / 4 );
						if ( ! isset( $rows[ $index ] ) ) {
							$rows[ $index ] = [];
						}
						$rows[ $index ][] = $card;
						$counter++;
					}
					foreach ( $rows as $row ) :
						$counter = 0;
						$row_index = 0;
						?>
						<div class="row front-cards-row">
							<?php foreach ( $row as list( $icon, $text, $color ) ) : $row_index++; ?>
								<div class="col s6 m3">
									<div class="front-cards-item">
										<span class="lsf lsf-<?= $icon ?>" style="<?= $color ? "color:{$color};" : '' ?>"></span>
										<p data-mh="match-height-<?= $row_index ?>">
											<?= $text ?>
										</p>
									</div>
								</div>
								<?php if ( 1 === $counter ) : ?>
									<div style="clear:left" class="hide-on-med-and-up"></div>
								<?php endif; ?>
							<?php $counter++; endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div><!-- // .front-cards -->
			</div><!-- //.container -->
		</div><!-- // .front-block -->

		<div class="front-block">

			<div class="container">

				<h2 class="front-title">
					<?php _e( 'Our Blog Posts', 'jaiko' ) ?>
				</h2>
				<p class="front-lead">
					<?php _e( 'Gianism.info is the information hub for WordPress Developer!', 'jaiko' ) ?>
				</p>
				<div class="row">
					<?php
					$latest = new WP_Query( [
						'post_type'        => 'post',
						'post_status'      => 'publish',
						'posts_per_page'   => 7,
						'lang'             => 'ja' == get_locale() ? 'ja' : 'en_US',
					] );
					?>
					<div class="col m12 l4 card-big">
						<?php $latest->the_post() ?>
						<?php get_template_part( 'template-parts/card', 'post' ) ?>
					</div>
					<div class="col m12 l8">
						<div class="row front-list-divider">
							<?php
							$counter = 0;
							for ( $i = 0; $i < 6; $i++ ) :
								if ( ! $latest->have_posts() ) {
									break;
								}
								$latest->the_post();
								?>
								<div class="col m12 l6">
									<?php get_template_part( 'template-parts/loop', 'front' ) ?>
								</div>
								<?php if ( false !== array_search( $counter, [ 1, 3 ] ) ) : ?>
								<div style="clear:left" class="hide-on-med-and-down divider"></div>
								<?php endif; ?>
							<?php $counter++; endfor;
							wp_reset_postdata() ?>
						</div>
					</div>
				</div>

				<div class="center">
					<a class="waves-effect waves-light btn-large" href="<?= get_permalink( get_post( get_option( 'page_for_posts' ) ) ) ?>">
						<?php _e( 'See All Posts', 'jaiko' ) ?>
					</a>
				</div>

			</div>
		</div>

		<div class="front-block">
			<div class="container">

				<h2 class="front-title">
					<?php _e( 'Our load maps', 'jaiko' ) ?>
				</h2>
				<p class="front-lead">
					<?php _e( 'We have plans for making our WordPress super social', 'jaiko' ) ?>
				</p>
				<div class="row">
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">nature_people</i><br/>
							<?php _e( 'Natural UX', 'jaiko' ) ?>
						</h3>
						<p class="front-block-lead">
							<?php _e( 'WordPress is blog tool. So, authors and users are separated. Admin screen is complicated for
							ordinary user.
							We are creating plugins which are well integrated with Gianism and make user experience
							better.', 'jaiko' ) ?>
						</p>
					</div>
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">compare_arrows</i><br/>
							<?php _e( '1 to 1', 'jaiko' ) ?>
						</h3>
						<p class="front-block-lead">
							<?php _e( 'All interactive actions on WordPress are author-centered like comment.
							Social web site requires 1 to 1 communication like message, chat and non-verbal "like".
							Besides that, we need notification system. Of course, we are ahead toward them.', 'jaiko' ); ?>
						</p>
					</div>
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">phone_iphone</i><br/>
							<?php _e( 'Mobile Apps', 'jaiko' ) ?>
						</h3>
						<p class="front-block-lead">
							<?php _e( 'As long as we know, there are few solution to use WordPress as Mobile App\'s backend.
							WP REST API is the one, but there are many things to integrate a bunch of plugins to it.
							We think all our plugins should be REST API ready.', 'jaiko' ); ?>
						</p>
					</div>
				</div>
				<p class="front-block-conclusion">
					<?php if ( is_user_logged_in() ) : ?>
						<span>
					<?php
					$user = get_userdata( get_current_user_id() );
					printf(
						__( 'Howday, %s! Please let me know <a href="%s">about you</a>!', 'jaiko' ),
						esc_html( $user->display_name ),
						esc_url( admin_url( 'profile.php' ) )
					);
					?>
					</span>
					<?php else : ?>
						<span>
						<?php _e( 'Are you interested with them? Gianism.info is the living example. Log in and get in touch with us!', 'jaiko' ) ?>
					</span>
						<br/>
						<a class="btn teal waves-effect" href="" rel="nofollow">
							<?php _e( 'Login', 'jaiko' ) ?>
						</a>
					<?php endif; ?>
				</p>

			</div>
		</div>

	</section>


</main>

<?php get_footer(); ?>
