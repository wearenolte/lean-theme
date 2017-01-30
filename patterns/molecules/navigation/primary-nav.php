<?php
use Lean\Load;

$args = wp_parse_args( $args, [
	'items' => [],
]);

// Return if does not have any item to be render.
if ( empty( $args['items'] ) ) {
	return;
}
?>
<nav class="m__primary-nav">
	<?php Load::atom( 'hamburger/hamburger' ); ?>

	<ul class="main-nav">
		<?php foreach ( $args['items'] as $item ) : ?>
			<li class="nav-main-item"></li>
		<?php endforeach; ?>
	</ul>

</nav>
