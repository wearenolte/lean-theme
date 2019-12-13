<?php
$class = $args['class'] ?? '';
?>

<div class="m__menus__main js-menu-container fixed hidden lg:flex lg:items-center
lg:static w-6/12 lg:w-auto h-screen lg:h-auto top-0 lg:top-auto right-0 lg:right-auto bg-red
lg:bg-transparent <?php echo esc_attr( $class ); ?>">

	<?php
	wp_nav_menu(
		[
			'theme_location' => 'main_menu',
			'container'      => 'ul',
			'menu_class'     => 'm__menus__main',
		]
	);
	?>

</div>
