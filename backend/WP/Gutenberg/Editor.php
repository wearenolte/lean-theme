<?php

namespace Lean\WP\Gutenberg;

use \Lean\WP\Gutenberg\DesignSystem;

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
		add_action( 'admin_head', [ __CLASS__, 'admin_css' ] );
	}

	/**
	 * Editor font sizes. We're completely disabling these options.
	 */
	public static function config_font_sizes() {
		$sizes = array_map(
			function( $name, $size ) {
				return [
					'name' => $name,
					'slug' => strtolower( str_replace( ' ', '-', $name ) ),
					'size' => $size * 16,
				];
			},
			array_keys( DesignSystem::EDITOR['FONT_SIZES'] ),
			DesignSystem::EDITOR['FONT_SIZES']
		);

		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'editor-font-sizes', $sizes );

		// Add the styles to make font sizes work.
		add_action(
			'wp_head',
			function() {
				$css = '';
				foreach ( DesignSystem::EDITOR['FONT_SIZES'] as $name => $size ) {
					$slug = strtolower( str_replace( ' ', '-', $name ) );
					$css .= "#wpbody .has-$slug-font-size{font-size:${size}rem;}";
				}
				echo '<style type="text/css">' . wp_kses_post( $css ) . '</style>';
			}
		);
	}

	/**
	 * Editor colors. Used for background and font colors.
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
			array_keys( DesignSystem::EDITOR['COLORS'] ),
			DesignSystem::EDITOR['COLORS']
		);

		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'editor-color-palette', $colors );

		// Add the styles to make bg colours work.
		add_action(
			'wp_head',
			function() {
				$css = '';
				foreach ( DesignSystem::EDITOR['COLORS'] as $name => $color ) {
					$slug = strtolower( str_replace( ' ', '-', $name ) );
					$css .= "#wpbody .has-$slug-color{color:$color;}";
					$css .= "#wpbody .has-$slug-background-color{background-color:$color;}";
					$css .= "#wpbody .has-$slug-background-color:after{background-color:$color;}";
				}
				echo '<style type="text/css">' . wp_kses_post( $css ) . '</style>';
			}
		);
	}

	/**
	 * Returns the Gutenberg blocks that are allowed to be used in the editor.
	 * Use the BlockSettings config to decide which core blocks to show. Plus show all custom blocks.
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
			array_keys( BlockSettings::CORE_BLOCKS ),
			BlockSettings::CORE_BLOCKS
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

	/**
	 * Hide the alignment options for all custom blocks by default.
	 *
	 * @return void
	 */
	public static function admin_css() {
		echo '<style>[data-type*="acf/"] [aria-label="Change alignment"] {display: none;}</style>';
	}
}
