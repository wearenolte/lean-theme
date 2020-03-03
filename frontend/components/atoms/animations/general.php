<?php

/*
 * Component used for style guide visualization only
 */

use Lean\Load;

?>

<div class="h-10 w-10 mb-2 px-2 border flex items-center justify-center transition-settings-default bg-white hover:bg-black-10">
	animation-hover-card_button
</div>

<?php

	Load::atom(
		'buttons/button',
		[
			'button_style' => 'default',
			'title'        => 'animation-hover-button',
		]
	);

?>
