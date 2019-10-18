<?php

$copyright = $args['copyright'] ?? '';

$copyright = str_replace( '%YEAR%', date( 'Y' ), $copyright );
?>

<footer
	class="text-center mt-5"
	data-cy="footer"
	itemscope
	itemtype="http://schema.org/WPFooter">

	<div class="container">
		<p class="o__footer__copyright"><?php echo esc_html( $copyright ); ?></p>
	</div>

</footer>
