<?php

$copyright = $args['copyright'] ?? '';

$copyright = str_replace( '%YEAR%', gmdate( 'Y' ), $copyright );
?>

<footer
	data-organism="footer"
	class="text-center mt-5"
	itemscope
	itemtype="http://schema.org/WPFooter">

	<div class="container">
		<p><?php echo esc_html( $copyright ); ?></p>
	</div>

</footer>
