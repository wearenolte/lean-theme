<?php
$args = wp_parse_args( $args, [
	'post' => null,
]);
$post = $args['post'];
$is_post = ( $post instanceof WP_Post );
if ( ! $is_post ) {
	return;
}
?>
<article>
	<header>
		<h1><?php echo esc_html( $post->post_title ); ?></h1>
	</header>
	<section>
		<?php echo wp_kses_post( $post->post_content ); ?>
	</section>
</article>
