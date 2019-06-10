<?php
$args = wp_parse_args(
	$args,
	[
		'copyright' => '',
	]
);

$copyright = $args['copyright'];

if ( empty( $copyright ) ) {
	return;
}

$copyright = str_replace( '%YEAR%', date( 'Y' ), $copyright );
?>

<footer
	class="text-center mt-5"
	itemscope
	itemtype="http://schema.org/WPFooter">

	<div class="container">
		<p class="o__footer__copyright"><?php echo esc_html( $copyright ); ?></p>
	</div>

</footer>
