<?php
/**
 * Posts helper functions.
 */

/**
 * Query posts and returns only the posts IDs by default.
 * Also applies the performance suggestions from https://10up.github.io/Engineering-Best-Practices/php/
 *
 * @param array $args The custom WP_query arguments.
 *
 * @return \WP_Query
 */
function ln_query_posts( array $args = [] ) {
	$default_args = [
		'fields'                 => 'ids',
		'posts_per_page'         => 50,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	];

	return new \WP_Query( wp_parse_args( $args, $default_args ) );
}
