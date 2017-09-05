<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package LeanP
 */

?>

<aside class="sidebar" role="complementary">

	<?php do_action( 'before_sidebar' ); ?>

	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

		<aside id="search" class="widget widget__search">
			<?php get_search_form(); ?>
		</aside>

		<aside class="widget">

			<h4 class="widget___title">
				<?php esc_html( 'Archives' ); ?>
			</h4>

			<ul>
				<?php
				wp_get_archives([
					'type' => 'monthly',
				]);
				?>
			</ul>

		</aside>

		<aside class="widget">

			<h4 class="widget___title">
				<?php echo esc_html( 'Meta' ); ?>
			</h4>

			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>

		</aside>

<?php endif; ?>

</aside>
