<li class="collection-item list-item">
	<a href="<?php the_permalink() ?>" class="list-item-link">
		<i class="material-icons list-item-arrow">chevron_right</i>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium', [ 'class' => 'list-item-image' ] ) ?>
		<?php else : ?>
			<img alt="" src="<?= get_stylesheet_directory_uri() ?>/assets/img/identity/wp-login.png" class="list-item-image" />
		<?php endif; ?>
		<div class="list-item-content">
			<h3 class="list-item-title"><?php the_title() ?><small><?= esc_html( get_post_type_object( get_post_type() )->label ) ?></small></h3>
			<p class="list-item-meta">
				<i class="material-icons">schedule</i> <?php the_time( 'M j, Y' ) ?>
			</p>
		</div>
		<div style="clear:both"></div>
	</a>
</li>
