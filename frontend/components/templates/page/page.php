<?php

use Lean\Load;

$class      = $args['class'] ?? '';
$post_title = $args['title'] ?? '';
$content    = $args['content'] ?? '';
?>

<main
	data-template="templates/page"
	class="main-content container py-5 <?php echo esc_attr( $class ); ?>">

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
