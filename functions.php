<?php namespace LeanNs;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

// Constants.
define( 'LEANP_THEME_NAME', 'LeanName' );
define( 'LEANP_THEME_VERSION', '0.1.0' );
define( 'LEANP_MINIMUM_WP_VERSION', '4.3.1' );
define( 'LEANP_TEXT_DOMAIN', 'lean-text-domain' );

// Composer autoload.
require_once get_template_directory() . '/vendor/autoload.php';

// Run the theme setup.
require_once get_template_directory() . '/Setup.php';
\LeanNs\ThemeSetup::init();

add_filter( 'loader_directories', function( $directories ) {
	$directories[] = get_template_directory() . '/patterns';
	return $directories;
});

add_filter('loader_alias', function( $alias ) {
	$alias['atom'] = 'atoms';
	$alias['molecule'] = 'molecules';
	$alias['organism'] = 'organisms';
	return $alias;
});
