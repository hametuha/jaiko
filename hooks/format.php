<?php

add_filter( 'show_admin_bar', function(){
	return current_user_can( 'administrator' );
} );

/**
 * Add login style
 */
add_action( 'login_head', function(){
	?>
	<style>
		.login h1 a{
			background: url("<?= get_stylesheet_directory_uri() ?>/assets/img/identity/wp-login.png") center center no-repeat;
			background-size: cover;
		}
		body{
			background-color: #F4B700;
		}
	</style>
	<?php
} );

/**
 * Pagination
 */
add_filter('wp_link_pages', function( $output ){
	return preg_replace_callback( '#<ul>(.*?)</ul>#us', function($match){
		$pages = array_map( function( $link ){
			$link = trim( $link );
			if ( is_numeric( $link ) ) {
				return sprintf( '<li class="active"><a>%d</a></li>', $link );
			} else {
				return sprintf( '<li class="waves-effect">%s</li>', $link );
			}
		}, explode( '|||', $match[1] ) );

		return sprintf( '<ul class="pagination">%s</ul>', implode( "\n", $pages ) );
	}, $output );
});

