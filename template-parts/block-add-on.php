<section class="add-ons">

<div class="container">

	<h2 class="add-ons-title"><?php _e( 'Our Plugins', 'jaiko' ) ?></h2>

	<div class="row">

		<?php
		$args = [
			'post_type' => 'add-on',
			'posts_per_page' => 3,
			'post_status' => 'publish',
		    'post_parent' => 0,
			'orderby' => [ 'menu_order' => 'DESC' ],
		];
		if ( is_singular( 'add-on' ) ) {
			$args['post__not_in'] = [ get_queried_object_id() ];
		}
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="col s12 m4">';
				get_template_part( 'template-parts/card' );
				echo '</div>';
			}
			wp_reset_postdata();
		}
		?>
	</div>

	<div class="add-ons-link">
		<a class="add-ons-btn" href="<?= get_post_type_archive_link( 'add-on' ) ?>"><?php esc_html_e( 'See All Plugins', 'jaiko' ) ?></a>
	</div>

</div>



</section>
