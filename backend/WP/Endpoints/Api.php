<?php

namespace Lean\WP\Endpoints;

/**
 * Function that is used to register the new endpoints used for the site.
 */
class Api {
	/**
	 * This class is auto loaded.
	 *
	 * Initialize endpoints
	 */
	public static function init() {
		self::add_filters();
	}

	/**
	 * Filters used to overwrite the default configuration of the endpoints.
	 */
	public static function add_filters() {
		add_filter(
			'nolte_endpoints_api_namespace',
			function () {
				return 'lean';
			}
		);

		add_filter(
			'nolte_endpoints_api_version',
			function () {
				return 'v1';
			}
		);
	}
}
