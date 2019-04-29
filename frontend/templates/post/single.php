<?php
use Lean\Load;
?>

<div class="t__post__single container">

	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			Load::organism( 'article/article-body', [
				'title' => get_the_title(),
				'content' => get_the_content(),
			]);
		}
	}
	?>

</div>
