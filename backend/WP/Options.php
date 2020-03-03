<?php

namespace Lean\WP;

/**
 * Class Options
 */
class Options {
	const OPTIONS_SLUG = 'options';

	/**
	 * Init
	 */
	public static function init() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'page_title' => 'Options',
					'menu_title' => 'Options',
					'menu_slug'  => self::OPTIONS_SLUG,
					'capability' => 'edit_users', // Only visible to admins.
					'redirect'   => false,
					'position'   => 4,
				]
			);
		}
	}
}
