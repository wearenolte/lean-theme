<?php namespace Leanp;
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

// Constants.
define( 'LEANP_THEME_NAME', 'Leanp Plugin' );
define( 'LEANP_THEME_VERSION', '0.1.0' );
define( 'LEANP_MINIMUM_WP_VERSION', '4.3.1' );
define( 'LEANP_TEXT_DOMAIN', 'leanp' );

// Composer autoload.
require_once get_template_directory() . '/vendor/autoload.php';

// Run the theme setup.
require_once get_template_directory() . '/ThemeSetup.php';
$class_name = __NAMESPACE__ . '\\ThemeSetup';
$class_name::init();



///**
// * Action to load the configuration file and define constant values, this action
// * has priority of 1 in order to be executed before any other action using the
// * defined constant values on the config.php file.
// */
//add_action( 'after_setup_theme', function(){
//	global $twig;
//
//	include 'config.php';
//	load_theme_textdomain( _TEXT_DOMAIN_ , _THEME_PATH_ . '/languages' );
//
//
//	$loader = new Twig_Loader_Filesystem( __DIR__ . '/patterns/source/_patterns');
//
//	$twig = new Twig_Environment($loader, array(
//		'cache' => __DIR__ . 'twig_cache',
//	));
//
//
//}, 1);
//
