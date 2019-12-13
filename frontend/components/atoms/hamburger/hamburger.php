<?php
$class = $args['class'] ?? '';
?>

<button
	class="a__hamburger hamburger--spring hamburger js-hamburger z-10 <?php echo esc_attr( $class ); ?>"
	type="button"
	aria-label="Open menu">

	<span class="hamburger-box">
		<span class="hamburger-inner"></span>
	</span>

</button>
