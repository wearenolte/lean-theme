<?php
$args = wp_parse_args($args, [
	'label' => '',
	'url' => '',
	'classes' => [],
] );

$classes = ! empty( $args['classes'] ) && is_array( $args['classes'] ) ? implode( " ", $args['classes' ] ) : '';
?>

<a href="<?php echo esc_url( $args['url'] ); ?>"
   class="a__btn <?php echo esc_attr( $classes ); ?>">
	<?php echo esc_html( $args['label'] ); ?>
</a>
