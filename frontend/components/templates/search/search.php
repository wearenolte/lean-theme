<?php

use Lean\Load;

?>

<div
	data-template="search"
	class="main-content container py-5 text-center">

	<?php
	Load::molecule(
		'headings/page/page',
		[
			'class' => 'mb-4',
			'title' => 'Search',
		]
	);

	get_search_form();
	?>

</div>
