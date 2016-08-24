<?php /* Template Name: Flexible */

use Timber\Timber;
use LeanNs\Assets;

$data = Timber::get_context();
$data['post'] = \LeanNs\Patterns::get_post();

if ( 'images' === $data['post']->acf['hero']['hero_background']['type'] ) {
	Assets::enqueue_flickity();
}

get_header();

Timber::render( 'templates/page-flexible.twig', $data );

get_footer();
