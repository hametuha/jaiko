<?php
/**
 * Function and hooks
 */

load_theme_textdomain( 'jaiko', get_stylesheet_directory() . '/languages' );

add_action( 'init', function () {
	wp_register_style( 'twentysixteen-default', get_template_directory_uri() . '/style.css', [], wp_get_theme( 'twentysixteen' )->get( 'Version' ) );
	wp_register_style( 'twentysixteen-style', get_stylesheet_directory_uri() . '/assets/css/style.css', [ 'twentysixteen-default', 'mailchimp-style' ], wp_get_theme()->get( 'Version' ) );

	// Mail chimp
	wp_register_style( 'mailchimp-style', '//cdn-images.mailchimp.com/embedcode/classic-10_7.css', [], null );
	wp_register_script( 'mailchimp-script', '//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js', [], null, true );
	$script = <<<JS
(function($) {
window.fnames = new Array();
window.ftypes = new Array();
fnames[0]='EMAIL';
ftypes[0]='email';
fnames[1]='FNAME';
ftypes[1]='text';
fnames[2]='LNAME';
ftypes[2]='text';
fnames[4]='SINGUP';
ftypes[4]='text';
}(jQuery));
JS;

	wp_add_inline_script( 'mailchimp-script', $script );
} );

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'mailchimp-script' );
} );

/**
 * Echo Google analytics tag
 */
add_action( 'wp_head', function () {
	?>
	<script>
		(function (i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		<?php if ( is_user_logged_in() ) : ?>
		ga('set', 'userId', <?= get_current_user_id() ?>);
		<?php endif; ?>
		ga('create', 'UA-1766751-11', 'auto');
		ga('send', 'pageview');

	</script>
	<?php
}, 99 );


/**
 * Register post type
 */
add_action( 'init', function() {
	register_post_type( 'add-on', [
		'label'  => __( 'Add On', 'jaiko' ),
	    'public' => true,
	    'has_archive' => true,
	    'supports' => [ 'title', 'editor', 'thumbnail', 'author' ],
	    'rewrite' => [
	    	'with_front' => false,
	    ],
	] );
} );

/**
 * Add menu item
 *
 * @param array $items
 * @param array $args
 * @return array
 */
add_filter( 'wp_nav_menu_objects', function( $items, $args ){
	if ( 'primary' == $args->theme_location ) {
		if ( is_user_logged_in() ) {
			$user = get_userdata( get_current_user_id() );
			$name = get_the_author_meta( 'first_name', $user->ID ) ?: $user->display_name;
			$title = sprintf( __( 'Hi, %s!', 'jaiko' ), $name );
			$url   = admin_url( 'profile.php' );
		} else {
			$title = __( 'Try It!', 'jaiko' );
			$url   = wp_login_url( $_SERVER['REQUEST_URI'] );
		}
		$items[] = (object) [
			'ID' => 0,
			'post_author' => '1',
			'post_date' => '2016-11-05 18:20:00',
			'post_date_gmt' => '2016-11-05 09:20:00',
			'post_content' => '',
			'post_title' => $title,
			'post_excerpt' => '',
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			'post_password' => '',
			'post_name' => 'try-it',
			'to_ping' => '',
			'pinged' => '',
			'post_modified' => '2016-11-05 18:20:00',
			'post_modified_gmt' => '2016-11-05 09:20:00',
			'post_content_filtered' => '',
			'post_parent' => 1,
			'guid' => 'https://local.gianism.info/?p=17',
			'menu_order' => 1,
			'post_type' => 'nav_menu_item',
			'post_mime_type' => '',
			'comment_count' => '0',
			'filter' => 'raw',
			'db_id' => 0,
			'menu_item_parent' => '0',
			'object_id' => '0',
			'object' => 'page',
			'type' => 'post_type',
			'type_label' => __( 'Login', 'jaiko' ),
			'url' => $url,
			'title' => $title,
			'target' => '',
			'attr_title' => '',
			'description' => '',
			'classes' => [ 'menu-item', 'menu-item-login' ],
			'xfn' => '',
			'rel' => 'nofollow',
			'current' => false,
			'current_item_ancestor' => false,
			'current_item_parent' => false,
		];
	}
	return $items;
}, 10, 2 );

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

add_filter( 'show_admin_bar', function(){
	return current_user_can( 'administrator' );
} );

add_action( 'wp_footer', function(){
	?>
	<script>
		jQuery(document).ready(function($) {
			$('.bogo-language-switcher li').each( function(index, li) {
				if ( !$(li).hasClass('current') && !$(li).find('a').length ) {
					$(li).addClass('no-translation');
				}
			} );
		} );
	</script>
	<?php
}, 11 );
