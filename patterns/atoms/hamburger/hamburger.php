<?php
$args = wp_parse_args($args, [
	'class' => [],
]);

$class = trim( implode( ' ', (array) $args['class'] ) );
?>
<button class="a__hamburger hamburger hamburger--spring <?php echo esc_attr( $class ); ?>"
		type="button">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
</button>
