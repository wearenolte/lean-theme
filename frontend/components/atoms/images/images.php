<?php
/*
 * Component used for style guide visualization only
 */

$image_id   = $args['image_id'] ?? '';
$image_size = $args['image_size'] ?? '';

?>

<?php
echo wp_get_attachment_image( $image_id, $image_size, '', [] );
