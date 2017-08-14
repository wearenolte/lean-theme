<?php
$args = wp_parse_args( $args, [
	'src' => '',
	'alt' => '',
	'class' => '',
]);

// Don't render if the params does not provide a source argument.
if ( empty( $args['src'] ) ) {
	return;
}
?>
<img
	src="<?php echo esc_attr( $args['src'] ); ?>"
	alt="<?php echo esc_attr( $args['alt'] ); ?>"
	class="<?php echo esc_attr( $args['class'] ); ?>" />
