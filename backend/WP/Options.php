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
					'capability' => 'edit_posts',
					'redirect'   => false,
					'position'   => 4,
				]
			);

			add_filter( 'acf/options_page/settings', [ __CLASS__, 'acf_options_page_settings' ] );
		}
	}

	/**
	 * Set options page only visible to admins.
	 *
	 * @param array $page_settings The filter options.
	 *
	 * @return array
	 */
	public static function acf_options_page_settings( array $page_settings ) {
		$page_settings['capability'] = 'edit_themes';

		return $page_settings;
	}
}
