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
			<a class="btn"><?php _e( 'Install Gianism', 'jako' ) ?></a>
		</div>
		<?php get_template_part( 'template-parts/language', 'changer' ) ?>
	</div>


	<section class="front-section">

		<div class="front-block">

			<div class="container">

				<h2 class="front-title">
					Enhance Your Login
				</h2>
				<p class="front-lead">
					Missing link between WordPress and Application
				</p>

				<div class="row">
					<div class="col s12 m8">
						<ul class="front-list mt80">
							<li class="ok">
								<?php _e( 'User can login via facebook, google, twitter and instagram account. Extra SNS are add-ons.', 'jaiko' ) ?>
							</li>
							<li class="ok">
								<?php _e( 'Experienced developers can use additional features. Facebook Graph API, Twitter API and Google API.', 'jaiko' ) ?>
							</li>
						</ul>
					</div>
					<div class="col m4 hide-on-small-and-down">
						<img class="front-image"
						     src="<?= get_stylesheet_directory_uri() ?>/assets/img/front/login-screen.png"
						     alt="Login screen"/>
					</div>
				</div>

			</div>


		</div>

		<div class="front-block">

			<div class="container">


				<h2 class="front-title">
					What We Provide You
				</h2>
				<p class="front-lead">
					Gianism.info is the information hub for WordPress Developer!
				</p>
				<div class="row">
					<div class="col m4 hide-on-small-and-down">
						<img class="front-image"
						     src="<?= get_stylesheet_directory_uri() ?>/assets/img/front/gianism-love.png" alt="Love"/>
					</div>
					<div class="col s12 m8 mt80">
						<ul class="front-list">
							<li class="ok">
								<?php
								$latest = get_posts( [
									'post_type'        => 'post',
									'post_status'      => 'publish',
									'posts_per_page'   => 1,
								    'lang'             => 'ja' == get_locale() ? 'ja' : 'en_US',
								    'suppress_filters' => false,
								] );
								printf(
									__( '<strong>Tips blog:</strong> You can get latest information and notable tips from our <a href="%1$s">blog list</a>. The latest is &quot;%2$s&quot;.', 'jaiko' ),
									get_permalink( get_option( 'page_for_posts' ) ),
									sprintf( '<a href="%1$s">%2$s</a>', get_permalink( $latest[0] ), get_the_title( $latest[0] ) )
								);
								?>
							</li>
							<li class="ok">
								<?php
								printf(
									__( '<strong>Add ons:</strong> We provide <a href="%s">add ons and plugins</a>. Each of them is intended to work with user oriented features.', 'jaiko' ),
									get_post_type_archive_link( 'add-on' )
								);
								?>
							</li>
							<li class="ng">
								<?php
								printf(
									__( '<strong>Support Forum:</strong> In progress. You will be able to ask anything there!', 'jaiko' )
								);
								?>
							</li>
							<li class="ng">
								<?php
								printf(
									__( '<strong>Private Chat:</strong> In Progress. You might have some secret information. So, aks us privately!', 'jaiko' )
								);
								?>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>

		<div class="front-block">
			<div class="container">

				<h2 class="front-title">
					Our load maps
				</h2>
				<p class="front-lead">
					We have plans for making our WordPress super social
				</p>
				<div class="row">
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">nature_people</i><br/>
							Natural UX
						</h3>
						<p class="front-block-lead">
							WordPress is blog tool. So, authors and users are separated. Admin screen is complicated for
							ordinary user.
							We are creating plugins which are well integrated with Gianism and make user experience
							better.
						</p>
					</div>
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">compare_arrows</i><br/>
							1 to 1
						</h3>
						<p class="front-block-lead">
							All interactive actions on WordPress are author-centered like comment.
							Social web site requires 1 to 1 communication like message, chat and non-verbal "like".
							Besides that, we need notification system. Of course, we are ahead toward them.
						</p>
					</div>
					<div class="col s12 m4">
						<h3 class="front-block-title">
							<i class="material-icons">phone_iphone</i><br/>
							Mobile Apps
						</h3>
						<p class="front-block-lead">
							As long as we know, there are few solution to use WordPress as Mobile App's backend.
							WP REST API is the one, but there are many things to integrate a bunch of plugins to it.
							We think all our plugins should be REST API ready.
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
