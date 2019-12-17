<?php

use Lean\Load;

get_header();

Load::template(
	'404/404',
	[
		'title' => get_field( 'general_options_not_found_text', 'options' ),
	]
);

get_footer();
