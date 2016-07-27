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









//
//
//
//
//use Lean\Config;
//use Lean\Assets;
//
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
///**
// * Action created to add theme supports or specific of the theme.
// */
//add_action( 'after_setup_theme', function(){
//	add_theme_support( 'post-thumbnails' );
//});
//
///**
// * Action that adds the styles from the theme to the editor in order to see the
// * same styles from the front end in the dashboard on the editor section.
// */
//add_action( 'after_setup_theme', function(){
//	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
//		add_editor_style( _THEME_PATH_ . '/assets/css/style.css' );
//	} else {
//		add_editor_style( _THEME_PATH_ . '/assets/css/style-min.css' );
//	}
//});
//
///**
// * Action that is responsable for register the menus used on the theme.
// */
//add_action( 'after_setup_theme', function(){
//	register_nav_menu(
//		'primary-navigation',
//		__( 'Primary Menu', _TEXT_DOMAIN_ )
//	);
//});
//
///**
// * This actions register the assets and some configuration about the assets
// * in order to load the CSS and JS files into the theme.
// */
//add_action( 'after_setup_theme', function() {
//	$args = [
//		'css_version' => false,
//		'js_version' => time(),
//		'theme_path' => _THEME_URL_,
//	];
//	$assets = new Assets( $args );
//	$assets->load();
//});
//
//add_filter('loader_alias', function( $alias ) {
//	$alias['partial'] = 'partials';
//	return $alias;
//});
