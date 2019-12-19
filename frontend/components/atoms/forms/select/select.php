<?php

$class         = $args['class'] ?? '';
$name          = $args['name'] ?? '';
$selected      = $args['selected'] ?? '';
$default_value = $args['default']['value'] ?? '';
$default_text  = $args['default']['text'] ?? '';
$options       = $args['options'] ?? [];
?>

<select
	data-atom="forms/select"
	class="select <?php echo esc_attr( $class ); ?>"
	name="<?php echo esc_attr( sanitize_title( $name ) ); ?>"
	aria-label="<?php echo esc_attr( $name ); ?>">

	<?php if ( $default_text ) : ?>
		<option value="<?php echo esc_attr( $default_value ); ?>" selected>
			<?php echo esc_html( $default_text ); ?>
		</option>
	<?php endif; ?>

	<?php foreach ( $options as $option ) : ?>
		<option
			<?php echo $option['value'] === $selected ? 'selected' : ''; ?>
			value="<?php echo esc_attr( $option['value'] ); ?>">
			<?php echo esc_html( $option['text'] ); ?>
		</option>
	<?php endforeach; ?>

</select>
