<?php

use \Timber\Timber;

get_header();

$data = Timber::get_context();
$data['posts'] = Timber::get_posts();
Timber::render( '03-templates/02-blog.twig', $data );

get_footer();
