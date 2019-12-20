<?php

namespace Lean\WP\Gutenberg;

/**
 * Create the Gutenberg blocks.
 */
class Blocks {
	/**
	 * Blocks folder path relative to the theme path.
	 */
	const BLOCK_PATH = '/backend/WP/Gutenberg/blocks/';

	/**
	 * Custom blocks category.
	 */
	const LEAN_BLOCKS_CATEGORY = 'custom-blocks';

	/**
	 * Init.
	 */
	public static function init() {
		add_action( 'init', [ __CLASS__, 'autoload_blocks' ] );
		add_filter( 'block_categories', [ __CLASS__, 'register_block_category' ] );
	}

	/**
	 * Autoload blocks from the blocks folder.
	 */
	public static function autoload_blocks() {
		$path = get_template_directory() . self::BLOCK_PATH;

		foreach ( glob( $path . '/*.php' ) as $file ) {
			$comment = self::get_file_doc_block( $file );

			$component_name       = self::get_property( 'Name', $comment );
			$component_icon       = self::get_property( 'Icon', $comment );
			$component_desc       = self::get_property( 'Description', $comment );
			$component_alignment  = self::get_property( 'Align', $comment );
			$component_category   = self::get_property( 'Category', $comment );
			$component_post_types = self::get_property( 'Post Types', $comment );

			$filename = basename( $file, '.php' );

			self::create_block(
				[
					'title'       => $component_name ? $component_name : 'Custom',
					'name'        => $filename ? $filename : 'custom',
					'description' => $component_desc ? $component_desc : '',
					'icon'        => $component_icon ? $component_icon : 'star-filled',
					'category'    => $component_category ? $component_category : self::LEAN_BLOCKS_CATEGORY,
					'post_types'  => $component_post_types ? json_decode( $component_post_types ) : [
						'post',
						'page',
					],
					'supports'    => [
						'align' => $component_alignment ? $component_alignment : false,
					],
				]
			);
		}
	}

	/**
	 * Return first doc comment found in this file.
	 *
	 * @return string
	 */
	public static function get_file_doc_block( string $file ) {
		$docComments    = array_filter(
			token_get_all( file_get_contents( $file ) ), function ( $entry ) {
			return $entry[0] == T_DOC_COMMENT;
		}
		);
		$fileDocComment = array_shift( $docComments );

		return $fileDocComment[1];
	}

	/**
	 * @param string $label The label name to search.
	 * @param string $string The comment line to search on.
	 *
	 * @return mixed|string
	 */
	public static function get_property( string $label, string $string ) {
		preg_match( '/. ' . $label . ': ([a-zA-Z0-9_ ]*)/i', $string, $matches );

		return $matches[1] ?? '';
	}

	/**
	 * Block generator
	 *
	 * More information: https://www.advancedcustomfields.com/resources/acf_register_block_type/
	 *
	 * @param array $args The name of the block.
	 *
	 * @return array | false
	 */
	public static function create_block( array $args ) {
		if ( function_exists( 'acf_register_block' ) ) {
			$args = wp_parse_args(
				$args,
				[
					'render_template' => 'backend/WP/Gutenberg/blocks/' . $args['name'] . '.php',
					'category'        => self::LEAN_BLOCKS_CATEGORY,
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
	public static function load_block(
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
	 * Block category generator.
	 *
	 * @param array $categories The array of block categories.
	 *
	 * @return array
	 */
	public static function register_block_category( array $categories ): array {
		return array_merge(
			$categories,
			[
				[
					'slug'  => self::LEAN_BLOCKS_CATEGORY,
					'title' => 'Custom Blocks',
				],
			]
		);
	}
}
