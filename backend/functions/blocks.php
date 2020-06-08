<?php
/**
 * Gutenberg blocks creation and helper functions.
 */

use \Lean\WP\Gutenberg\BlockSettings;
use \Lean\WP\Gutenberg\DesignSystem;

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
 * and a number of other require properties.
 */
add_filter(
	'render_block',
	function( string $block_content, array $block ) {
		$block_content = lean_add_block_props( $block_content, $block );

		if ( 'core/columns' === $block['blockName'] ) {
			$block_content = lean_columns_props( $block_content, $block );
		}

		if ( 'core/column' === $block['blockName'] ) {
			$block_content = lean_column_props( $block_content, $block );
		}

		return $block_content;
	},
	10,
	3
);

/**
 * Add classes from BlockSettings config to each block.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block settings.
 * @return string
 */
function lean_add_block_props( string $block_content, array $block ) : string {
	$block_name = $block['blockName'];

	$close_pos     = strpos( $block_content, '>' );
	$data_type_pos = strpos( $block_content, 'data-type' );
	if ( false !== $close_pos && false === $data_type_pos ) {
		$block_content = substr_replace( $block_content, ' data-type="' . $block_name . '">', $close_pos, 1 );
	}

	$block_config = BlockSettings::CORE_BLOCKS[ $block_name ] ?? false;
	if ( ! is_array( $block_config ) || ! isset( $block_config['class'] ) ) {
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
}

/**
 * Add the column count to the column container.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block settings.
 * @return string
 */
function lean_columns_props( string $block_content, array $block ) : string {
	$close_pos = strpos( $block_content, '>' );
	if ( false !== $close_pos ) {
		$col_count     = isset( $block['innerBlocks'] ) ? count( $block['innerBlocks'] ) : 0;
		$block_content = substr_replace( $block_content, ' data-cols="' . $col_count . '">', $close_pos, 1 );
	}

	return $block_content;
}

/**
 * Add classes to each column. We convert the %s to the closest TailWind width class using the 12 column grid.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block settings.
 * @return string
 */
function lean_column_props( string $block_content, array $block ) : string {
	$width = $block['attrs']['width'] ?? false;

	$class_pos = strpos( $block_content, 'wp-block-column' );
	if ( false !== $class_pos ) {
		$class         = 'w-full ' . DesignSystem::CLASSES['gutter.column'];
		$class        .= ( $width ? ' md:w-' . round( 12 * $width / 100 ) . '/12 ' : '' );
		$class        .= lean_block_has_media( $block ) ? ' has-media' : '';
		$block_content = substr_replace( $block_content, 'wp-block-column ' . $class, $class_pos, 15 );
	}

	$close_pos = strpos( $block_content, '>' );
	if ( false !== $close_pos ) {
		$block_content = substr_replace( $block_content, ' data-width="' . $width . '">', $close_pos, 1 );
	}

	$style_pos = strpos( $block_content, 'style="' );
	if ( false !== $style_pos ) {
		$style_end_pos = strpos( $block_content, '"', $style_pos + 8 );
		$block_content = substr_replace( $block_content, '', $style_pos, $style_end_pos - $style_pos + 1 );
	}

	return $block_content;
}

/**
 * Return true if the block has any sub-blocks with media (eg image, video, etc)
 *
 * @param array $block The block settings.
 * @return boolean
 */
function lean_block_has_media( array $block ) : bool {
	return count( array_intersect( array_column( $block['innerBlocks'], 'blockName' ), BlockSettings::MEDIA_BLOCKS ) ) > 0;
}
