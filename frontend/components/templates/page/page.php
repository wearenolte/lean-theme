<?php

use Lean\Load;

$post_title = $args['title'] ?? '';
$content    = $args['content'] ?? '';
?>

<main class="t__page container py-5">

	<?php
	Load::molecule(
		'headings/page/page',
		[
			'class' => 'mb-4',
			'title' => $post_title,
		]
	);

	Load::molecule(
		'post-content/post-content',
		[
			'content' => $content,
		]
	);
	?>

</main>
