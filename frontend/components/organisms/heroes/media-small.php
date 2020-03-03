<?php

use \Lean\Load;

$images           = $args['images'] ?? [];
$video_id         = $args['video_id'] ?? false;
$video_cover      = $args['video_cover'] ?? false;
$hero_title       = $args['title'] ?? false;
$bottom_text      = $args['bottom_text'] ?? false;
$show_breadcrumbs = $args['show_breadcrumbs'] ?? true;

if ( ( empty( $images ) && ! ( $video_id || $video_id ) ) || ! $hero_title ) {
	return;
}

?>

<section
	data-type="organism/hero/media-small"
	class="bg-blue-60 relative mx-screen
		md:h-55vh md:min-h-35 md:max-h-37">

	<div class="w-full h-1/2 relative
		md:w-43% md:h-full">

		<?php if ( ! empty( $images ) ) : ?>
			<?php
			Load::molecule(
				'sliders/image-fade',
				[
					'images'     => $images,
					'image_size' => 'landscape-hero',
					'overlay'    => true,
				]
			);
			?>
		<?php else : ?>
			<?php
			Load::molecule(
				'video/video',
				[
					'class'    => 'h-full',
					'image_id' => $video_cover,
					'vimeo_id' => $video_id,
					'overlay'  => true,
				]
			);
			?>
		<?php endif; ?>

		<div class="absolute inset-0 bg-blue-60 z-20 swipe-out-to-bottom md:swipe-out-to-right"></div>
	</div>

	<div class="px-3.33% z-30 relative pb-2.5 <?php echo $show_breadcrumbs ? '-mt-5' : '-mt-2.13'; ?> 
		md:absolute md:left-col-5 md:right-container md:bottom-0 md:top-6.25 md:flex md:flex-col md:justify-center md:px-0 md:pb-0 md:mt-0
		xl:left-col-5-xl xl:right-container-xl">
		<div class="md:-mx-1">

			<?php if ( $show_breadcrumbs ) : ?>
				<div class="mb-1.5 md:mb-2.5 md:px-1 md:w-5/8 md:ml-2/8">
					<?php Load::molecule( 'breadcrumbs/breadcrumbs' ); ?>
				</div>
			<?php endif; ?>

			<h1 class="font-secondary leading-tight font-bold text-white mb-1.5 text-4xl-mob
				md:text-4xl-dsk md:mb-2.5 md:px-1 md:w-6/8">
				<?php echo esc_html( $hero_title ); ?>
			</h1>

			<p class="font-primary text-base text-white leading-normal
				md:px-1 md:w-5/8 md:ml-2/8">
				<?php echo esc_html( $bottom_text ); ?>
			</p>

		</div>
	</div>

</section>
