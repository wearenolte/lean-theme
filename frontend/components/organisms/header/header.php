<?php

use Lean\Load;

$class               = $args['class'] ?? '';
$website_title       = $args['website_title'] ?? '';
$website_url         = $args['website_url'] ?? '';
$website_description = $args['website_description'] ?? '';
$website_logo_url    = $args['website_logo_url'] ?? '';
?>

<header
	data-organism="header"
	class="relative z-10 <?php echo esc_attr( $class ); ?>"
	itemscope
	itemtype="http://schema.org/WPHeader">

	<nav class="container flex justify-between items-center">

		<a href="<?php echo esc_url( $website_url ); ?>">

			<?php if ( $website_logo_url ) : ?>

				<img
					class="inline h-12 lg:h-14"
					src="<?php echo esc_url( $website_logo_url ); ?>"
					alt="<?php echo esc_html( $website_title ); ?>">

			<?php else : ?>

				<h1 class="inline text-15 font-extrabold uppercase">
					<?php echo esc_html( $website_title ); ?>
				</h1>

			<?php endif; ?>

			<span class="hidden lg:inline ml-4 text-15 font-extrabold uppercase">
				<?php echo esc_html( $website_description ); ?>
			</span>

		</a>

		<?php
		Load::atom(
			'hamburger/hamburger',
			[
				'class' => 'lg:hidden',
			]
		);

		Load::molecule( 'menus/main/main' );
		?>

	</nav>

</header>
