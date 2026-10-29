<?php
// ------------------------------
//
// Bundle sections
//
//
$bundles = jaiko_bundles();
// Look up parents only when this add-on has no bundles.
$parents = $bundles ? [] : jaiko_get_bundle_parents();
if ( $bundles ) :
	?>

	<div class="bundles-wrap">

		<div class="bundles-header">
			<h2 class="bundles-title"><?php _e( 'Bundled Plugins', 'jaiko' ); ?></h2>
			<p class="bundles-desc">
				<?php printf( __( 'This license provides you %s!', 'jaiko' ), sprintf( _n( '%d more plugin', '%d more plugins', count( $bundles ), 'jaiko' ), count( $bundles ) ) ); ?>
			</p>
		</div>

		<div class="row">
			<?php
			foreach ( $bundles as $post ) :
				setup_postdata( $post );
				?>
				<div class="col s12 m4">
					<?php get_template_part( 'template-parts/card' ); ?>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>

	</div><!-- // bundles-wrap -->

	<?php
	// ------------------------------
	//
	// Bundle Parents
	//
	//
elseif ( $parents ) :
	?>

	<div class="bundles-wrap">
		<div class="bundles-header">
			<h2 class="bundles-title"><?php _e( 'Get Bundle Package', 'jaiko' ); ?></h2>
			<p class="bundles-desc">
				<?php printf( __( 'This plugin is included in %s!', 'jaiko' ), sprintf( _n( '%d bundle', '%d bundles', count( $parents ), 'jaiko' ), count( $parents ) ) ); ?>
			</p>
		</div>

		<div class="row">
			<?php
			foreach ( $parents as $post ) :
				setup_postdata( $post );
				?>
				<div class="col s12 m4">
					<?php get_template_part( 'template-parts/card' ); ?>
				</div>
				<?php
			endforeach;
			wp_reset_postdata();
			?>
		</div>

	</div><!-- // bundles-wrap -->

	<?php
endif;
