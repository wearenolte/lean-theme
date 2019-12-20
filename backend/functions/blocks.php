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
