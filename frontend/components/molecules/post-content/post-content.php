<?php
$class   = $args['class'] ?? '';
$content = $args['content'] ?? '';
?>

<div
	data-molecule="post-content"
	class="post-content <?php echo esc_attr( $class ); ?>">

	<?php
	// @codingStandardsIgnoreStart
	echo apply_filters( 'the_content', $content );
	// @codingStandardsIgnoreEnd
	?>

</div>
