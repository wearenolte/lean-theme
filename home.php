<?php use Lean\Load; ?>
<?php get_header(); ?>

<main class="container" role="main" itemprop="mainContentOfPage">
<?php
while ( have_posts() ) {
	the_post();
	Load::organism( 'article/article-body', [
		'post' => get_post(),
	]);
}
?>
</main>

<?php get_footer(); ?>
