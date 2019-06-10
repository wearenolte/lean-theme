<?php
/**
 * The template for displaying the footer.
 *
 * @package Lean
 * @since 1.0.0
 */

use Lean\Load;

do_action( 'lean/before_footer' );

$copyright = get_field( 'general_options_copyright_text', 'options' ) ?? 'Copyright %YEAR%';

Load::organisms(
	'footer/footer',
	[
		'copyright' => $copyright,
	]
);

wp_footer();
?>

</body>
</html>
