<?php

use Lean\Load;

$the_title = $args['title'] ?? '';
?>

<div
	data-templates="404"
	class="container main-content py-5 text-center">

	<?php
	Load::molecule(
		'headings/page/page',
		[
			'class' => 'mb-4',
			'title' => $the_title,
		]
	);
	?>

</div>
