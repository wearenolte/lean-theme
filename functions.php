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
});

