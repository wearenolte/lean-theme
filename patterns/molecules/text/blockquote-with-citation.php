<?php
// Set default values for the quote and citation
$args = wp_parse_args( $args, [
	'quote' => '',
	'citation' => '',
]);

// Don't render if the quote is empty
if ( empty( $args['quote'] ) ) {
	return;
}
?>
<blockquote class="m__blockquote-with-citation">

	<p><?php echo esc_html( $args['quote'] ); ?></p>

	<?php if ( ! empty( $args['citation'] ) ) : ?>
	<cite><?php echo esc_html( $args['citation'] ); ?></cite>
	<?php endif; ?>

</blockquote>
