<?php

namespace Lean\WP\Gutenberg\Blocks;

use Lean\WP\Gutenberg\AbstractBlock;

/**
 * Button block.
 */
class Button extends AbstractBlock {

	/**
	 * Register the block.
	 *
	 * @return array
	 */
	public function register() : array {
		return $this->do_registration(
			[
				'description'       => 'Adds a button to your page.',
				'icon'              => 'admin-links',
				'category'          => 'common-blocks',
				'template_type'     => 'atom',
				'template_name'     => 'buttons/button',
				'wrapper_elem'      => 'div',
				'alignment_options' => true,
			]
		);
	}

	/**
	 * Re-format the fields to the format required by the UI component.
	 *
	 * @param array   $block The block settings and attributes.
	 * @param string  $content The block inner HTML (empty).
	 * @param boolean $is_preview $is_preview True during AJAX preview.
	 * @param integer $post_id Id of the current post.
	 * @return array
	 */
	protected function get_fields( array $block, string $content, bool $is_preview, int $post_id ) : array {
		return array_merge(
			[
				'button_style' => get_field( 'button_style' ) ?? 'default',
			],
			get_field( 'link' ) ?? []
		);
	}
}
