<?php

namespace Lean\WP;

/**
 * Class that register the menu locations to be used with the site.
 */
class Menus {
	/**
	 * Function that creates all the menus locations
	 */
	public static function init() {
		register_nav_menus( self::get_menus() );
		add_filter( 'nav_menu_css_class', [ __CLASS__, 'add_additional_class_to_li' ], 10, 3 );
		add_filter( 'nav_menu_link_attributes', [ __CLASS__, 'add_additional_class_to_a' ], 10, 3 );
	}

	/**
	 * Function that register the creation of the menus and a small description
	 * about each.
	 */
	protected static function get_menus() {
		return [
			'main_menu' => 'Main Menu',
		];
	}

	/**
	 * Add class to the each li in a menu if the 'li_class' attribute is passed.
	 *
	 * @param array $classes The current classes.
	 * @param array $item    The current menu item.
	 * @param array $args    The args passed into the wp_nav_menu function.
	 */
	public static function add_additional_class_to_li( $classes, $item, $args ) {
		if ( array_search( 'current_page_item', $classes, true ) && isset( $args->li_class_current ) ) {
			$classes[] = $args->li_class_current;
		} elseif ( isset( $args->li_class ) ) {
			$classes[] = $args->li_class;
		}

		return $classes;
	}

	/**
	 * Add class to the each a in a menu if the 'a_class' attribute is passed.
	 *
	 * @param array $atts The current attributes.
	 * @param array $item The current menu item.
	 * @param array $args The args passed into the wp_nav_menu function.
	 */
	public static function add_additional_class_to_a( $atts, $item, $args ) {
		if ( array_search( 'current_page_item', $item->classes, true ) && isset( $args->a_class_current ) ) {
			$atts['class'] .= ' ' . $args->a_class_current;
		} elseif ( isset( $args->a_class ) ) {
			$atts['class'] .= ' ' . $args->a_class;
		}

		return $atts;
	}
}
