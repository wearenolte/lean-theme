<?php
$args = wp_parse_args( $args, [
	'items' => [],
]);

// Not render if does not have any items.
if ( empty( $args['items'] ) ) {
	return;
}
?>
<nav class="m__footer-nav">

	<ul>
		<?php foreach ( $args['items'] as $item ) : ?>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo esc_url( $item['link'] ); ?>">
				<?php echo esc_html( $item['title'] ); ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>

</nav>
