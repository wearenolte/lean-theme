<?php
/**
 * The template for displaying the footer.
 *
 * @package Lean
 * @since 1.0.0
 */

use Lean\Load;
?>

<?php do_action( 'lean/before_footer' ); ?>
<?php Load::organisms( 'footer/footer' ); ?>
<?php wp_footer(); ?>
<?php do_action( 'lean/after_footer' ); ?>

</body>
</html>
