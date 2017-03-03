<?php get_header();
the_post(); ?>


<main class="article-wrapper">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="article-thumbnail">
			<?php the_post_thumbnail() ?>
		</div>
	<?php endif; ?>

	<article class="article-body container">

		<div class="article-header">

			<?php if ( ! is_page() ) : ?>
				<div
					class="article-header-badge article-header-badge-<?= get_post_type() ?>"><?= esc_html( get_post_type_object( get_post_type() )->label ) ?></div>
			<?php endif; ?>
			<h1>
				<?php the_title() ?>
			</h1>

			<p class="article-meta">
				<?php if ( is_singular( 'post' ) ) : ?>
					<i class="material-icons">today</i> <?php the_date( __( 'F j, Y', 'jaiko' ) ) ?>
				<?php endif; ?>
				<?php if ( $categories = get_the_category() ) : ?>
					<?php foreach ( $categories as $term ) : ?>
						<a class="chip" href="<?= get_term_link( $term ) ?>">
							<?= esc_html( $term->name ) ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if ( $tags = get_the_tags() ) : ?>
					<?php foreach ( $tags as $term ) : ?>
						<a class="chip" href="<?= get_term_link( $term ) ?>">
							<?= esc_html( $term->name ) ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
			</p>
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

		<?php get_template_part( 'template-parts/block', 'download' ) ?>

		<div class="article-content">
			<?php the_content(); ?>
			<div style="clear:both;"></div>
		</div>

		<?php get_template_part( 'template-parts/block', 'toc' ); ?>

		<?php get_template_part( 'template-parts/warifu' ); ?>

	</article>

	<?php if ( 'post' == get_post_type() ) {
		get_template_part( 'template-parts/share' );
	} ?>

	<?php get_template_part( 'template-parts/block', 'related' ) ?>

	<?php get_template_part( 'template-parts/biography' ); ?>

	<section class="comment-list-section">
		<div class="container">
			<?php comments_template() ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>
