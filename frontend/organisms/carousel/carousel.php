<?php
use Lean\Load;

$args = wp_parse_args( $args, [
	'items' => [],
]);
$index = 0;
// Return if does not have any item to be render.
if ( empty( $args['items'] ) ) {
	return;
}
$total_items = count( $args['items'] );
?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php for ( $x = 0; $x < $total_items; $x++ ) : ?>
			<li
				data-target="#carouselExampleIndicators"
				data-slide-to="<?php echo esc_html( $x ); ?>"
				class="<?php echo 0 === $x ? 'active' : ''; ?>"></li>
		<?php endfor; ?>
	</ol>
	<div class="carousel-inner">
		<?php foreach ( $args['items'] as $item => $link ) : ?>
			<div class="carousel-item <?php echo 0 === $index ? 'active' : ''; ?>">
				<img class="d-block w-100" src="<?php echo esc_url( $link ); ?>" alt="<?php echo esc_html( $item ); ?>">
			</div>
		<?php
			$index++;
			endforeach;
		?>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
