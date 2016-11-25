<?php get_header(); ?>

<?php if ( is_author() ) {
	get_template_part( 'template-parts/biography' );
} ?>

<section class="archive-wrapper">

	<div class="container">

		<div class="row">

			<div class="col s12 l9 archive-list">

				<div class="archive-header">
					<h1 class="archive-header-title"><?php the_archive_title() ?></h1>
				</div>

				<?php get_template_part( 'template-parts/language', 'changer' ) ?>

				<?php if ( ! is_user_logged_in() ) {
					jaiko_ad( 'after-title' );
				} ?>

				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/loop', get_post_type() );
					}
					jaiko_pagination();
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?>
			</div>

			<div class="col s12 l3 sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ) ?>
			</div>

		</div>

	</div>

</section>

<?php get_footer(); ?>

