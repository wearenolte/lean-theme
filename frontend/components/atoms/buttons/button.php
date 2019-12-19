<?php

$class  = $args['class'] ?? '';
$label  = $args['label'] ?? 'press me';
$url    = $args['url'] ?? '';
$target = $args['target'] ?? '';

$target = empty( $target ) ? '_self' : $target;

$class .= ' inline-block py-2 px-2 font-extrabold text-primary border-2 transition-2s ';
?>

<?php if ( $url ) : ?>

	<a
		data-atom="buttons/button"
		class="<?php echo esc_attr( $class ); ?>"
		href="<?php echo esc_url( $url ); ?>"
		target="<?php echo esc_attr( $target ); ?>">

		<?php echo esc_html( $label ); ?>

	</a>

<?php else : ?>

	<button
		data-atom="buttons/button"
		class="<?php echo esc_attr( $class ); ?>">

		<?php echo esc_html( $label ); ?>

	</button>

<?php endif; ?>
