<?php namespace LeanNs;

/**
 * Class that register the menu locations to be used with the site.
 */
class Menus
{
	/**
	 * Function that creates all the menus locations
	 */
	public static function init() {
		register_nav_menus( self::get_menus() );

		add_filter( 'timber_context', [ __CLASS__, 'add_to_timber_context' ] );
	}

	/**
	 * Function that register the creation of the menus and a small description
	 * about each.
	 */
	protected static function get_menus() {
		return [
			'main_menu' => 'Main Menu',
		];
	}

	/**
	 * Add all menus to the Timber context.
	 *
	 * @param array $data The original data.
	 * @return array
	 */
	public static function add_to_timber_context( $data ) {
		$data['menus'] = [];

		foreach ( self::get_menus() as $menu_slug => $menu_name ) {
			$data['menus'][ $menu_slug ] = new \Timber\Menu( $menu_slug );
		}

		return $data;
	}
}
