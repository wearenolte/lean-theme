<?php

switch ( $args['button_style'] ?? 'default' ) {
	case 'link':
		$class = 'text-regular text-link-primary cursor-pointer underline hover:no-underline inline-block';
		break;
	default:
		$class = 'text-regular text-primary-btn bg-primary-btn-bg text-link-primary cursor-pointer px-primary-btn-padding-x py-primary-btn-padding-y hover:opacity-75 inline-block';
		break;
}

?>

<a
	data-type="atom/buttons/button"
	class="<?php echo esc_attr( $class ); ?>"
	href="<?php echo esc_url( $args['link']['url'] ?? '#' ); ?>"
	target="<?php echo esc_attr( $args['link']['target'] ?? '_self' ); ?>">

	<?php echo esc_html( $args['link']['title'] ?? '' ); ?>
</a>
