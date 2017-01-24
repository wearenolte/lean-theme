<?php
$args = wp_parse_args($args, [
	'label' => '',
	'classes' => [],
] );

$classes = ! empty( $args['classes'] ) && is_array( $args['classes'] ) ? implode( " ", $args['classes' ] ) : '';
?>

<button class="a__btn <?php echo esc_attr( $classes ); ?>">
	<?php echo esc_html( $args['label'] ); ?>
</button>

