<?php

use Lean\Load;

?>

<div class="t__home container py-5">

	<?php
	Load::molecule(
		'headings/page/page',
		[
			'class' => 'mb-4',
			'title' => 'Hello World',
		]
	);
	?>

</div>
