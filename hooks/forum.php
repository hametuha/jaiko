<?php

//add_action( 'init', function( ) {
//	if ( ! is_user_logged_in() ) {
//		return;
//	}
//	$locale = get_user_locale( get_current_user_id() );
//	if ( 'ja' == $locale ) {
//		// Change locale
//		/** @var WP_Locale_Switcher $wp_locale_switcher */
//		global $wp_locale_switcher;
//		$wp_locale_switcher->switch_to_locale( 'ja' );
//	}
//} );
//
/**
 * Change forum template.
 */
add_filter( 'template_include', function( $path ) {
	if ( is_bbpress() ) {
		$path = get_template_directory() . '/forum-template.php';
	}
	if ( get_template_directory() . '/page.php' == $path ) {
		// Singular template is got.
		if ( ! is_page() ) {
//			if ( is_user_logged_in() && 'ja' == get_user_locale( get_current_user_id() ) ) {
//				remove_filter( 'home_url', 'bogo_home_url' );
//				add_filter( 'bogo_lang_slug', 'jaiko_bogo_url_fixer', 10, 2 );
//			}

		}
	}
	return $path;
} );

/**
 * Remove bbPress styles
 */
//add_action( 'wp_enqueue_scripts', function() {
//	wp_dequeue_style( 'bbp-default' );
//	wp_dequeue_style( 'bbp-default-rtl' );
//}, 15 );


/**
 * Add forum category
 */
add_filter( 'bbp_register_topic_post_type', function( $arg ) {
	$arg['taxonomies'] = [ 'category' ];
	return $arg;
} );

/**
 * Add category pull down
 */
add_action( 'bbp_theme_after_topic_form_content', function() {
	$categories = get_the_category();
	$cat_id = 0;
	if ( $categories ) {
		$cat_id = current( $categories )->term_id;
	}
	printf( '<label for="bbp_topic_category">%s</label><br>', __( 'Topic Category', 'jaiko' ) );
	wp_dropdown_categories( [
		'show_option_none' => __( 'Please select category', 'jaiko' ),
		'option_none_value' => 0,
		'hide_empty' => false,
		'name' => 'bbp_topic_category',
		'selected' => $cat_id,
	] );
} );

/**
 * Save new topic
 *
 * @ignore
 * @param int $topic_id
 */
function _jaiko_save_extra_fields( $topic_id ) {
	if ( isset( $_POST['bbp_topic_category'] ) ) {
		$cat_id = (int) $_POST['bbp_topic_category'];
		if ( $cat_id ) {
			$category = get_category( $cat_id );
			if ( ! $category || is_wp_error( $cat_id ) ) {
				$cat_id = 0;
			}
		}
		// If 0, category should be uncategorized.
		if ( ! $cat_id ) {
			$cat_id = (int) get_option( 'default_category' );
		}
		// Set category
		wp_set_object_terms( $topic_id, $cat_id, 'category' );
	}
}
add_action( 'bbp_new_topic', '_jaiko_save_extra_fields', 10, 1 );
add_action( 'bbp_edit_topic', '_jaiko_save_extra_fields', 10, 1 );


/**
 * Show category
 */
add_action( 'bbp_template_before_single_topic', function() {
	if ( $categories = get_the_category() ) : ?>
		<div class="bbp-category-block">
		<?php foreach ( $categories as $term ) : ?>
			<a class="chip" href="<?= get_term_link( $term ) ?>">
				<?= esc_html( $term->name ) ?>
			</a>
		<?php endforeach; ?>
		</div>
	<?php endif;
} );
