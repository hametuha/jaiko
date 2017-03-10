<div class="card loop-card">
	<div class="card-image">
		<?php the_post_thumbnail( 'medium' ) ?>
		<span class="card-title"><?php the_title() ?></span>
	</div>
	<div class="card-content">
		<?php the_excerpt() ?>
	</div>
	<div class="card-action">
		<a class="btn waves-effect deep-orange" href="<?php the_permalink() ?>">
			<?php _e( 'Check this add on', 'jaiko' ) ?>
		</a>
	</div>
</div>
