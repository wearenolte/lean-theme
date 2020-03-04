<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

use Lean\Backend;
use LeanStyleguide\Styleguide;

// Constants.
define( 'LEAN_THEME_VERSION', '2.0.0' );
define( 'LEAN_MINIMUM_WP_VERSION', '5.2.1' );

// Composer autoload.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/ThemeSetup.php';
ThemeSetup::init();
Backend::init();

if ( WP_DEBUG ) {
	new Styleguide();

	add_action(
		'lean_styleguide_header',
		function () {
			// @codingStandardsIgnoreStart
			echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/frontend/styleguide.css" />';
			// Enqueue vimeo player plyr.
			echo '<script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>';
			echo '<link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />';
			// Enqueue flickity slider.
			echo '<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>';
			echo '<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />';
			// @codingStandardsIgnoreEnd
		}
	);

	/**
	 * Sets placeholder image ID value
	 */
	add_filter(
		'lean_styleguide_component_image_id',
		function() {
			return STYLEGUIDE_IMAGE_ID;
		}
	);
}


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
 * For escaping ACF text areas.
 */
$allow_break_tag = [
	'br' => '',
];

/**
 * Function used to add a placeholder for WP attachment image IDs in the styleguide.
 */
add_filter(
	'lean_styleguide_component_image_id',
	function() {
		return STYLEGUIDE_IMAGE_ID;
	}
);

