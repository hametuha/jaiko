<?php
if ( is_singular() &&  $label = jaiko_no_translation() ) :
	?>
	<div class="no-translation">
		<?= $label ?>
	</div>
	<?php
else :
	echo do_shortcode( '[bogo]' );
endif;  ?>

