<?php namespace LeanNs;
/**
 * The template for displaying the footer.
 *
 * @package Lean
 * @since 1.0.0
 */

use Timber\Timber;

?>

</div>
<!-- /.wrap -->

<?php $data = Timber::get_context(); ?>
<?php Timber::render( '02-organisms/00-global/footer.twig', $data ); ?>

<?php wp_footer(); ?>
</body>
</html>
