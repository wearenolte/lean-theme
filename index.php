<?php namespace Leanp;
/**
 * The main template file.  It is used to display a page when nothing more
 * specific matches a query.
 *
 * @package Lean
 * @since 1.0.0
 */

use Timber\Timber;

use PatternLab\PatternEngine\Twig\Loaders\PatternLoader;

get_header();

$data = [
	'url' => 'http://ab.com',
	'img' => [
		'square' => [
			'src' => 'http://placehold.it/350x350',
		]
	]
];

//$data = Timber::get_context();
//$data['posts'] = Timber::get_posts();
//$data['foo'] = 'bar';
//$data['img'] = [
//	'square' => [
//		'src' => 'http://placehold.it/350x350',
//	]
//];
//Timber::render( '00-atoms/04-images/03-square.twig', $data );

//Patterns::render( ['pattern' => '00-atoms/04-images/03-square.twig', 'data' => $data ] );
//
//Patterns::render( ['pattern' => '01-molecules/02-blocks/00-media-block.twig', 'data' => $data ] );
//
//Patterns::render( ['pattern' => 'atoms-square', 'data' => $data ] );

//Patterns::render( '00-atoms/04-images/03-square.twig',
//]);
//
//
//Patterns::render( '01-molecules/02-blocks/00-media-block.twig', [
//	'img' => [
//		'square' => [
//			'src' => 'http://placehold.it/350x350',
//		]
//	]
//]);

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
