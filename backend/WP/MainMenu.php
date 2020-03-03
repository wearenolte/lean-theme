<?php

/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    https://wordpress.stackexchange.com/q/14037/
 * @author fuxia
 */
class MainMenu extends Walker_Nav_Menu {
	/**
	 * Start the element output.
	 *
	 * @param string       $output  Passed by reference. Used to append additional content.
	 * @param object       $item    Menu item data object.
	 * @param int          $depth   Depth of menu item. May be used for padding.
	 * @param array|object $args    Additional strings. Actually always an
	 *                              instance of stdClass. But this is WordPress.
	 * @param int          $item_id Current item ID.
	 *
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = [], $item_id = 0 ) {
		$classes = empty( $item->classes ) ? [] : (array) $item->classes;

		$class_names = join(
			' ',
			apply_filters(
				'nav_menu_css_class',
				array_filter( $classes ),
				$item,
				[]
			)
		);

		$description = '';

		if ( 0 === $depth ) {
			$max_submenus = self::count_max_submenus( 'main_menu', $item );

			$class_names .= ' has-submenu-lvl-' . $max_submenus;

			// Insert description for top level elements only.
			if ( $max_submenus ) {
				$description = self::create_submenu_container( $item );
			}
		}

		$class_names .= ' menu-items-' . $item->_children_count;

		$class_names = empty( $class_names ) ? '' : 'class="' . esc_attr( $class_names ) . '"';

		$output .= "<li id='menu-item-$item->ID' $class_names>";

		$attributes = sprintf(
			'title="%s" target="%s" rel="%s" href="%s"',
			$item->attr_title,
			$item->target,
			$item->xfn,
			$item->url
		);

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$item_output = ( $args->before ?? '' )
			. "<a $attributes>"
			. ( $args->link_before ?? '' )
			. $title
			. '</a> '
			. ( $args->link_after ?? '' )
			. $description
			. ( $args->after ?? '' );

		// Since $output is called by reference we don't need to return anything.
		$output .= apply_filters(
			'walker_nav_menu_start_el',
			$item_output,
			$item,
			$depth,
			$args
		);
	}

	/**
	 * Creates the submenu container HTML and styles.
	 *
	 * @param object $item The current menu item.
	 *
	 * @return string
	 */
	public static function create_submenu_container( object $item ) : string {
		return '<div class="sub-menu-container shadow-downward-right transition-settings-ease-out">
				<div class="container py-2.5">
				<div class="flex -mx-1">
				<div class="subnav-left-side">
				<h3 class="standard-headings pb-2">'
				. esc_attr( $item->title )
				. '</h3><div class="text-sm tracking-tight leading-normal">'
				. wp_kses_post( $item->description ) . '</div></div><div class="subnav-right-side">';
	}

	/**
	 * Check if the current menu item has a sub menu of 3 levels.
	 *
	 * @param string $menu_location     The menu location.
	 * @param object $current_menu_item The current menu item.
	 *
	 * @return int
	 */
	public static function count_max_submenus( string $menu_location, object $current_menu_item ) : int {
		$locations = get_nav_menu_locations();

		if ( isset( $locations[ $menu_location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_location ] );

			if ( $menu ) {
				$menu_items = wp_get_nav_menu_items( $menu->term_id );

				$max_submenus = 0;

				// Find the menu children items which has as parent the menu items of level 1.
				foreach ( $menu_items as $menu_item ) {
					if ( (int) $menu_item->menu_item_parent === $current_menu_item->ID ) {
						$child_menu_item_lvl_1 = $menu_item;

						$max_submenus = 1;

						// Find the menu children items which has as parent the menu items of level 2.
						foreach ( $menu_items as $menu_item2 ) {
							if ( $child_menu_item_lvl_1->ID === (int) $menu_item2->menu_item_parent ) {
								// If it reached max 2 submenus then simply return.
								return 2;
							}
						}
					}
				}

				return $max_submenus;
			}
		}

		return 0;
	}
}
