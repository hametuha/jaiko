<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$locale = 'ja' == get_locale() ? 'ja_JP' : 'en_US';
?>
<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '983379265125123',
			xfbml      : true,
			version    : 'v2.8'
		});
		FB.AppEvents.logPageView();
	};
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/<?= $locale ?>/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


<header class="header-nav" role="menubar">
	<nav role="navigation">
		<div class="nav-wrapper">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo center"
			   rel="home"><?php bloginfo( 'name' ); ?></a>
			<a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'header-menu right hide-on-med-and-down',
				'container'      => false,
			) );
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_class'     => 'side-nav',
				'menu_id'        => 'mobile-menu',
				'container'      => false,
			) );
			?>
		</div>
	</nav>

</header><!-- .site-header -->
