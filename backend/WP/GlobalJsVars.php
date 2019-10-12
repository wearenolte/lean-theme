<?php

namespace Lean\WP;

/**
 * Add global JS variables.
 *
 * Used to communicate server data with the frontend.
 *
 * The vars are printed in the DOM.
 */
class GlobalJsVars {
	/**
	 * Init.
	 */
	public static function init() {
		/**
		 * Namespace used for the localize object.
		 */
		add_filter(
			'lean_assets_localize_script',
			function () {
				return 'lean';
			}
		);

		/**
		 * Localize the dynamic data that is going to be available for the Front End or
		 * via the browser.
		 */
		add_filter(
			'lean_assets_localize_data',
			function () {
				return [
					'api_url' => '/wp-json/lean/v1/',
				];
			}
		);
	}
}
