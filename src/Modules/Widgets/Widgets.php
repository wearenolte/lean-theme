<?php namespace LeanNs\Modules\Widgets;

use Timber\Timber;

/**
 * Class Widgets
 */
class Widgets
{
	/**
	 * This is the list of default WP widgets which we will allow.
	 * You should edit this to only allow the widgets which you theme can handle (for which you have styles, etc).
	 *
	 * @var array
	 */
	private static $allowed_wp_widgets = [
		'WP_Widget_Text',
		'WP_Widget_Categories',
	];

	/**
	 * Init
	 */
	public static function init() {
		$defaults = [
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
		];

		register_sidebar( array_merge( $defaults, [
			'id' => 'main',
			'name' => 'Main',
			'description' => 'Appears below the content on mobile and to the right on desktop',
		] ) );

		add_action( 'widgets_init', [ __CLASS__, 'unregister_all' ], 11 );

		add_action( 'widgets_init', [ __CLASS__, 'register' ], 12 );

		add_filter( 'timber_context', [ __CLASS__, 'add_to_timber_context' ] );
	}

	/**
	 * Add all sidebars to the Timber context.
	 *
	 * @param array $data The original data.
	 * @return array
	 */
	public static function add_to_timber_context( $data ) {
		global $sidebars_widgets;

		$data['sidebars'] = [];

		foreach ( $sidebars_widgets as $widget_area => $widgets ) {
			if ( 'wp_inactive_widgets' === $widget_area || false !== strpos( $widget_area, 'orphaned_widgets' ) ) {
				continue;
			}

			$data['sidebars'][ $widget_area ] = Timber::get_widgets( $widget_area );
		}

		return $data;
	}

	/**
	 * Unregister all unavailable widgets. We don't want to show widgets if we haven't styled them.
	 */
	public static function unregister_all() {
		global $wp_widget_factory;

		foreach ( $wp_widget_factory->widgets as $widget => $class ) {
			if ( ! in_array( $widget, self::$allowed_wp_widgets, true ) ) {
				unregister_widget( $widget );
			}
		}
	}

	/**
	 * Register all the widgets found in this folder.
	 */
	public static function register() {
		foreach ( glob( __DIR__ . '/*.php' ) as $file ) {
			$class = '\\' . __NAMESPACE__ . '\\' . basename( $file, '.php' );

			if ( is_a( $class, 'Lean\Widgets\Models\AbstractWidget', true ) ) {
				register_widget( $class );
			}
		}
	}

	/**
	 * Escape HTML for before/after widgets and widget titles.
	 *
	 * @param string $wrapper The  HTML wrapper.
	 * @param array  $allowed_tags Override the allowed tags.
	 */
	public static function esc_widget_wrapper_e( $wrapper, $allowed_tags = [] ) {
		$default_allowed_tags = [ 'div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ];

		$default_allowed = [];

		foreach ( $default_allowed_tags as $tag ) {
			$default_allowed[ $tag ] = [
				'class' => [],
				'id' => [],
			];
		}

		$allowed_tags = isset( $allowed_tag ) ? $allowed_tags : $default_allowed;

		echo wp_kses( $wrapper, $allowed_tags );
	}
}
