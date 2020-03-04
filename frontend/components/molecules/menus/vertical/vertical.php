<?php

$menu_id        = $args['menu_id'] ?? false;
$theme_location = $args['theme_location'] ?? false;
$menu_source    = $menu_id ? 'menu' : 'theme_location';

wp_nav_menu(
	[
		$menu_source      => $menu_id ?? $theme_location,
		'container'       => false,
		'depth'           => 1,
		'menu_class'      => 'w-full',
		'a_class_current' => 'text-sm text-blue-60 leading-large',
		'a_class'         => 'text-sm hover:text-blue-60 leading-large',
	]
);
