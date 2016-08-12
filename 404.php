<?php

use \Timber\Timber;

get_header();

$data = Timber::get_context();
$data['posts'] = \LeanNs\Patterns::get_posts();
Timber::render( 'templates/error-404.twig', $data );

get_footer();
