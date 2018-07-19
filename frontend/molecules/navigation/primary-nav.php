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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="/">
		<span class="navbar-brand-title">
			<?php echo esc_html( bloginfo( 'name' ) ); ?>
		</span>
	</a>
	<button
		class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarNav"
		aria-controls="navbarNav"
		aria-expanded="false"
		aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<?php foreach ( $args['items'] as $item => $link ) : ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo esc_url( $link ); ?>">
						<?php echo esc_html( $item ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</nav>
