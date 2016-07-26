<?php namespace Leanp\Modules\Widgets;

/**
 * Class Widgets
 */
class Widgets {
	/**
	 * Init
	 */
	public static function init() {
		register_sidebar( [
			'id' => 'footer',
			'name' => 'Footer',
			'description' => 'Footer Widget area.',
		] );
	}
}
