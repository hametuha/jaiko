<?php
/**
 * Base test case for rendering theme templates.
 *
 * @package Jaiko
 */

/**
 * Render a URL through wp-includes/template-loader.php, as a real request does.
 *
 * get_header() loads header.php with require_once, so each test must run in
 * its own process. Otherwise only the first test executes wp_head.
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
abstract class Jaiko_Template_TestCase extends WP_UnitTestCase {

	/**
	 * Render the URL with the theme and return the HTML.
	 *
	 * @param string $url URL to render.
	 * @return string
	 */
	protected function render( $url ) {
		$this->go_to( $url );
		// Avoid wp_redirect() + exit in the middle of the test.
		remove_action( 'template_redirect', 'redirect_canonical' );
		$level = ob_get_level();
		ob_start();
		require ABSPATH . WPINC . '/template-loader.php';
		// WordPress 6.9+ opens its own template enhancement buffer. Flush it into ours.
		while ( ob_get_level() > $level + 1 ) {
			ob_end_flush();
		}
		return ob_get_clean();
	}

	/**
	 * Assert the HTML was rendered to the end.
	 *
	 * @param string $html Rendered HTML.
	 */
	protected function assertRenderedPage( $html ) {
		$this->assertStringContainsString( '<head', $html, 'wp_head should be rendered.' );
		$this->assertStringContainsString( '</html>', $html, 'Template should be rendered to the end.' );
	}
}
