<?php

global $allow_break_tag;

$post_title = $args['title'] ?? '';

if ( empty( $post_title ) ) {
	return;
}
?>

<div class="d-block mt-5 mb-5">
	<h1 class="h1">
		<?php echo wp_kses( $post_title, $allow_break_tag ); ?>
	</h1>
</div>
