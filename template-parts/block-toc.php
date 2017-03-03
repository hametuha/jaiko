<?php
if ( ( $label = jaiko_how_to_read() ) ) {
	?>

	<div class="chiramise-instruction">
		<?= $label; ?>
	</div>
	<div class="row chiramise-row">
		<div class="col s12 m6">
			<h2 class="chiramise-list-title"><?php _e( 'Table Of Contents', 'jaiko' ) ?></h2>
			<div class="chiramise-list">
				<?php chiramise_the_toc( '.article-content' ); ?>
			</div>
		</div>
		<div class="col s12 m6">
			<div class="follow-ad">
				<?php jaiko_ad( 'after-content' ) ?>
			</div>
		</div>
	</div>

	<?php

} else {
	wp_link_pages( array(
		'before'      => '<div class="link-pages"><span class="link-pages-title">' . sprintf( __( 'Pages of %s', 'jaiko' ), get_the_title() ) . '</span><ul>',
		'after'       => '</ul></div>',
		'link_before' => '',
		'link_after'  => '',
		'pagelink'    => '%',
		'separator'   => '|||',
	) );
}
?>

