<nav class="m__primary-nav navbar navbar-expand-lg navbar-light bg-light">

	<a class="m__primary-nav__brand navbar-brand" href="/">
		<span class="m__primary-nav__title">
			<?php echo esc_html( bloginfo( 'name' ) ); ?>
		</span>
	</a>

	<button
		class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarNav"
		aria-controls="navbarNav"
		aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarNav">

		<?php
		wp_nav_menu(
			[
				'theme_location' => 'main_menu',
				'container'      => 'ul',
				'menu_class'     => 'm__primary-nav__menu navbar-nav',
			]
		);
		?>

	</div>

</nav>
