<?php
$args = wp_parse_args($args, [
	'label' => '',
	'url' => '',
	'class' => [],
] );

$class = trim( implode( ' ', (array) $args['class'] ) );
?>

<a href="<?php echo esc_url( $args['url'] ); ?>"
	class="a__btn <?php echo esc_attr( $class ); ?>">
	<?php echo esc_html( $args['label'] ); ?>
</a>
