<?php

namespace Lean\Models;

use Lean\Backend;
use Lean\Models\Post;

/**
 * Singleton for retrieving Posts data.
 */
class Posts {
	/**
	 * Class singleton instance
	 *
	 * @var Backend
	 */
	private static $instance;

	/**
	 * Initialize singleton.
	 *
	 * @return Backend
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Return WP_Query.
	 *
	 * @param array $args The custom WP_query arguments.
	 *
	 * @return \WP_Query
	 */
	public static function query( array $args = [] ) {
		$default_args = [
			'fields'                 => 'ids',
			'posts_per_page'         => 50,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		];

		return new \WP_Query( wp_parse_args( $args, $default_args ) );
	}

	/**
	 * Return all posts formatted.
	 *
	 * @param array $args The custom WP_query arguments.
	 *
	 * @return array
	 */
	public static function get_all( array $args = [] ) {
		$query = self::query( $args );

		return self::format_data( $query->posts );
	}

	/**
	 * Return a formatted array of posts.
	 *
	 * @param array $posts The posts.
	 *
	 * @return array
	 */
	public static function format_data( array $posts ) {
		$data = [];

		foreach ( $posts as $post_id ) {
			$current_post = new Post( $post_id );

			$data['post_id']   = $current_post->post->ID;
			$data['title']     = $current_post->post->post_title;
			$data['permalink'] = get_permalink( $current_post->post->ID );
		}

		return $data;
	}
}
