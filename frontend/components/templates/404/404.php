<?php

use Lean\Load;

?>

<div class="t__404 container py-5 text-center">

	<?php
	Load::molecule(
		'headings/page/page',
		[
			'class' => 'mb-4',
			'title' => 'Page not found.',
		]
	);
	?>

</div>
