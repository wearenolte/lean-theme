<?php

$the_title = $args['title'] ?? '';
$url       = $args['url'] ?? '#';
$image_id  = $args['image_id'] ?? false;
?>

<a class="flex items-center flex-shrink-0 text-white" href="<?php echo esc_url( $url ); ?>">
	<?php if ( $image_id ) : ?>
		<?php
		echo wp_get_attachment_image(
			$image_id,
			'full',
			true,
			[
				'class' => 'inline max-w-logo',
			]
		);
		?>
	<?php else : ?>
		<div class="inline font-bold uppercase text-1.4">
			<?php echo esc_html( $the_title ); ?>
		</div>
	<?php endif; ?>
</a>
