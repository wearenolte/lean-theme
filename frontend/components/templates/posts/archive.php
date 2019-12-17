<?php

use Lean\Load;

$the_posts = $args['posts'] ?? [];
?>

<div
	data-template="posts/archive"
	class="main-content container py-5">

	<?php
	Load::molecule(
		'headings/article/article',
		[
			'class' => 'mb-4',
			'title' => 'Archive',
		]
	);

	foreach ( $the_posts as $the_post ) {
		Load::atom(
			'links/link',
			[
				'class' => 'block mb-2',
				'title' => $the_post['title'] ?? '',
				'url'   => $the_post['permalink'] ?? '',
			]
		);
	}
	?>

</div>
