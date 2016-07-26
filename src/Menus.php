<?php namespace Leanp;

/**
 * Class that register the menu locations to be used with the site.
 */
class Menus {
	/**
	 * Function that creates all the menus locations
	 */
	public static function init() {
		register_nav_menus( self::get_menus() );
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
}
