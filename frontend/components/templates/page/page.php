<?php

use Lean\Load;

?>

<main class="t__page container">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			Load::organism(
				'article/article-body',
				[
					'title'   => get_the_title(),
					'content' => get_the_content(),
				]
			);
		}
	}
	?>

</main>
