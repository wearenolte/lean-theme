<?php namespace LeanNs;

/**
 * Class Options
 */
class Options
{
	const OPTIONS_SLUG = 'options';

	/**
	 * Init
	 */
	public static function init() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( [
				'page_title' => 'Options',
				'menu_title' => 'Options',
				'menu_slug' => self::OPTIONS_SLUG,
				'capability' => 'edit_posts',
				'redirect' => false,
				'position' => 4,
			] );
		}

		add_filter( 'timber_context', [ __CLASS__, 'add_to_timber_context' ] );
	}

	/**
	 * Add all options to the Timber context.
	 *
	 * @param array $data The original data.
	 * @return array
	 */
	public static function add_to_timber_context( $data ) {
		$data['options'] = \Lean\Acf::get_option_field();

		return $data;
	}
}
