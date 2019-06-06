<?php use LeanNs\ThemeSetup;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

// Constants.
define( 'LEANP_THEME_NAME', 'LeanName' );
define( 'LEANP_THEME_VERSION', '0.1.0' );
define( 'LEANP_MINIMUM_WP_VERSION', '4.3.1' );

// Composer autoload.
require_once get_template_directory() . '/vendor/autoload.php';
require_once get_template_directory() . '/Setup.php';
ThemeSetup::init();

// Run the theme setup.
add_filter( 'loader_directories', function( $directories ) {
	$directories[] = get_template_directory() . '/frontend';
	return $directories;
});

add_filter('loader_alias', function( $alias ) {
	$alias['atom'] = 'atoms';
	$alias['molecule'] = 'molecules';
	$alias['organism'] = 'organisms';
	$alias['template'] = 'templates';
	return $alias;
});

/**
 * Function used to render custom tags from the admin into the site just after
 * the <body> tag.
 */
add_action( 'lean/before_header', function() {
	if ( function_exists( 'the_field' ) ) {
		the_field( 'general_options_google_tag_manager', 'option' );
	}
});

add_action( 'after_setup_theme', function() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5' );

	/**
	 * Add support for Gutenberg.
	 */

	// Wide/Fullwidth images.
	add_theme_support( 'align-wide' );

	// Responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Default Gutenberg styles on Frontend.
	add_theme_support( 'wp-block-styles' );

	// Disable Font Sizes by default.
	add_theme_support( 'editor-font-sizes' );
	add_theme_support( 'disable-custom-font-sizes' );

	// Disable Colors by default.
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );

	// Gutenberg config.
	$guten = require 'guten-config.php';

	// Custom Editor Font Sizes.
	if ( isset( $guten['font_sizes'] ) && ! empty( $guten['font_sizes'] ) ) {
		add_theme_support( 'editor-font-sizes', $guten['font_sizes'] );
	}

	// Custom Editor Colors.
	if ( isset( $guten['colors'] ) && ! empty( $guten['colors'] ) ) {
		add_theme_support( 'editor-color-palette', $guten['colors'] );
	}

	// Allowed Block Types.
	if ( isset( $guten['blocks'] ) && ! empty( $guten['blocks'] ) ) {
		add_filter( 'allowed_block_types', function( $allowed_blocks, $post ) {
			$guten = require 'guten-config.php';
			$allowed_blocks = [];
			foreach ( $guten['blocks'] as $post_type => $blocks ) {
				if ( 'common' === $post_type ) {
					$allowed_blocks = $blocks;
				} else {
					if ( $post->post_type === $post_type ) {
						$allowed_blocks = wp_parse_args( $allowed_blocks, $blocks );
					}
				}
			}

			return $allowed_blocks;
		}, 10, 2);
	}

	/**
	 * Function that adds the custom CSS to the WP editor in the Dashboard.
	 */
	add_action( 'enqueue_block_assets', function() {
		if ( is_admin() ) {
			wp_enqueue_style(
				'custom-styles-editor',
				get_stylesheet_directory_uri() . '/frontend/static/css/style.css',
				[
					'wp-edit-blocks',
				],
				'1.0'
			);
		}
	} );
});
