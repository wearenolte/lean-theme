<?php

namespace Lean;

/**
 * Class for initialize all the backend classes.
 *
 * @package Lean
 */
class Backend {
	/**
	 * Base backend path
	 *
	 * @var string
	 */
	private static $backend_path;

	/**
	 * Directories with the classes.
	 *
	 * @var array
	 */
	private static $directories = [
		'WP',
		'WP/CPT',
		'WP/Endpoints',
		'WP/Gutenberg',
		'WP/Taxonomies',
	];

	/**
	 * Init class.
	 */
	public static function init() {
		self::$backend_path = get_template_directory() . '/backend/';

		foreach ( self::$directories as $directory ) {
			self::autoload_classes( $directory );
		}

		self::include_functions();
	}

	/**
	 * Auto load classes in directory.
	 *
	 * @param array $directory The directories to load the classes from.
	 */
	private static function autoload_classes( $directory ) {
		$directory_path = self::$backend_path . $directory;

		foreach ( glob( $directory_path . '/*.php' ) as $file ) {
			$class_path = str_replace( '/', '\\', $directory );
			$class      = '\\' . __NAMESPACE__ . '\\' . $class_path . '\\' . basename( $file, '.php' );

			if ( method_exists( $class, 'init' ) ) {
				call_user_func( [ $class, 'init' ] );
			}
		}
	}

	/**
	 * Load all the php files from the functions folder.
	 */
	private static function include_functions() {
		$directory_path = self::$backend_path . 'functions';

		foreach ( glob( $directory_path . '/*.php' ) as $file ) {
			include $file;
		}
	}
}
