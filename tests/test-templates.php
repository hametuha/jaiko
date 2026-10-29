<?php
/**
 * Smoke tests: every template renders without a fatal error.
 *
 * The plugins the theme works with (bbPress, Bogo, Warifu, Gianism) are not
 * active here, which also checks the theme survives without them.
 *
 * @package Jaiko
 */

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class Jaiko_Templates_Test extends Jaiko_Template_TestCase {

	public function test_front_page() {
		$front = self::factory()->post->create( [
			'post_type'    => 'page',
			'post_title'   => 'Front',
			'post_content' => 'Gianism makes your WordPress social.',
		] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front );
		self::factory()->post->create_many( 8 );
		$this->assertRenderedPage( $this->render( home_url( '/' ) ) );
	}

	public function test_front_page_without_posts() {
		$front = self::factory()->post->create( [
			'post_type' => 'page',
		] );
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front );
		$this->assertRenderedPage( $this->render( home_url( '/' ) ) );
	}

	public function test_single_post() {
		$post = self::factory()->post->create( [
			'post_content' => 'Post body without excerpt.',
		] );
		$this->assertRenderedPage( $this->render( get_permalink( $post ) ) );
	}

	public function test_add_on() {
		$add_on = self::factory()->post->create( [
			'post_type' => 'add-on',
		] );
		$this->assertRenderedPage( $this->render( get_permalink( $add_on ) ) );
	}

	public function test_page() {
		$page = self::factory()->post->create( [
			'post_type' => 'page',
		] );
		$this->assertRenderedPage( $this->render( get_permalink( $page ) ) );
	}

	public function test_blog_index() {
		self::factory()->post->create_many( 3 );
		$this->assertRenderedPage( $this->render( home_url( '/?post_type=post' ) ) );
	}

	public function test_category_archive() {
		$cat = self::factory()->category->create();
		self::factory()->post->create( [
			'post_category' => [ $cat ],
		] );
		$this->assertRenderedPage( $this->render( get_category_link( $cat ) ) );
	}

	public function test_search() {
		self::factory()->post->create( [
			'post_title' => 'Social login',
		] );
		$this->assertRenderedPage( $this->render( home_url( '/?s=social' ) ) );
	}

	public function test_404() {
		$this->assertRenderedPage( $this->render( home_url( '/?p=999999' ) ) );
	}
}
