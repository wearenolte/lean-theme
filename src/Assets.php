<?php namespace LeanNs;

/**
 * Set-up Assets.
 */
class Assets {
	const FLICKITY_HANDLE = 'flickity';

	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'after_setup_theme', [ __CLASS__, 'init_assets' ] );
		add_filter( 'lean_assets_include_jquery', '__return_true' );

		// Remove the following 2 lines if you need to use Gravity Form's JS hooks (jQuery is required).
		add_filter( 'gform_init_scripts_footer', '__return_true' );
		add_filter( 'gform_footer_init_scripts_filter', '__return_empty_string' );
	}

	/**
	 * Init the CSS and JS assets.
	 */
	public static function init_assets() {
		$version = self::get_version_number();
		$assets = new \Lean\Assets( [
			'css_uri' => get_template_directory_uri() . '/frontend/static/css/style.css',
			'css_version' => $version,
			'js_uri' => get_template_directory_uri() . '/frontend/static/js/main.js',
			'js_version' => $version,
			'jquery_uri' => get_template_directory_uri() . '/frontend/static/js/vendor.js',
			'jquery_version' => $version,
			'automatic_suffix' => false,
		] );

		$assets->load();
	}

	/**
	 * Function used to generate the version number based from the .deploy file.
	 */
	private static function get_version_number() {
		$version_number = time();
		$version_file = get_stylesheet_directory() . '/vendor/wearenolte/buster/bin/.deploy.json';
		if ( file_exists( $version_file ) ) {
			$str = file_get_contents( $version_file );
			$json = json_decode( $str, true );
			if ( $json && isset( $json['version'] ) ) {
				$version_number = $json['version'];
			}
		}
		return $version_number;
	}

	/**
	 * Whether or not to load jQuery for the current page.
	 * It only check if the page includes a Gravity Forms shortcode, you'll have to add some custom logic if you're using
	 * gforms in a widget or php code.
	 *
	 * @param bool $include Include it or not.
	 * @return bool
	 */
	public static function include_jquery( $include ) {
		return self::post_has_ajax_gform() ? true : $include;
	}

	/**
	 * Does the current post have a Gravity Form which uses the AJAX submit method.
	 *
	 * @return bool
	 */
	public static function post_has_ajax_gform() {
		global $post;

		$gf_pos = strpos( $post->post_content, '[gravityform' );

		if ( false === $gf_pos ) {
			return false;
		}

		$ajax_pos = strpos( $post->post_content, 'ajax="true"', $gf_pos );

		if ( false === $ajax_pos ) {
			return false;
		}

		$shortcode_end_pos = strpos( $post->post_content, ']', $ajax_pos );

		if ( $shortcode_end_pos < $ajax_pos ) {
			return false;
		}

		return true;
	}

	/**
	 * Tell Assets to enqueue the scripts for the Flickity slider.
	 */
	public static function enqueue_flickity() {
		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'enqueue_flickity_cb' ] );
	}

	/**
	 * Callback to actually enqueue the scripts.
	 */
	public static function enqueue_flickity_cb() {
		wp_enqueue_script( self::FLICKITY_HANDLE . '-js', 'https://unpkg.com/flickity@2.0/dist/flickity.pkgd.min.js', false, null, true );
		wp_enqueue_style( self::FLICKITY_HANDLE . '-css', 'https://unpkg.com/flickity@2.0/dist/flickity.min.css', false, null );
	}
}
