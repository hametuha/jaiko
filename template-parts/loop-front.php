<div class="collection-item list-item">
	<a href="<?php the_permalink() ?>" class="list-item-link">
		<i class="material-icons list-item-arrow">chevron_right</i>
		<div class="list-item-content">
			<h3 class="list-item-title"><?php the_title() ?>
				<?php foreach ( get_the_category() as $cat ) : ?>
				<small>
					<?= esc_html( $cat->name ) ?>
				</small>
				<?php endforeach; ?>
			</h3>
			<p class="list-item-meta">
				<i class="material-icons">schedule</i> <?php the_time( 'M j, Y' ) ?>
				by <?php the_author() ?>
			</p>
		</div>
		<div style="clear:both"></div>
	</a>
</div>
