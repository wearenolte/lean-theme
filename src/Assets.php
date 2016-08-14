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
		add_filter( 'lean_assets_include_jquery', [ __CLASS__, 'include_jquery' ] );

		// Remove the following 2 lines if you need to use Gravity Form's JS hooks (jQuery is required).
		add_filter( 'gform_init_scripts_footer', '__return_true' );
		add_filter( 'gform_footer_init_scripts_filter', '__return_empty_string' );
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

	/**
	 * Whether or not to load jQuery for the current page.
	 * It only check if the page include a Gravity Forms shortcode, you'll have to add some custom logic if you're using
	 * gforms in a widget or php code.
	 *
	 * @param bool $include Include it or not.
	 * @return bool
	 */
	public static function include_jquery( $include ) {
		return self::post_has_gform() ? true : $include;
	}

	/**
	 * Does the current post have a Gravity Form.
	 *
	 * @return bool
	 */
	public static function post_has_gform() {
		global $post;
		return strpos( $post->post_content, '[gravityform' ) !== false;
	}
}
