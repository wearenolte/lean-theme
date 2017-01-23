<?php
$args = wp_parse_args($args, [
	'label' => '',
	'url' => '',
] );
?>
<p>
	<a href="<?php echo esc_url( $args['url'] ); ?>" class="a__btn a__btn__text">
		<?php echo esc_html( $args['label'] ); ?>
	</a>
</p>

<p>
	<a href="#" class="a__btn a__btn__text" disabled="disabled">
		<?php echo esc_html( $args['label'] ); ?>
	</a>
</p>
