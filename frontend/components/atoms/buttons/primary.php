<?php

$class  = $args['class'] ?? '';
$label  = $args['label'] ?? '';
$url    = $args['url'] ?? '';
$target = $args['target'] ?? '';

$target = empty( $target ) ? '_self' : $target;
?>

<?php if ( $url ) : ?>

	<a
		class="btn <?php echo esc_attr( $class ); ?>"
		href="<?php echo esc_url( $url ); ?>"
		target="<?php echo esc_attr( $target ); ?>">

		<?php echo esc_html( $label ); ?>

	</a>

<?php else : ?>

	<button class="btn <?php echo esc_attr( $class ); ?>">
		<?php echo esc_html( $label ); ?>
	</button>

<?php endif; ?>
