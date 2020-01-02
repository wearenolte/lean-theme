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
			self::autoload_classes( $directory, 'init', false );
		}

		self::include_functions();
	}

	/**
	 * Auto load classes in directory.
	 *
	 * @param string $directory The directory to scan.
	 * @param string $function The function to call for each class found.
	 * @param bool   $instantiate Whether to instantiate the class (false if the function should be called in a static way).
	 * @return void
	 */
	public static function autoload_classes( $directory, $function, $instantiate ) {
		$directory_path = self::$backend_path . $directory;

		foreach ( glob( $directory_path . '/*.php' ) as $file ) {
			$class_path = str_replace( '/', '\\', $directory );
			$class      = '\\' . __NAMESPACE__ . '\\' . $class_path . '\\' . basename( $file, '.php' );

			if ( method_exists( $class, $function ) ) {
				if ( $instantiate ) {
					$class = new $class();
				}
				call_user_func( [ $class, $function ] );
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
