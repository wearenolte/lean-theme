<?php
/**
 * The main header file.
 *
 * @package Lean
 * @since 1.0.0
 */

use Lean\Load;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
do_action( 'lean/before_header' );

Load::organisms( 'header/header' );

do_action( 'lean/after_header' );

