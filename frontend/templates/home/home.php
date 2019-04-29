<?php use Lean\Load; ?>

<div class="t__home container">

	<main class="t__home__content" role="main" itemprop="mainContentOfPage">

		<section class="mb-4">

			<?php
			Load::organism( 'carousel/carousel', [
				'items' => [
					'Image-1' => 'https://placeimg.com/800/480/any',
					'Image-2' => 'https://placeimg.com/800/480/any',
					'Image-3' => 'https://placeimg.com/800/480/any',
				],
			]);
			?>

		</section>

		<section class="mb-4">

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

				<?php
			endwhile;
			?>

		</section>

		<section class="mb-4">

			<?php Load::organism( 'forms/sample-form' ); ?>

		</section>

	</main>

</div>
