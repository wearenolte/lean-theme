<?php

use Lean\Load;

$post_title = $args['title'] ?? '';
$content    = $args['content'] ?? '';
?>

<article>

	<?php
	Load::molecule(
		'headings/article',
		[
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

</article>
