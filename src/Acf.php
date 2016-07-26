<?php namespace Leanp;

/**
 * Set-up ACF.
 */
class Acf {
	/**
	 * The folder in which JSON files are saved.
	 *
	 * @var string
	 */
	public static $json_folder = '';

	/**
	 * Init.
	 */
	public static function init() {
		self::$json_folder = get_template_directory() . '/acf';

		add_filter( 'acf/settings/save_json', [ __CLASS__, 'save_json' ] );
		add_filter( 'acf/settings/load_json', [ __CLASS__, 'load_json' ] );
	}

	/**
	 * Get the path for saving ACF JSON.
	 *
	 * @return string
	 */
	public static function save_json() {
		return self::$json_folder;
	}

	/**
	 * Add our path to the locations to load ACF JSON from.
	 *
	 * @param array $paths The paths.
	 * @return array
	 */
	public static function load_json( $paths ) {
		unset( $paths[0] );
		$paths[] = self::$json_folder;
		return $paths;
	}
}
