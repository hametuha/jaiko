<?php
/**
 * Regression test for the production outage on 2026-10-28.
 *
 * bbPress hooked bbp_get_theme_compat_excerpt() to get_the_excerpt with two
 * required arguments, while hooks/meta.php applied the filter with only one.
 *
 * @package Jaiko
 */

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class Jaiko_Excerpt_Filter_Test extends Jaiko_Template_TestCase {

	public function test_get_the_excerpt_passes_post() {
		$received = [];
		// Same signature as bbp_get_theme_compat_excerpt(): both arguments are required.
		add_filter( 'get_the_excerpt', function ( $excerpt, $post ) use ( &$received ) {
			$received[] = $post;
			return $excerpt;
		}, 10, 2 );

		$post = self::factory()->post->create( [
			'post_content' => 'Gianism makes your WordPress social.',
			'post_excerpt' => '',
		] );
		$this->assertRenderedPage( $this->render( get_permalink( $post ) ) );
		$this->assertNotEmpty( $received, 'get_the_excerpt should be applied for OGP.' );
		$this->assertSame( $post, get_post( $received[0] )->ID );
	}
}
