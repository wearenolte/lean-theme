<?php
use Lean\Load;
?>
<header
	role="banner"
	itemscope
	itemtype="http://schema.org/WPHeader">
	<?php
		Load::molecule( 'navigation/primary-nav', [
			'items' => [
				'Home' => '/',
				'Features' => '/exmaple-url',
			],
		]);
	?>
</header>
