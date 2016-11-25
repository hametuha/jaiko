<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<p><?php _e( 'We can\'t find any contents. URL is wrong or no translation available. Search form might help you.', 'jaiko' ) ?></p>

		<img class="no-content" src="<?= get_stylesheet_directory_uri() ?>/assets/img/bg-not-found.png" alt="" />

	</div><!-- .page-content -->
</section><!-- .no-results -->
