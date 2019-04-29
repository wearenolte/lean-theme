<?php
$args = wp_parse_args(
	$args,
	[
		'title' => '',
	]
);
extract( $args );

if ( empty( $title ) ) {
	return;
}
?>

<heading class="m__headings__article d-block jumbotron jumbotron-fluid">
	<h1><?php echo esc_html( $title ); ?></h1>
</heading>
