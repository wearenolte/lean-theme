<?php
/**
 * Gutenberg blocks helper functions.
 */

/**
 * Is this block id the first block in the current post.
 *
 * @param string $block_id The id of the block to check.
 *
 * @return bool True if it is the first block in the post. False if not or there are no blocks in the post.
 */
function lean_is_first_block( string $block_id ): bool {
	$post = get_post();

	if ( has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );

		if ( ! empty( $blocks ) ) {
			return $block_id === $blocks[0]['attrs']['id'];
		}
	}

	return false;
}
