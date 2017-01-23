<?php
/**
 * The main header file.
 *
 * @package Lean
 * @since 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'lean/before_header' ); ?>
<header role="banner" itemscope itemtype="http://schema.org/WPHeader" class="container">
	<h1 itemprop="headline">
		<?php echo esc_html( bloginfo( 'name' ) ); ?>
	</h1>
</header>
<?php do_action( 'lean/after_header' ); ?>
