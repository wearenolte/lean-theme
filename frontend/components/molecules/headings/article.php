<?php
$args = wp_parse_args(
	$args,
	[
		'title' => '',
	]
);

$post_title = $args['title'];

if ( empty( $post_title ) ) {
	return;
}
?>

<div class="d-block jumbotron jumbotron-fluid mt-5">
	<h1 class="h1"><?php echo esc_html( $post_title ); ?></h1>
</div>
