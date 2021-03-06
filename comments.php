<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments" class="comment-list-title">
		<?php _e( 'Feedbacks', 'jaiko' ) ?>
	</h3>

	<p class="comment-list-desc">
		<?php
		if ( 1 == get_comments_number() ) {
			/* translators: %s: post title */
			printf( __( 'One response to %s' ), '&#8220;' . get_the_title() . '&#8221;' );
		} else {
			/* translators: 1: number of comments, 2: post title */
			printf( _n( '%1$s response to %2$s', '%1$s responses to %2$s', get_comments_number() ),
				number_format_i18n( get_comments_number() ), '&#8220;' . get_the_title() . '&#8221;' );
		}
		?>
	</p>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ul class="comment-list">
		<?php wp_list_comments( [
			'style' => 'ul',
		] ); ?>
	</ul>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e( 'Comments are closed.' ); ?></p>

	<?php endif; ?>
<?php endif; ?>

<?php comment_form(); ?>
