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
		add_filter( 'nav_menu_submenu_css_class', [ __CLASS__, 'add_submenu_depth_class' ], 10, 3 );
		add_filter( 'wp_nav_menu_objects', [ __CLASS__, 'count_menu_items' ], 10, 3 );
		// Enable HTML in the Menu Item's description field.
		remove_filter( 'nav_menu_description', 'strip_tags' );
		add_filter( 'wp_setup_nav_menu_item', [ __CLASS__, 'enable_html_to_description_field' ], 10 );
	}

	/**
	 * Function that register the creation of the menus and a small description
	 * about each.
	 */
	protected static function get_menus() {
		return [
			'main_menu'          => 'Main Menu',
			'footer_bottom_menu' => 'Footer Menu - Bottom',
		];
	}

	/**
	 * Adds a class with the submenu depth.
	 *
	 * @param array  $classes The current classes.
	 * @param object $args    The args passed into the wp_nav_menu function.
	 * @param int    $depth   The current submenu depth.
	 *
	 * @return array The submenu classes.
	 */
	public static function add_submenu_depth_class( $classes, $args, $depth ) {
		$classes[] = 'sub-menu-lvl-' . esc_attr( $depth );

		return $classes;
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
			$atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . $args->a_class_current;
		} elseif ( isset( $args->a_class ) ) {
			$atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . $args->a_class;
		}

		return $atts;
	}

	/**
	 * Counts the number of menu items in each level.
	 *
	 * @param array $sorted_menu_items The menu items.
	 * @return mixed
	 */
	public static function count_menu_items( $sorted_menu_items ) {
		foreach ( $sorted_menu_items as &$item ) {
			$item->_children_count = 0;

			for ( $index = 1, $length = count( $sorted_menu_items ); $index <= $length; ++$index ) {
				if ( (int) $sorted_menu_items[ $index ]->menu_item_parent === $item->ID ) {
					$item->_children_count++;
				}
			}
		}

		foreach ( $sorted_menu_items as &$item ) {
			$item->_parent_children_count = 0;

			for ( $index = 1, $length = count( $sorted_menu_items ); $index <= $length; ++$index ) {
				if ( (int) $item->menu_item_parent === $sorted_menu_items[ $index ]->ID ) {
					$item->_parent_children_count = $sorted_menu_items[ $index ]->_children_count;
					break;
				}
			}
		}
		unset( $item );
		return $sorted_menu_items;
	}

	/**
	 * Enable HTML in the Menu Item's description field
	 *
	 * @param object $menu_item The menu item.
	 *
	 * @return mixed
	 */
	public static function enable_html_to_description_field( $menu_item ) {
		if ( isset( $menu_item->post_type ) ) {
			if ( 'nav_menu_item' === $menu_item->post_type ) {
				$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
			}
		}

		return $menu_item;
	}
}
