<?php

namespace Lean\WP\Gutenberg;

/**
 * Gutenberg editor configurations.
 *
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
class Editor {
	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'after_setup_theme', [ __CLASS__, 'config_font_sizes' ] );
		add_action( 'after_setup_theme', [ __CLASS__, 'config_colors' ] );
		add_filter( 'allowed_block_types', [ __CLASS__, 'config_allowed_blocks' ], 10, 2 );
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
		$colors = array_map(
			function( $name, $color ) {
				return [
					'name'  => $name,
					'slug'  => strtolower( str_replace( ' ', '-', $name ) ),
					'color' => $color,
				];
			},
			array_keys( \Lean\WP\Gutenberg\DesignSystem::EDITOR_COLORS ),
			\Lean\WP\Gutenberg\DesignSystem::EDITOR_COLORS
		);

		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'editor-color-palette', $colors );

		// Add the styles to make bg colours work.
		add_action(
			'wp_head',
			function() {
				$css = '';
				foreach ( \Lean\WP\Gutenberg\DesignSystem::EDITOR_COLORS as $name => $color ) {
					$slug = strtolower( str_replace( ' ', '-', $name ) );
					$css .= ".has-$slug-background-color:after{background-color:$color;}";
				}
				echo '<style type="text/css">' . wp_kses_post( $css ) . '</style>';
			}
		);
	}

	/**
	 * Returns the Gutenberg blocks that are allowed to be used in the editor.
	 * Use the CoreBlocks config to decide which core blocks to show. Plus show all custom blocks.
	 *
	 * @param boolean  $allowed_blocks A boolean stating that all blocks are allowed.
	 * @param \WP_Post $post           The current post.
	 *
	 * @return array The allowed blocks.
	 */
	public static function config_allowed_blocks( $allowed_blocks, $post ) {

		$core_blocks = array_map(
			function( $block_name, $settings ) {
				if ( is_array( $settings ) && $settings['active'] ) {
					return $block_name;
				}
				return false;
			},
			array_keys( \Lean\WP\Gutenberg\CoreBlocks::CONFIG ),
			\Lean\WP\Gutenberg\CoreBlocks::CONFIG
		);
		$core_blocks = array_filter( $core_blocks );

		$custom_block_path = get_template_directory() . '/backend/WP/Gutenberg/Blocks';
		$custom_blocks     = [];

		foreach ( glob( $custom_block_path . '/*.php' ) as $file ) {
			$class           = '\Lean\WP\Gutenberg\Blocks\\' . basename( $file, '.php' );
			$block           = new $class();
			$custom_blocks[] = 'acf/' . call_user_func( [ $block, 'get_name' ] );
		}

		return array_merge( $core_blocks, $custom_blocks );
	}
}
