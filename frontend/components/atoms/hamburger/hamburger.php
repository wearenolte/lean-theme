<?php
$class = $args['class'] ?? '';
?>

<button
	data-atom="hamburger"
	class="hamburger--spring hamburger js-hamburger flex z-10 <?php echo esc_attr( $class ); ?>"
	type="button"
	aria-label="Open menu">

	<span class="hamburger-box">
		<span class="hamburger-inner"></span>
	</span>

</button>
