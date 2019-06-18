<?php

namespace Lean\WP\Gutenberg;

/**
 * Gutenberg editor configurations.
 */
class Editor {
	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'after_setup_theme', [ __CLASS__, 'config_font_sizes' ] );
		add_action( 'after_setup_theme', [ __CLASS__, 'config_colors' ] );
	}

	/**
	 * Config font sizes.
	 */
	public static function config_font_sizes() {
		$font_sizes = [
			[
				'name' => 'Small',
				'size' => 12,
				'slug' => 'small',
			],
			[
				'name' => 'Regular',
				'size' => 16,
				'slug' => 'regular',
			],
			[
				'name' => 'Large',
				'size' => 20,
				'slug' => 'large',
			],
			[
				'name' => 'Huge',
				'size' => 40,
				'slug' => 'huge',
			],
		];

		add_theme_support( 'editor-font-sizes', $font_sizes );

		/**
		 *  This disables the fonts option.
		 * add_theme_support( 'disable-custom-font-sizes' );
		 */
	}

	/**
	 * Remove default font colors.
	 */
	public static function config_colors() {
		$colors = [
			[
				'name'  => 'White',
				'slug'  => 'white',
				'color' => '#FFFFFF',
			],
			[
				'name'  => 'Black',
				'slug'  => 'black',
				'color' => '#000000',
			],
			[
				'name'  => 'Primary',
				'slug'  => 'primary',
				'color' => '#FF3333',
			],
			[
				'name'  => 'Secondary',
				'slug'  => 'secondary',
				'color' => '#F2F4F4',
			],
		];

		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'editor-color-palette', $colors );
	}
}
