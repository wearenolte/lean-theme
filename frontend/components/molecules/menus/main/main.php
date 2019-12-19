<?php
$class = $args['class'] ?? '';
?>

<div
	data-molecule="menus/main"
	class="js-menu-container
			fixed lg:static
			hidden lg:flex lg:items-center
			w-full lg:w-auto
			h-screen lg:h-auto
			top-0 lg:top-auto
			right-0 lg:right-auto
			bg-red lg:bg-transparent
			<?php echo esc_attr( $class ); ?>">

	<?php
	wp_nav_menu(
		[
			'theme_location' => 'main_menu',
			'container'      => 'ul',
			'menu_class'     => 'main-menu',
		]
	);
	?>

</div>
