<?php
/**
 * The template for displaying the footer.
 *
 * @package Lean
 * @since 1.0.0
 */
?>

<?php do_action( 'lean/before_footer' ); ?>
<footer role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<?php use_icon( 'twitter' ); ?>
	<?php use_icon( 'facebook' ); ?>
	<?php use_icon( 'instagram' ); ?>
</footer>
<?php wp_footer(); ?>
<?php do_action( 'lean/after_footer' ); ?>

</body>
</html>
