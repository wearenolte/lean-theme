<?php /* Template Name: Flexible */

use LeanNs\Assets;

$data['post'] = [];

if ( ! isset(  $data['post']->acf['hero']['hero_background']['type'] ) ) {
	throw new Exception( 'acf[\'hero\'][\'hero_background\'][\'type\'] not found.' );
}

if ( 'images' === $data['post']->acf['hero']['hero_background']['type'] ) {
	Assets::enqueue_flickity();
}

get_header();

get_footer();
