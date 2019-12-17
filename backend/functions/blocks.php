<?php
/**
 * Gutenberg blocks creation and helper functions.
 */

/**
 * Blocks creation.
 *
 * More information: https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * Icon cheatsheet: http://calebserna.com/dashicons-cheatsheet/
 */
add_action(
	'init',
	function() {
		lean_create_block(
			[
				'title'       => 'Custom button',
				'name'        => 'button',
				'description' => 'Custom Button',
				'icon'        => 'button',
			]
		);
	}
);

/**
 * Block category generator.
 *
 * @param array $categories The array of block categories.
 * @return array
 */
add_filter(
	'block_categories',
	function( $categories ) {
		return array_merge(
			$categories,
			[
				[
					'slug'  => 'custom-blocks',
					'title' => 'Custom Blocks',
				],
			]
		);
	}
);

/**
 * Block generator
 *
 * More information: https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @param array  $args     The name of the block.
 *
 * @return array | false
 */
function lean_create_block( array $args ) {
	if ( function_exists( 'acf_register_block' ) ) {
		$args = wp_parse_args(
			$args,
			[
				'render_template' => 'backend/WP/Gutenberg/blocks/' . $args['name'] . '.php',
				'category'        => 'custom-blocks',
				'icon'            => 'star-filled',
			]
		);

		return acf_register_block( $args );
	}

	return false;
}

/**
 * Prints a block within a standardised <section> tag.
 *
 * @param string $loader         The method used to render the component, eg \Lean\Load::organism.
 * @param string $component_name The name of the component is the name of the component filename.
 * @param array  $component_data The data required by the component.
 * @param bool   $is_empty       Whether the block is empty or not.
 * @param array  $block          The block metadata.
 *
 * @return void
 */
function lean_load_block(
	string $loader,
	string $component_name,
	array $component_data,
	bool $is_empty,
	array $block
) {
	// Create id attribute allowing for custom "anchor" value.
	$block_id = $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$block_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$class_name = $block['name'];
	if ( ! empty( $block['className'] ) ) {
		$class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$class_name .= ' align' . $block['align'];
	}

	echo '<section id="' . esc_attr( $block_id ) . '" class="' . esc_attr( $class_name ) . '">';
	if ( $is_empty ) {
		echo "<span class='only-dashboard'>Press the pencil to add content.</span>";
	}
	$loader( $component_name, $component_data );
	echo '</section>';
}

/**
 * Is this block id the first block in the current post.
 *
 * @param string $block_id The id of the block to check.
 *
 * @return bool True if it is the first block in the post. False if not or there are no blocks in the post.
 */
function lean_is_first_block( int $block_id ): bool {
	$post = get_post();

	if ( has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );

		if ( ! empty( $blocks ) ) {
			return $block_id === $blocks[0]['attrs']['id'];
		}
	}

	return false;
}
