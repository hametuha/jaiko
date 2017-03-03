<?php
// --------------------------
//
// Build query here!
//
//
if ( is_singular( 'post' ) ) {
	$query = [
		__( 'Recent Posts', 'jaiko' ) => [
			'post_type'    => 'post',
			'post__not_in' => [ get_the_ID() ],
		],
		__( 'Recommended', 'jaiko' )  => [
			'relates_to' => get_the_ID(),
		],
	];
	$links = [
		get_permalink( get_option( 'page_for_posts' ) ),
		home_url( sprintf( 'relates/to/%d/', get_the_ID() ) ),
	];
} elseif ( is_singular( 'add-on' ) ) {
	$category = get_the_category();
	if ( ! $category ) {
		return;
	}
	list( $cat ) = $category;
	$query = [
		__( 'Tips', 'warifu' ) => [
			'post_type' => 'post',
			'cat' => $cat->term_id,
			'tag' => 'tips',
		],
		__( 'FAQ', 'warifu' ) => [
			'post_type'   => 'post',
			'cat' => $cat->term_id,
			'tag' => 'faq',
		],
	];
	$links = [
		home_url( sprintf( '/tips/of/%s/', $cat->slug ) ),
		home_url( sprintf( '/faq/of/%s/', $cat->slug ) ),
	];
} else {
	// Do nothing
	return;
}

?>
<section class="related">

	<div class="container">

		<div class="row">
			<?php
			$counter = 0;
			foreach ( $query as $title => $q ) {
				$query = array_merge( [
					'lang' => ( 'ja' == get_locale() ? 'ja' : 'en_US' ),
					'post_status->publish',
					'posts_per_page' => 3,
				], $q );
				?>
				<div class="col s12 m6">
					<h2 class="related-title"><?= esc_html( $title ) ?></h2>
					<?php
					$sub_query = new WP_Query( $query );
					if ( $sub_query->have_posts() ) :
						?>
						<ul class="collection">
							<?php
							while ( $sub_query->have_posts() ) {
								$sub_query->the_post();
								get_template_part( 'template-parts/list', get_post_type() );
							}
							wp_reset_postdata();
							?>
						</ul>
						<?php if ( isset( $links[ $counter ] ) && $links[ $counter ] ) : ?>
						<p class="center">
							<a href="<?= esc_url( $links[ $counter ] ) ?>"
							   class="waves-effect btn-flat btn-large waves-teal">
								<?php _e( 'See All', 'jaiko' ) ?>
							</a>
						</p>
					<?php endif; ?>
					<?php else : ?>
					<p class="related-none">
						<?php esc_html_e( 'Sorry, but no post found.', 'jaiko' ) ?>
					</p>
					<?php endif; ?>
				</div>
				<?php
				$counter++;
			}
			?>
		</div>
	</div>
</section>
