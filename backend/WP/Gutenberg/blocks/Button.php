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
				'description'   => 'Adds a button to your page.',
				'icon'          => 'admin-links',
				'category'      => 'common-blocks',
				'template_type' => 'atom',
				'template_name' => 'buttons/button',
				'wrapper_elem'  => 'div',
				'class'         => [ 'default-block' ],
			]
		);
	}
}
