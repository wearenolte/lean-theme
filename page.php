<?php use Lean\Load; ?>

<?php get_header(); ?>

<main class="container" role="main" itemprop="mainContentOfPage">
	<?php
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	?>
</main>

<?php get_footer(); ?>
