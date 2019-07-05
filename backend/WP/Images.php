<?php

namespace Lean\WP;

/**
 * Set the Image Sizes.
 */
class Images {
	/**
	 * Init method.
	 */
	public static function init() {
		add_action( 'init', [ __CLASS__, 'add_image_sizes' ] );
	}

	/**
	 * Image Sizes.
	 */
	public static function add_image_sizes() {
		// Container Image Size.
		add_image_size( '1140', 1140, 9999 );
		add_image_size( '1140@2x', 2280, 9999 );
	}
}
