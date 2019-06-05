<?php
use Lean\Load;

$args = wp_parse_args( $args, [
	'title' => '',
	'content' => '',
]);
$title = $args['title'];
$content = $args['content'];

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
