<?php

use Lean\Load;

$post_title = $args['title'] ?? '';
$content    = $args['content'] ?? '';
?>

<main class="t__page container pt-5 pb-5">

	<?php
	Load::organism(
		'article/article-body',
		[
			'title'   => $post_title,
			'content' => $content,
		]
	);
	?>

</main>
