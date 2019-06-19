<?php

/**
 * Main class loader for initializing and  setting up the plugin.
 *
 * @since 0.1.0
 */
class ThemeSetup {

	/**
	 * Initialise the program after everything is ready.
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		add_action( 'init', [ __CLASS__, 'init_assets' ] );
		add_action( 'init', [ __CLASS__, 'init_gutenberg_custom_assets' ] );
		add_action( 'switch_theme', [ __CLASS__, 'flush_rewrite_rules' ] );
		add_action( 'after_switch_theme', [ __CLASS__, 'activate' ] );
		add_filter( 'lean_assets_include_jquery', '__return_true' );
	}

	/**
	 * Checks program environment to see if all dependencies are available. If at least one
	 * dependency is absent, deactivate the theme.
	 *
	 * @since 0.1.0
	 */
	public static function activate() {
		global $wp_version;

		if ( version_compare( $wp_version, LEAN_MINIMUM_WP_VERSION, '<' ) ) {
			if ( is_admin() ) :
				add_action(
					'admin_notices',
					function() {
						?>
						<div class="notice notice-error">
							<p><?php echo esc_html( 'Please update WordPress!' ); ?></p>
						</div>
						<?php
					}
				);
			endif;
		}

		self::check_dependencies();
		self::flush_rewrite_rules();
		self::init_gutenberg_config();
	}

	/**
	 * Dependency checks
	 */
	public static function check_dependencies() {
		if ( is_admin() ) :
			require_once ABSPATH . 'wp-admin/includes/plugin.php';

			if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
				return;
			}

			add_action(
				'admin_notices',
				function () {
					?>
					<div class="notice notice-error">
						<p><?php echo esc_html( 'The ACF plugin is not active!' ); ?></p>
					</div>
					<?php
				}
			);
		endif;
	}

	/**
	 * Register the CPTs and flush the rewrite rules in order to have correct permalinks.
	 *
	 * @since 0.1.0
	 */
	public static function flush_rewrite_rules() {
		self::init();
		flush_rewrite_rules();
	}

	/**
	 * Init the CSS and JS assets.
	 */
	public static function init_assets() {
		$version = self::get_version_number();
		$assets  = new \Lean\Assets(
			[
				'css_uri'          => get_template_directory_uri() . '/frontend/dist/main.css',
				'css_version'      => $version,
				'js_uri'           => get_template_directory_uri() . '/frontend/dist/main.js',
				'automatic_suffix' => false,
			]
		);

		$assets->load();
	}

	/**
	 * Function that adds the custom CSS to the WP editor in the Dashboard.
	 */
	public static function init_gutenberg_custom_assets() {
		add_action(
			'enqueue_block_assets',
			function() {
			if ( is_admin() ) {
					wp_enqueue_style(
						'custom-styles-editor',
						get_stylesheet_directory_uri() . '/frontend/static/css/style.css',
						[
							'wp-edit-blocks',
						],
						'1.0'
					);
				}
			}
		);
	}

	/**
	 * Gutenberg configurations.
	 */
	public static function init_gutenberg_config() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5' );

		/**
		 * Add support for Gutenberg.
		 */

		// Wide/Fullwidth images.
		add_theme_support( 'align-wide' );

		// Responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Default Gutenberg styles on Frontend.
		add_theme_support( 'wp-block-styles' );

		// Disable Font Sizes by default.
		add_theme_support( 'editor-font-sizes' );
		add_theme_support( 'disable-custom-font-sizes' );

		// Disable Colors by default.
		add_theme_support( 'editor-color-palette' );
		add_theme_support( 'disable-custom-colors' );

		// Gutenberg config.
		$guten = require 'guten-config.php';

		// Custom Editor Font Sizes.
		if ( isset( $guten['font_sizes'] ) && ! empty( $guten['font_sizes'] ) ) {
			add_theme_support( 'editor-font-sizes', $guten['font_sizes'] );
		}

		// Custom Editor Colors.
		if ( isset( $guten['colors'] ) && ! empty( $guten['colors'] ) ) {
			add_theme_support( 'editor-color-palette', $guten['colors'] );
		}

		// Allowed Block Types.
		if ( isset( $guten['blocks'] ) && ! empty( $guten['blocks'] ) ) {
			add_filter(
				'allowed_block_types',
				function( $allowed_blocks, $post ) {
					$guten          = require 'guten-config.php';
					$allowed_blocks = [];

					foreach ( $guten['blocks'] as $post_type => $blocks ) {
						if ( 'common' === $post_type ) {
							$allowed_blocks = $blocks;
						} else {
							if ( $post->post_type === $post_type ) {
								$allowed_blocks = wp_parse_args( $allowed_blocks, $blocks );
							}
						}
					}

					return $allowed_blocks;
				},
				10,
				2
			);
		}
	}

	/**
	 * Function used to generate the version number based from the .deploy file.
	 */
	private static function get_version_number() {
		$version_number = time();
		$version_file   = get_stylesheet_directory() . '/vendor/wearenolte/buster/bin/.deploy.json';

		if ( file_exists( $version_file ) ) {
			ob_start();
			include $version_file;
			$contents = ob_get_clean();
			$json     = json_decode( $contents, true );

			if ( $json && isset( $json['version'] ) ) {
				$version_number = $json['version'];
			}
		}

		return $version_number;
	}
}
