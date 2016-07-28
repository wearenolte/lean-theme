<?php namespace LeanNs;

/**
 * Set-up Assets.
 */
class Assets
{
	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'after_setup_theme', [ __CLASS__, 'init_assets' ] );
	}

	/**
	 * Init the CSS and JS assets.
	 */
	public static function init_assets() {
		$assets = new \Lean\Assets( [
			'css_uri' => get_template_directory_uri() . '/patterns/public/css/style.css',
			'css_version' => time(),
			'js_uri' => get_template_directory_uri() . '/xxx/script.js',
			'js_version' => time(),
			'jquery_uri' => '//code.jquery.com/jquery-2.2.4.min.js',
			'jquery_version' => '2.2.4',
		] );

		$assets->load();
	}
}
