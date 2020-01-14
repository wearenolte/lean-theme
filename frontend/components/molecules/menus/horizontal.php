<?php

$menu_id        = $args['menu_id'] ?? false;
$theme_location = $args['theme_location'] ?? false;
$menu_source    = $menu_id ? 'menu' : 'theme_location';

wp_nav_menu(
	[
		$menu_source      => $menu_id ?? $theme_location,
		'container'       => false,
		'menu_class'      => 'hidden lg:block w-full lg:flex lg:items-end lg:items-center lg:w-auto pt-subsection-y lg:pt-0',
		'li_class'        => 'lg:inline-block lg:pl-menu-spacing lg:first:pl-0',
		'a_class_current' => 'text-black text-small hover:opacity-75 cursor-pointer uppercase',
		'a_class'         => 'text-white text-small hover:opacity-75 cursor-pointer uppercase',
	]
);
