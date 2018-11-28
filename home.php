<?php use Lean\Load; ?>
<?php get_header(); ?>

<section class="container container-sidebar">
	<main class="content" role="main" itemprop="mainContentOfPage">
	<?php
	Load::organism( 'carousel/carousel', [
		'items' => [
			'Image-1' => 'https://placeimg.com/800/480/any',
			'Image-2' => 'https://placeimg.com/800/480/any',
			'Image-3' => 'https://placeimg.com/800/480/any',
		],
	]);
	while ( have_posts() ) {
		the_post();
		Load::organism( 'article/article-body', [
			'post' => get_post(),
		]);
	}
	Load::organism( 'forms/sample-form' );
	?>
	</main>
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>
