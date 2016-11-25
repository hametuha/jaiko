<?php

/**
 * Register menus
 */
register_nav_menus( [
	'primary' => __( 'Header Navigation', 'jaiko' ),
	'social'  => __( 'Social Links', 'jaiko' ),
	'footer'  => __( 'Footer Links', 'jaiko' ),
] );

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'jaiko' ),
		'id'            => 'sidebar-widgets',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'jaiko' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title widget-title-sidebar">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Banners', 'jaiko' ),
		'id'            => 'banner-widgets',
		'description'   => __( 'Display banners', 'jaiko' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-banner %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title widget-title-banner">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'jaiko' ),
		'id'            => 'footer-widgets',
		'description'   => __( 'Footer blocks', 'jaiko' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title widget-title-footer">',
		'after_title'   => '</h2>',
	) );
} );
