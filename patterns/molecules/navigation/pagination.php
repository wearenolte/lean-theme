<?php
$args = wp_parse_args( $args, [
	'prev' => [],
	'pages' => [],
	'next' => [],
]);
?>
<ol class="m__pagination">

	<?php if ( ! empty( $args['prev'] ) ) : ?>
	<li>
		<a href="<?php echo esc_html( $args['prev']['link'] ); ?>" class="m__pagination__prev">
			Previous
		</a>
	</li>
	<?php endif; ?>

	<?php foreach ( $args['pages'] as $page ) : ?>
	<li>
		<?php if ( $page['link'] ) : ?>
			<a href="<?php echo esc_url( $page['link'] ); ?>"
				class="<?php echo esc_attr( $page['class'] ); ?>">
				<?php echo esc_html( $page['title'] ); ?>
			</a>
		<?php else : ?>
			<span class="<?php echo esc_attr( $page['class'] ); ?>">
				<?php echo esc_html( $page['title'] ); ?>
			</span>
		<?php endif; ?>
	</li>
	<?php endforeach; ?>

	<?php if ( ! empty( $args['next'] ) ) : ?>
	<li>
		<a href="<?php echo esc_url( $args['next']['link'] ); ?>" class="m__pagination__next">
			Next
		</a>
	</li>
	<?php endif; ?>

</ol>
