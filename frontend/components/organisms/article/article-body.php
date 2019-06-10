<?php

use Lean\Load;

$args = wp_parse_args(
	$args,
	[
		'title'   => '',
		'content' => '',
	]
);

$post_title   = $args['title'];
$post_content = $args['content'];

if ( empty( $post_title ) && empty( $post_content ) ) {
	return;
}
?>

<article>

	<?php
	Load::molecule(
		'headings/article',
		[
			'title' => $post_title,
		]
	);

	echo wp_kses_post( $post_content );
	?>

</article>
