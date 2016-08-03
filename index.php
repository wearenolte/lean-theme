<?php namespace Leanp;
/**
 * The main template file.  It is used to display a page when nothing more
 * specific matches a query.
 *
 * @package Lean
 * @since 1.0.0
 */

?>

<div class="wrap">
	<main class="site__main" role="main">

		The index.php template!!!

		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				/**
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then
				 * include a file called content-___.php (where ___ is the
				 * Post Format name) and that will be used instead.
				 */
				get_template_part( 'partials/content', get_post_format() );
			endwhile;

			the_posts_pagination();

		else :
			get_template_part( 'partials/content', 'none' );
		endif;
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
