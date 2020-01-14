<?php

$button_style = $args['button_style'] ?? 'default';
$link_url     = $args['url'] ?? false;
$link_title   = $args['title'] ?? '';
$link_target  = $args['target'] ?? '_self';

switch ( $button_style ) {
	case 'link':
		$class = 'text-regular text-link-primary cursor-pointer underline hover:no-underline inline-block';
		break;
	default:
		$class = 'text-regular text-primary-btn bg-primary-btn-bg text-link-primary cursor-pointer px-primary-btn-padding-x py-primary-btn-padding-y hover:opacity-90 inline-block';
		break;
}

?>

<?php if ( $link_url ) : ?>

	<a
		data-type="atom/buttons/button"
		class="<?php echo esc_attr( $class ); ?>"
		href="<?php echo esc_url( $link_url ); ?>"
		target="<?php echo esc_attr( $link_target ); ?>">

		<?php echo esc_html( $link_title ); ?>
	</a>

<?php else : ?>

	<button
		data-type="atom/buttons/button"
		class="<?php echo esc_attr( $class ); ?>"
		type="button">

		<?php echo esc_html( $link_title ); ?>
	</button>

<?php endif; ?>
