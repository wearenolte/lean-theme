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
	?>

	<?php foreach ( $the_posts as $the_post ) : ?>

	<a
		class="block"
		href="<?php echo esc_url( $the_post['permalink'] ); ?>">
		<?php echo esc_html( $the_post['title'] ); ?>
	</a>

	<?php endforeach; ?>

</div>
