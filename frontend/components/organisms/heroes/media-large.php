<?php

use \Lean\Load;

$images       = $args['images'] ?? [];
$hero_title   = $args['title'] ?? false;
$top_text     = $args['top_text'] ?? false;
$bottom_text  = $args['bottom_text'] ?? false;
$button_title = $args['button_title'] ?? false;

if ( empty( $images ) || ! $hero_title ) {
	return;
}

?>

<section
	data-type="organism/hero/media"
	class="bg-blue-60 h-screen relative mx-screen min-h-40 max-h-50.75
		landscape:h-auto landscape:min-h-auto
		lg:h-screen-2.75 lg:max-h-66.75">

	<div class="w-full h-1/2 relative
		landscape:h-screen
		lg:w-43% lg:h-full">
		<?php
			Load::molecule(
				'sliders/image-fade',
				[
					'images'     => $images,
					'image_size' => 'portrait-hero',
					'overlay'    => true,
				]
			);
		?>

		<!-- Repeat page title tag for landscape only so we can position it within the image section -->
		<div class="container z-20 hidden landscape:block absolute bottom-0">
			<p class="font-secondary text-4xl-mob leading-tighter font-bold text-white mb-2.5">
				<?php echo esc_html( $hero_title ); ?>
			</p>
		</div>

		<div class="absolute inset-y-0 left-0 bg-blue-60 w-full z-20 swipe-out-to-bottom lg:swipe-out-to-right"></div>
	</div>

	<div class="container z-30 absolute bottom-0
		landscape:static
		lg:inset-x-0 lg:bottom-0 lg:top-6.25 lg:flex lg:flex-col lg:justify-center">
		<div class="lg:-mx-1">

			<?php if ( $top_text ) : ?>
				<p class="hidden font-primary text-base text-white leading-normal
					lg:px-1 lg:w-5/12 lg:ml-6/12 lg:block">
					<?php echo esc_html( $top_text ); ?>
				</p>
			<?php endif; ?>

			<h1 class="font-secondary text-4xl-mob leading-tighter font-bold text-white
				landscape:hidden
				lg:mt-3.5 lg:text-4xl-dsk lg:leading-tight lg:px-1 lg:w-8/12 lg:ml-3/12">
				<?php echo esc_html( $hero_title ); ?>
			</h1>

			<p class="font-primary text-base text-white leading-normal mt-1.5 mb-2.5
				landscape:mt-2.5
				lg:mt-3.5 lg:mb-0 lg:px-1 lg:w-5/12 lg:ml-6/12">
				<?php echo esc_html( $bottom_text ); ?>
			</p>

			<div class="mx-screen
				lg:absolute lg:-bottom-2.75 lg:right-0">
				<?php
				Load::atom(
					'buttons/button',
					[
						'title'         => $button_title,
						'url'           => '#second-fold',
						'button_style'  => 'large',
						'button_height' => 'tall',
						'icon'          => 'arrow-d-white',

					]
				);
				?>
				<div id="second-fold"></div>
			</div>

		</div>
	</div>

</section>
