<?php

use Lean\Load;

$post_title = $args['title'] ?? '';
$content    = $args['content'] ?? '';
?>

<div class="t__posts__single container py-5">

	<?php
	Load::molecule(
		'headings/article/article',
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

</div>
