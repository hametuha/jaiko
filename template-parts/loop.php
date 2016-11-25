<div class="card horizontal archive-item">
	<div class="card-image archive-item-thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'thumbnail' ) ?>
		<?php else : ?>
			<img width="150" height="150" src="<?= get_stylesheet_directory_uri() ?>/assets/img/identity/wp-login.png" alt="" />
		<?php endif; ?>
	</div>
	<div class="card-stacked">
		<div class="card-content">
			<h2 class="archive-item-title">
				<?php the_title() ?>
				<small>
					<?= esc_html( get_post_type_object( get_post_type() )->label )?>
					by
					<?php the_author() ?>
				</small>
			</h2>
			<div>
				<?php foreach ( get_the_category() as $term ) : ?>
				<a class="chip" href="<?= get_term_link( $term ) ?>">
					<?= esc_html( $term->name ) ?>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="card-action archive-item-action">
			<a class="btn waves-effect" href="<?php the_permalink() ?>"><?php _e( 'Read this article', 'jaiko' ) ?></a>
		</div>
	</div>
</div>
