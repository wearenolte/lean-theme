<?php
$class     = $args['class'] ?? '';
$the_title = $args['title'] ?? '';
$url       = $args['url'] ?? '';
$target    = $args['target'] ?? '_self';
?>

<a
	data-atom="link"
	class="link <?php echo esc_attr( $class ); ?>"
	href="<?php echo esc_url( $url ); ?>"
	target="<?php echo esc_attr( $target ); ?>">

	<?php echo esc_html( $the_title ); ?>

</a>
