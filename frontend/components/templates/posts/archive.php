<?php

use Lean\Load;

$the_posts = $args['posts'] ?? [];
?>

<div class="t__posts__archive container pt-5 pb-5">

	<?php
	foreach ( $the_posts as $the_post ) {
		Load::atom(
			'links/link',
			[
				'class' => 'd-block mb-2',
				'title' => $the_post['title'] ?? '',
				'url'   => $the_post['permalink'] ?? '',
			]
		);
	}
	?>

</div>
