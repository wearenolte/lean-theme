<?php

use Lean\Load;

$website_title    = $args['website_title'] ?? '';
$website_home_url = $args['website_home_url'] ?? '#';
$website_logo_id  = $args['website_logo_id'] ?? false;
?>

<header
	data-type="organism/header/header"
	class="relative z-10 mx-screen bg-red"
	itemscope
	itemtype="http://schema.org/WPHeader">

	<nav class="flex items-center justify-between flex-wrap py-2.5 container">

		<?php
		Load::atom(
			'images/main-logo',
			[
				'title'    => $website_title,
				'url'      => $website_home_url,
				'image_id' => $website_logo_id,
			]
		);
		?>

		<div class="block lg:hidden">
			<?php
			Load::atom(
				'buttons/hamburger',
				[
					'toggle_target_selector' => '#main_menu',
				]
			);
			?>
		</div>

		<?php
		Load::molecule(
			'menus/horizontal',
			[
				'theme_location' => 'main_menu',
			]
		);
		?>

	</nav>

</header>
