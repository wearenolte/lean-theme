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
		/**
		 * Uncomment to set the allowed blocks by code.
		 * add_filter( 'allowed_block_types', [ __CLASS__, 'config_allowed_blocks' ], 10, 2 );
		 */
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

	/**
	 * Returns the Gutenberg blocks that are allowed to be used in the editor.
	 *
	 * @param boolean  $allowed_blocks A boolean stating that all blocks are allowed.
	 * @param \WP_Post $post           The current post.
	 *
	 * @return array The allowed blocks.
	 */
	public static function config_allowed_blocks( $allowed_blocks, $post ) {
		$core_blocks = [
			'core/block',

			// Common blocks.
			'core/image',
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/gallery',
			'core/quote',
			'core/audio',
			'core/cover',
			'core/file',
			'core/video',

			// Layout Elements.
			'core/button',
			'core/columns',
			'core/media-text',
			'core/more',
			'core/page-break',
			'core/separator',
			'core/spacer',

			// Formatting.
			'core/table',
			'core/verse',
			'core/code',
			'core/html',
			'core/preformatted',
			'core/pullquote',

			// Widgets.
			'core/shortcode',
			'core/archives',
			'core/categories',
			'core/latest-comments',
			'core/latest-posts',
			'core/calendar',
			'core/rss',
			'core/search',
			'core/tag-cloud',

			// Embeds.
			'core/embed',
			'core-embed/twitter',
			'core-embed/youtube',
			'core-embed/facebook',
			'core-embed/instagram',
			'core-embed/wordpress',
			'core-embed/soundcloud',
			'core-embed/spotify',
			'core-embed/flickr',
			'core-embed/vimeo',
			'core-embed/animoto',
			'core-embed/cloudup',
			'core-embed/collegehumor',
			'core-embed/crowdsignal',
			'core-embed/dailymotion',
			'core-embed/hulu',
			'core-embed/imgur',
			'core-embed/issuu',
			'core-embed/kickstarter',
			'core-embed/meetup-com',
			'core-embed/mixcloud',
			'core-embed/reddit',
			'core-embed/reverbnation',
			'core-embed/screencast',
			'core-embed/scribd',
			'core-embed/slideshare',
			'core-embed/smugmug',
			'core-embed/speaker',
			'core-embed/ted',
			'core-embed/tumblr',
			'core-embed/videopress',
			'core-embed/wordpress-tv',
			'core-embed/amazon-kindle',
		];

		$custom_blocks = [
			'acf/button',
		];

		$all_blocks = array_merge(
			$core_blocks,
			$custom_blocks
		);

		switch ( $post->post_type ) {
			case 'post':
				$blocks_blacklist = [
					'core/button',
				];
				break;
			default:
				$blocks_blacklist = [
					'core/button',
				];
		}

		return array_values(
			array_diff(
				$all_blocks,
				$blocks_blacklist
			)
		);
	}
}
