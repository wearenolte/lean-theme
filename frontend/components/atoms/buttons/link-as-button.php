<?php
$args = wp_parse_args(
	$args,
	[
		'label'  => '',
		'url'    => '',
		'target' => '_self',
		'class'  => '',
	]
);
?>

<a
	href="<?php echo esc_url( $args['url'] ); ?>"
	target="<?php echo esc_attr( $args['target'] ); ?>"
	class="a__btn <?php echo esc_attr( $class ); ?>">

	<?php echo esc_html( $args['label'] ); ?>

</a>
