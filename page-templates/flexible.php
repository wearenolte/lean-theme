<?php /* Template Name: Flexible */

use \Timber\Timber;

get_header();

$data = Timber::get_context();
$data['posts'] = \LeanNs\Patterns::get_posts();
Timber::render( 'templates/flexible.twig', $data );

get_footer();
