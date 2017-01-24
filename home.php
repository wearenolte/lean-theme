<?php use Lean\Load; ?>
<?php get_header(); ?>

<section class="container">
	<main class="content" role="main" itemprop="mainContentOfPage">
	<?php
	while ( have_posts() ) {
		the_post();
		Load::organism( 'article/article-body', [
			'post' => get_post(),
		]);
	}
	?>
	</main>
	<?php get_sidebar(); ?>
</section>

<?php get_footer(); ?>
