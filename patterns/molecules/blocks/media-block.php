<?php use Lean\Load; ?>
<div class="m__media-block">

	<a href="<?php the_permalink(); ?>">

	<?php
	Load::atom( 'images/image', [
		'src' => get_the_post_thumbnail_url(),
	])
	?>

		<div class="m__media-block__text">
			<div class="m__media-block__text-inner">
				<h3><?php the_title(); ?></h3>
				<p><?php the_excerpt(); ?></p>
			</div>
		</div>

	</a>

</div>
