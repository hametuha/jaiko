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

				<?php if ( has_excerpt() ) : ?>
					<div class="forum-excerpt">
						<?php the_excerpt() ?>
					</div>
				<?php endif; ?>

				<?php jaiko_ad( 'after-title' ); ?>

				<div class="forum-content">
					<?php the_content(); ?>
					<div style="clear:both;"></div>
				</div>

				<?php jaiko_restore_bogo_url() ?>

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

