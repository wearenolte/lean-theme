<?php

$style          = $args['style'] ?? 'normal';
$color          = $args['color'] ?? 'light';
$menu_id        = $args['menu_id'] ?? false;
$theme_location = $args['theme_location'] ?? false;
$menu_source    = $menu_id ? 'menu' : 'theme_location';

wp_nav_menu(
	[
		$menu_source => $menu_id ?? $theme_location,
		'container'  => false,
		'menu_class' => 'menu-horizontal menu-horizontal--' . $style . ' menu-horizontal--' . $color,
		'walker'     => new MainMenu(),
	]
);
