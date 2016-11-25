<div class="author-info">

	<div class="container">

		<div class="author-section">

			<?= get_avatar( get_the_author_meta( 'user_email' ), 128, '', get_the_author(), [ 'class' => 'author-image circle' ] ); ?>

			<div class="author-content">
				<h2 class="author-title">
					<span class="author-title-label">
						<?php if ( is_front_page() ) : ?>
							<?php _e( 'Who meade this site?', 'jaiko' ); ?>
						<?php else : ?>
							<?php _e( 'Author:', 'twentysixteen' ); ?>
						<?php endif; ?>
					</span>
					<?php echo get_the_author(); ?>
				</h2>
				<p class="author-desc">
					<?php the_author_meta( 'description' ); ?>
				</p>
				<?php if ( ! is_author() ) : ?>
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
				   class="waves-effect waves-light btn">
					<?php _e( 'See articles', 'jaiko' ) ?> <i class="material-icons right">chevron_right</i>
				</a>
				<?php endif; ?>
			</div>

			<div style="clear:both;"></div>
			
		</div>

	</div>
</div>
