<?php

use Lean\Load;

get_header();

if ( have_posts() ) {
	$the_posts = [];

	while ( have_posts() ) {
		the_post();

		$the_posts[] = [
			'title'     => get_the_title(),
			'permalink' => get_the_permalink(),
		];
	}

	Load::template(
		'posts/archive',
		[
			'posts' => $the_posts,
		]
	);
}

get_footer();
