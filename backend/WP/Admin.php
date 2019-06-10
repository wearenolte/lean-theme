<?php

namespace Lean\WP;

/**
 * General admin interface
 */
class Admin {
	/**
	 * Init.
	 */
	public static function init() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'admin_menu', [ __CLASS__, 'hide_menu_items' ] );
		add_filter( 'wpseo_metabox_prio', [ __CLASS__, 'yoast_priority' ] );
	}

	/**
	 * Function that hides menu items from the users that does not have
	 * the administrator role.
	 */
	public static function hide_menu_items() {
		if ( self::is_administrator( \wp_get_current_user() ) ) {
			return;
		}
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'themes.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php' );
	}

	/**
	 * Function that test if the user has the administrator role
	 *
	 * @param \WP_User $user The user to test.
	 *
	 * @return bool true if the user has the administrator role false otherwise.
	 */
	public static function is_administrator( \WP_User $user ) {
		return in_array( 'administrator', $user->roles, true );
	}

	/**
	 * Change the priority used for the YOAST SEO Meta Box so ACF Boxes and other
	 * components or meta fields.
	 *
	 * @return string The new priority
	 */
	public static function yoast_priority() {
		return 'low';
	}
}
