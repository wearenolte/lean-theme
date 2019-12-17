<?php

use Lean\Load;

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		Load::template(
			'home/home',
			[
				'content' => get_the_content(),
			]
		);
	}
}

get_footer();
