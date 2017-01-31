<?php
$args = wp_parse_args($args, [
	'label' => '',
	'class' => [],
] );

$class = trim( implode( ' ', (array) $args['class'] ) );

?>

<button class="a__btn <?php echo esc_attr( $class ); ?>">
	<?php echo esc_html( $args['label'] ); ?>
</button>

