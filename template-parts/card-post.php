<div class="card loop-card">
	<div class="card-image">
		<?php the_post_thumbnail( 'medium' ) ?>
		<span class="card-title"><?php the_title() ?></span>
	</div>
	<div class="card-content">
		<?php foreach ( get_the_category() as $term ) : ?>
			<a class="chip" href="<?= get_term_link( $term ) ?>">
				<?= esc_html( $term->name ) ?>
			</a>
		<?php endforeach; ?>
		<p class="list-item-meta">
			<i class="material-icons">schedule</i> <?php the_time( 'M j, Y' ) ?> by <?php the_author() ?>
		</p>
	</div>
	<div class="card-action">
		<a class="btn waves-effect deep-orange" href="<?php the_permalink() ?>">
			<?php _e( 'Read this article', 'jaiko' ) ?>
		</a>
	</div>
</div>
