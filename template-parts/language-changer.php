<?php
$label = is_singular() ? jaiko_no_translation() : '';
if ( $label ) :
	?>
	<div class="no-translation">
		<?php echo wp_kses_post( $label ); ?>
	</div>
	<?php
else :
	echo do_shortcode( '[bogo]' );
endif;
?>
