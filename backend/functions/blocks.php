<?php
/**
 * Gutenberg blocks creation and helper functions.
 */

/**
 * Register all the block classes in backend/WP/Gutenberg/Blocks
 */
add_action(
	'acf/init',
	function () {
		\Lean\Backend::autoload_classes( 'WP/Gutenberg/Blocks', 'register', true );
	}
);

/**
 * Block category generator.
 *
 * @param array $categories The array of block categories.
 *
 * @return array
 */
add_filter(
	'block_categories',
	function ( $categories ) {
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
 * Is this block id the first block in the current post.
 *
 * @param string $block_id The id of the block to check.
 *
 * @return bool True if it is the first block in the post. False if not or there are no blocks in the post.
 */
function lean_is_first_block( string $block_id ) : bool {
	$post = get_post();

	if ( has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );

		if ( ! empty( $blocks ) ) {
			return $block_id === $blocks[0]['attrs']['id'];
		}
	}

	return false;
}

/**
 * Filter block rendering. When a core block renders we add the data-type attribute
 * and the classes from the CoreBlocks config.
 */
add_filter(
	'render_block',
	function( $block_content, $block ) {
		$block_name = $block['blockName'];

		$close_pos = strpos( $block_content, '>' );
		if ( false !== $close_pos ) {
			$block_content = substr_replace( $block_content, ' data-type="' . $block_name . '">', $close_pos, 1 );
		}

		$block_config = \Lean\WP\Gutenberg\CoreBlocks::CONFIG[ $block_name ];
		if ( ! is_array( $block_config ) || ! $block_config['class'] ) {
			return $block_content;
		}

		// Add to the existing classes if there are some already.
		$class_pos = strpos( $block_content, 'class="' );
		if ( false !== $class_pos && $class_pos < strpos( $block_content, '>' ) ) {
			return substr_replace( $block_content, 'class="' . $block_config['class'] . ' ', $class_pos, 7 );
		}

		// Or add a class property if one does not exist already.
		$close_pos = strpos( $block_content, '>' );
		if ( false !== $close_pos ) {
			return substr_replace( $block_content, ' class="' . $block_config['class'] . '">', $close_pos, 1 );
		}
	},
	10,
	3
);
