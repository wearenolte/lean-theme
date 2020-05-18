<?php

namespace Lean\WP\Gutenberg;

/**
 * Abstract class for implementing a block.
 */
abstract class AbstractBlock {

	const DEFAULT_WRAPPER_ELEM = 'section';

	const LOADER = '\Lean\Load';

	/**
	 * Gets the name of the block from the class name.
	 *
	 * @return string
	 */
	public function get_name() {
		return strtolower( implode( '-', $this->get_split_class_name() ) );
	}

	/**
	 * Gets the title of the block from the class name.
	 *
	 * @return string
	 */
	public function get_title() {
		return implode( ' ', $this->get_split_class_name() );
	}

	/**
	 * Register the block so it appears in the block editor menu.
	 *
	 * @param array $args The arguments, see the readme for more info.
	 * @return array
	 */
	final protected function do_registration( array $args ) : array {
		$args = wp_parse_args(
			$args,
			[
				'title'             => $this->get_title(),
				'name'              => $this->get_name(),
				'render_callback'   => [ $this, 'render' ],
				'alignment_options' => false,
			]
		);

		if ( $args['alignment_options'] ) {
			add_action(
				'admin_head',
				function() use ( $args ) {
					echo '<style>[data-type="acf/' . esc_attr( $args['name'] ) . '"] [aria-label="Change alignment"] {display: flex;}</style>';
				}
			);
		}

		if ( function_exists( 'acf_register_block' ) ) {
			return acf_register_block( $args );
		}

		return [];
	}

	/**
	 * Registration function which must be implemented in the child class.
	 * See readmen for more info.
	 *
	 * @return array
	 */
	abstract public function register() : array;

	/**
	 * Render the block.
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return void
	 */
	public function render( array $block, string $content, bool $is_preview, int $post_id ) {
		$this->render_wapper_open( $block, $content, $is_preview, $post_id );
		$this->render_content( $block, $content, $is_preview, $post_id );
		$this->render_wrapper_close( $block, $content, $is_preview, $post_id );
	}

	/**
	 * Render the block wrapper opening tag.
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return void
	 */
	final protected function render_wapper_open( array $block, string $content, bool $is_preview, int $post_id ) {
		$wrapper_classes = apply_filters(
			'lean_block_class',
			array_merge(
				[
					'block',
					'block-' . $this->get_name(),
					'has-text-align-' . ( '' === $block['align'] ? 'left' : $block['align'] ),
				],
				$block['class'] ?? []
			),
			$block,
			$content,
			$is_preview,
			$post_id
		);

		echo sprintf(
			'<%s id="%s" data-type="%s" class="%s">',
			esc_attr( apply_filters( 'lean_block_wrapper', $block['wrapper_elem'] ?? self::DEFAULT_WRAPPER_ELEM, $block, $content, $is_preview, $post_id ) ),
			esc_attr( apply_filters( 'lean_block_id', $block['id'], $block, $content, $is_preview, $post_id ) ),
			esc_attr( $block['name'] ),
			esc_attr( implode( ' ', $wrapper_classes ) )
		);
	}

	/**
	 * Render the block content.
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return void
	 */
	final protected function render_content( array $block, string $content, bool $is_preview, int $post_id ) {
		$loader = self::LOADER . '::' . $block['template_type'];
		$loader( $block['template_name'], $this->get_fields( $block, $content, $is_preview, $post_id ) );
	}

	/**
	 * Get the fields. Override this function to manipulate the fields before rendering the block.
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return array
	 */
	protected function get_fields( array $block, string $content, bool $is_preview, int $post_id ) : array {
		return apply_filters( 'lean_block_fields', get_fields(), $block, $content, $is_preview, $post_id );
	}

	/**
	 * Render the block. wrapper closing tag
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return void
	 */
	final protected function render_wrapper_close( array $block, string $content, bool $is_preview, int $post_id ) {
		echo sprintf(
			'</%s>',
			esc_attr( apply_filters( 'lean_block_wrapper', $block['wrapper_elem'] ?? self::DEFAULT_WRAPPER_ELEM, $block, $content, $is_preview, $post_id ) )
		);
	}

	/**
	 * Utility method to split the class name into separate words.
	 *
	 * @return array
	 */
	final private function get_split_class_name() {
		$class_name = ( new \ReflectionClass( $this ) )->getShortName();
		return preg_split( '/(?=[A-Z])/', $class_name, -1, PREG_SPLIT_NO_EMPTY );
	}
}
