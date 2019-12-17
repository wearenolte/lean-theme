<?php

/**
 * @param array        $block      The block settings and attributes.
 * @param string       $content    The block inner HTML (empty).
 * @param bool         $is_preview True during AJAX preview.
 * @param (int|string) $post_id    The post ID this block is saved to.
 */

$button_link = get_field( 'link_button_block' );

$component_data = [
	'label'  => $button_link['title'] ?? 'text',
	'url'    => $button_link['url'] ?? '',
	'target' => $button_link['target'] ?? '',
];

lean_load_block(
	'Lean\Load::atom',
	'buttons/button',
	$component_data,
	empty( $button_link['url'] ),
	$block
);
