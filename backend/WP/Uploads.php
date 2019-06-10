<?php

namespace Lean\WP;

/**
 * Util class with methods used for uploads.
 */
class Uploads {

	/**
	 * Initialization of the class
	 */
	public static function init() {
		add_filter( 'upload_mimes', [ __CLASS__, 'allow_svg' ] );
	}

	/**
	 * Update the default mime types used on the site.
	 *
	 * @param array $mimes The allowed mimes to be uploaded.
	 *
	 * @return array
	 */
	public static function allow_svg( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
}

