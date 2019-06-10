<?php

namespace Lean;

/**
 * Class for initialize all the backend classes.
 *
 * @package Lean
 */
class Backend {
	/**
	 * Class singleton instance
	 *
	 * @var Backend
	 */
	private static $instance;

	/**
	 * Directories with the classes.
	 *
	 * @var array
	 */
	private static $directories = [
		'Models',
		'WP',
		'WP/CPT',
		'WP/Endpoints',
		'WP/Gutenberg',
		'WP/Taxonomies',
	];

	/**
	 * Initialize singleton.
	 *
	 * @return Backend
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * UserRoles constructor.
	 */
	private function __construct() {
		foreach ( self::$directories as $directory ) {
			self::autoload_classes( $directory );
		}
	}

	/**
	 * Auto load classes in directory.
	 *
	 * @param array $directory The directories to load the classes from.
	 */
	private function autoload_classes( $directory ) {
		$directory_path = get_template_directory() . '/backend/' . $directory;

		foreach ( glob( $directory_path . '/*.php' ) as $file ) {
			$class_path = str_replace( '/', '\\', $directory );
			$class      = '\\' . __NAMESPACE__ . '\\' . $class_path . '\\' . basename( $file, '.php' );

			if ( method_exists( $class, 'init' ) ) {
				call_user_func( [ $class, 'init' ] );
			}
		}
	}
}
