<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

use Lean\Backend;

// Constants.
define( 'LEAN_THEME_VERSION', '2.0.0' );
define( 'LEAN_MINIMUM_WP_VERSION', '5.2.1' );

// Composer autoload.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/ThemeSetup.php';
ThemeSetup::init();
Backend::init();

// Run the theme setup.
add_filter(
	'loader_directories',
	function ( $directories ) {
		$directories[] = get_template_directory() . '/frontend/components';

		return $directories;
	}
);

add_filter(
	'loader_alias',
	function ( $alias ) {
		$alias['atom']     = 'atoms';
		$alias['molecule'] = 'molecules';
		$alias['organism'] = 'organisms';
		$alias['template'] = 'templates';

		return $alias;
	}
);

/**
 * Function used to render custom tags from the admin into the site just after
 * the <body> tag.
 */
add_action(
	'lean/before_header',
	function () {
		if ( function_exists( 'the_field' ) ) {
			the_field( 'general_options_google_tag_manager', 'option' );
		}
	}
);

/**
 * Escapes same as wp_kses_post() but also inline SVG and image srcset.
 */
$allow_all_post_tags = array_merge(
	wp_kses_allowed_html( 'post' ),
	[
		'svg'      => [
			'class'           => true,
			'aria-hidden'     => true,
			'aria-labelledby' => true,
			'role'            => true,
			'xmlns'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
		],
		'g'        => [
			'fill' => true,
		],
		'title'    => [
			'title' => true,
		],
		'path'     => [
			'd'            => true,
			'fill'         => true,
			'stroke'       => true,
			'stroke-width' => true,
		],
		'polyline' => [
			'd'            => true,
			'fill'         => true,
			'points'       => true,
			'stroke'       => true,
			'stroke-width' => true,
		],
		'img'      => [
			'class'  => true,
			'src'    => true,
			'alt'    => true,
			'srcset' => true,
			'sizes'  => true,
		],
	]
);

/**
 * For escaping ACF text areas.
 */
$allow_break_tag = [
	'br' => '',
];

/**
 * Function for creating custom block categories.
 *
 * @param array $categories The array of block categories.
 * @return array
 */
function register_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'lean-theme-blocks',
				'title' => __( 'Lean Theme Blocks', 'lean-theme-blocks' ),
			),
		)
	);
}
add_filter( 'block_categories', 'register_block_category', 10, 2 );
