<?php get_header(); ?>

<?php the_post(); ?>

<section class="page-wrapper">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-thumbnail">
			<?php the_post_thumbnail() ?>
		</div>
	<?php endif; ?>

	<div class="container">

		<div class="row">


			<article class="col s12 l9 article-body">

				<div class="article-header">
					<h1>
						<?php the_title() ?>
					</h1>
				</div>

				<?php get_template_part( 'template-parts/language', 'changer' ) ?>



				<?php if ( has_excerpt() ) : ?>
					<div class="article-excerpt">
						<?php the_excerpt() ?>
					</div>
				<?php endif; ?>

				<?php if ( ! is_user_logged_in() ) {
					jaiko_ad( 'after-title' );
				} ?>

				<div class="article-content">
					<?php the_content(); ?>
					<div style="clear:both;"></div>
				</div>

				<section class="comment-list-section">
					<div class="container">
						<?php comments_template() ?>
					</div>
				</section>

			</article>

			<div class="col s12 l3 sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ) ?>
			</div>

		</div>

	</div>

</section>

<?php get_footer(); ?>

