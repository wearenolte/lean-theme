<?php

$class         = $args['class'] ?? '';
$button_style  = $args['button_style'] ?? 'default';
$button_height = $args['button_height'] ?? 'default';
$link_url      = $args['url'] ?? false;
$link_title    = $args['title'] ?? '';
$link_target   = $args['target'] ?? '_self';
$icon          = $args['icon'] ?? '';

$icon      = 'arrow' === $button_style ? 'arrow-right' : $icon;
$file_name = $icon ? get_stylesheet_directory() . '/frontend/static/icons/' . $icon . '.svg' : '';

$link_base   = ' inline-flex items-center justify-center leading-1.125 inline-block';
$button_base = ' text-center transition-settings-default text-white cursor-pointer';
$icon_class  = 'link' === $button_style || 'arrow' === $button_style ? 'ml-.5 mt-1px w-1 h-1 transition-settings-default hover-target' : 'mr-1 opacity-50';

switch ( $button_style ) {
	case 'link':
		$class .= ' flex-row-reverse font-medium text-blue-60 hover:text-blue-80 cursor-pointer no-underline' . $link_base;
		break;
	case 'arrow':
		$class .= ' flex-row-reverse translate-child font-medium text-blue-60 hover:text-blue-80 cursor-pointer no-underline' . $link_base;
		break;
	case 'large':
		$class .= ' w-full bg-blue-80 hover:bg-blue-100 px-3.5' . $link_base . $button_base;
		$class .= 'short' === $button_height ? ' py-2.5 sm:py-1.5' : ' h-5.5';
		break;
	default:
		$class .= ' w-full sm:w-auto bg-blue-60 hover:bg-blue-80 py-1 px-1.5 ' . $link_base . $button_base;
		break;
}

?>

<?php if ( $link_url ) : ?>

	<a
		data-type="atom/buttons/button"
		class="<?php echo esc_attr( $class ); ?>"
		href="<?php echo esc_url( $link_url ); ?>"
		target="<?php echo esc_attr( $link_target ); ?>">

<?php else : ?>

	<button
			data-type="atom/buttons/button"
			class="<?php echo esc_attr( $class ); ?>"
			type="button">

<?php endif; ?>

		<?php if ( $icon ) : ?>

				<span class="<?php echo esc_attr( $icon_class ); ?>">

				<?php
				// @codingStandardsIgnoreLine
				$file_content = file_get_contents( $file_name ) ?? '';
				// @codingStandardsIgnoreLine - we are using a fixed set of known SVGs so there is no risk here.
				echo $file_content;
				?>

		</span>

		<?php endif; ?>

		<?php echo esc_html( $link_title ); ?>


<?php if ( $link_url ) : ?>

	</a>

<?php else : ?>

	</button>

<?php endif; ?>
