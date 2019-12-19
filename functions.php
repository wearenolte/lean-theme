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
