<?php
/**
 * The main header file.
 *
 * @package Lean
 * @since   1.0.0
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

<body id="wpbody" <?php body_class(); ?>>

<?php
do_action( 'lean/before_header' );

$logo = get_field( 'general_options_logo', 'options' );

Load::organism(
	'header/header',
	[
		'website_title'    => get_bloginfo( 'title' ),
		'website_home_url' => home_url(),
		'website_logo_id'  => $logo ? $logo['ID'] : false,
	]
);

do_action( 'lean/after_header' );

