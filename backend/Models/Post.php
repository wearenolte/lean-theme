<?php

namespace Lean\Models;

/**
 * Handles logic from a single post.
 */
class Post {
	/**
	 * The WP Post object.
	 *
	 * @var \WP_Post|null
	 */
	public $post;

	/**
	 * Load a Post by Post ID.
	 *
	 * @param int $post_id The Post ID.
	 */
	public function __construct( int $post_id ) {
		$this->post = get_post( $post_id );
	}

	/**
	 * Returns a formatted array of the Model's data.
	 *
	 * @return array
	 */
	public function format_data() {
		return [
			'post_id'   => $this->post->ID,
			'title'     => $this->post->post_title,
			'permalink' => get_permalink( $this->post->ID ),
		];
	}
}
