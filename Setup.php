<?php namespace LeanNs;

/**
 * Main class loader for initializing and  setting up the plugin.
 *
 * @since 0.1.0
 */
class ThemeSetup {

	/**
	 * Initialise the program after everything is ready.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		add_action( 'switch_theme', [ __CLASS__, 'flush_rewrite_rules' ] );
		add_action( 'after_switch_theme', [ __CLASS__, 'activate' ] );

		$inc_dir = get_template_directory() . '/src';
		$modules_dir = get_template_directory() . '/src/Modules';

		// Run the init() function for any inc classes which have it.
		foreach ( glob( $inc_dir . '/*.php' ) as $file ) {
			$class = '\\' . __NAMESPACE__ . '\\' . basename( $file, '.php' );
			if ( method_exists( $class, 'init' ) ) {
				call_user_func( [ $class, 'init' ] );
			}
		}

		// Run the Module::init() function for any modules which have it.
		foreach ( glob( $modules_dir . '/*', GLOB_ONLYDIR ) as $dir ) {
			$module_name = basename( $dir );
			$module = '\\' . __NAMESPACE__ . '\\Modules\\' . $module_name . '\\' . $module_name;
			if ( method_exists( $module, 'init' ) ) {
				call_user_func( [ $module, 'init' ] );
			}
		}
	}

	/**
	 * Checks program environment to see if all dependencies are available. If at least one
	 * dependency is absent, deactivate the theme.
	 *
	 * @since 0.1.0
	 */
	public static function activate() {

		global $wp_version;

		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		if ( version_compare( $wp_version, LEANP_MINIMUM_WP_VERSION, '<' ) ) {

			$format = 'Plugin %1$s requires WordPress %2$s or higher.';
			$msg = sprintf( $format, LEANP_THEME_VERSION, LEANP_MINIMUM_WP_VERSION );
			trigger_error( esc_html( $msg ), E_USER_ERROR );
		}

		self::check_dependencies();
		self::flush_rewrite_rules();
	}

	/**
	 * Dependency checks
	 */
	public static function check_dependencies() {
		if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
			return;
		}

		error_log( 'The ACF plugin is not active!' );

		if ( is_admin() ) :
			add_action( 'admin_notices', function(){
		?>
			<div class="notice notice-error">
				<p><?php echo esc_html( 'The ACF plugin is not active!' ); ?></p>
			</div>
		<?php
			});
		endif;
	}

	/**
	 * Register the CPTs and flush the rewrite rules in order to have correct permalinks.
	 *
	 * @since 0.1.0
	 */
	public static function flush_rewrite_rules() {
		self::init();
		flush_rewrite_rules();
	}
}
