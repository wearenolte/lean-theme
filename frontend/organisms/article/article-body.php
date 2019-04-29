<?php
use Lean\Load;

$args = wp_parse_args( $args, [
	'title' => '',
	'content' => '',
]);
extract( $args );

if ( empty( $title ) && empty( $content ) ) {
	return;
}
?>

<article>

	<?php
	Load::molecule(
		'headings/article',
		[
			'title' => $title,
		]
	);
	?>

	<section>
		<?php echo wp_kses_post( $content ); ?>
	</section>

</article>
