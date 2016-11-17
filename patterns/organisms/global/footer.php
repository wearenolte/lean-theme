<?php
$copyright = '';
if ( function_exists( 'get_field' ) ) {
	$copyright = get_field( 'general_options_copyright_text', 'option' );
}
$copyright = str_replace( '%YEAR%', date('Y'), $copyright );
?>
<footer class="o__footer" role="contentinfo">

	<div class="lc">

	<p class="copyright"><?php echo esc_html( $copyright ); ?></p>

	</div>

</footer>
