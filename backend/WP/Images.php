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
		add_action( 'init', [ __CLASS__, 'set_image_sizes' ] );
		add_filter( 'intermediate_image_sizes_advanced', [ __CLASS__, 'remove_default_image_sizes' ] );
	}

	/**
	 * Set image sizes.
	 */
	public static function set_image_sizes() {
		$ratios = [
			'portrait'       => [
				'ratio'  => 3 / 4,
				'widths' => [
					'' => 255,
				],
			],
			'landscape'      => [
				'ratio'  => 4 / 3,
				'widths' => [
					'' => 350,
				],
			],
			'landscape-wide' => [
				'ratio'  => 16 / 9,
				'widths' => [
					'' => 510,
				],
			],
		];

		foreach ( $ratios as $ratio_name => $ratio ) {
			foreach ( $ratio['widths'] as $width_name => $width ) {
				add_image_size(
					$ratio_name . ( $width_name ? ".$width_name" : '' ),
					$width,
					$width * ( 1 / $ratio['ratio'] ),
					true
				);
			}
		}
	}

	/**
	 * Remove default image sizes
	 *
	 * @param array $sizes Full list of sizes.
	 * @return array
	 */
	public static function remove_default_image_sizes( $sizes ) : array {
		unset( $sizes['medium'] );
		unset( $sizes['large'] );
		unset( $sizes['medium_large'] );
		unset( $sizes['1536x1536'] );
		unset( $sizes['2048x2048'] );

		return $sizes;
	}
}
