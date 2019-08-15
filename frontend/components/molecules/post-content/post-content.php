<?php
global $allow_all_post_tags;

$class   = $args['class'] ?? '';
$content = $args['content'] ?? '';
?>

<div class="m__post-content <?php echo esc_attr( $class ); ?>">
	<?php echo wp_kses( apply_filters( 'the_content', $content ), $allow_all_post_tags ); ?>
</div>
