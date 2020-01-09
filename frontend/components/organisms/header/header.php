<?php

$website_title    = $args['website_title'] ?? '';
$website_home_url = $args['website_home_url'] ?? '';
$website_logo_id  = $args['website_logo_id'] ?? '';
?>

<header
	data-organism="header"
	class="relative z-10 mx-wide-margins bg-primary"
	itemscope
	itemtype="http://schema.org/WPHeader">

	<nav class="flex items-center justify-between flex-wrap py-subsection-y container">

		<!-- Logo -->
		<a class="flex items-center flex-shrink-0 text-white" href="<?php echo esc_url( $website_home_url ); ?>">
			<?php if ( $website_logo_id ) : ?>
				<?php
				echo wp_get_attachment_image(
					$website_logo_id,
					'full',
					true,
					[
						'class' => 'inline max-w-logo',
					]
				);
				?>
			<?php else : ?>
				<div class="inline font-bold uppercase text-small">
					<?php echo esc_html( $website_title ); ?>
				</div>
			<?php endif; ?>
		</a>

		<!-- Hamburger -->
		<div class="block lg:hidden">
			<button type="button" class="hamburger flex flex-col justify-between cursor-pointer h-hamburger-h" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar w-hamburger-w h-hamburger-line-w bg-white"></span>
				<span class="icon-bar w-hamburger-w h-hamburger-line-w bg-white"></span>
				<span class="icon-bar w-hamburger-w h-hamburger-line-w bg-white"></span>
			</button>
		</div>

		<!-- Menu -->
		<?php
		wp_nav_menu(
			[
				'theme_location'  => 'main_menu',
				'menu_id'         => 'main-menu',
				'container'       => false,
				'menu_class'      => 'hidden lg:block w-full block lg:flex lg:items-end lg:items-center lg:w-auto pt-subsection-y lg:pt-0',
				'li_class'        => 'lg:inline-block lg:pl-menu-spacing lg:first:pl-0',
				'a_class_current' => 'text-black text-small hover:opacity-75 cursor-pointer uppercase',
				'a_class'         => 'text-white text-small hover:opacity-75 cursor-pointer uppercase',
			]
		);
		?>

	</nav>

</header>
