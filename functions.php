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

// Run the theme setup.
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

require_once get_template_directory() . '/Setup.php';
ThemeSetup::init();

/**
 * Use an icon from an icon sprite.
 *
 * @param string $id The ID of the icon.
 * @param string $class_name The name of the class to be used for the icon.
 */
function use_icon( $id = '', $class_name = '' ) {
?>
	<svg class="<?php echo esc_attr( $class_name ); ?>">
		<use xlink:href="#<?php echo esc_attr( $id ); ?>" />
	</svg>
<?php
}

/**
 * Function used to render custom tags from the admin into the site just after
 * the <body> tag.
 */
add_action( 'lean/before_header', function() {
	if ( function_exists( 'the_field' ) ) {
		the_field( 'general_options_google_tag_manager', 'option' );
	}
});

/**
 * Hook applied to before the header to load the sprite with the icons before
 * loading the sprite makes sure the file is present to prevent any error to
 * happen.
 */
add_action( 'lean/after_footer', function(){
	$icon_path = './patterns/static/icons/icons.svg';
	$sprite = get_theme_file_path( $icon_path );
	$content = file_exists( $sprite ) ? file_get_contents( $sprite ) : false;
	if ( $content ) {
		// @codingStandardsIgnoreStart
		printf( '<div class="visuallyhidden">%s</div>', $content );
		 // @codingStandardsIgnoreEnd
	}
});
