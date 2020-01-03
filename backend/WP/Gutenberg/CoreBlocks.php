<?php

namespace Lean\WP\Gutenberg;

/**
 * Enumeration for the config of core blocks.
 */
abstract class CoreBlocks {

	/**
	 * Each block can have:
	 * -- active => true if the block should be displayed in the editor, false if not
	 *              (note that missing blocks will not be dispalyed by default).
	 * -- class => additional classes to add to the block.
	 */
	const CONFIG = [
		'core/heading'         => [
			'active' => true,
			'class'  => 'mb-heading-b last:mb-0 mt-heading-t first:mt-0 standard-headings',
		],
		'core/paragraph'       => [
			'active' => true,
			'class'  => 'mb-paragraph-b last:mb-0 text-body text-font-primary',
		],
		'core/list'            => [
			'active' => true,
			'class'  => 'text-body text-font-primary standard-lists mb-paragraph-b last:mb-0',
		],
		'core/code'            => [
			'active' => true,
			'class'  => 'text-body text-font-primary mb-paragraph-b last:mb-0 p-pre-padding border-solid border-1 border-pre-border rounded',
		],
		'core/preformatted'    => [
			'active' => true,
			'class'  => 'text-body text-font-primary mb-paragraph-b last:mb-0 p-pre-padding border-solid border-1 border-pre-border rounded',
		],
		'core/table'           => [
			'active' => true,
			'class'  => 'standard-table mb-paragraph-b last:mb-0',
		],
		'core/separator'       => [
			'active' => true,
			'class'  => 'border-separator mb-paragraph-b last:mb-0',
		],
		'core/columns'         => [
			'active' => true,
		],
		'core-embed/vimeo'     => [
			'active' => true,
		],
		'core/video'           => [
			'active' => true,
		],
		'core/pullquote'       => [
			'active' => true,
		],
		'core/quote'           => [
			'active' => true,
		],
		'core/image'           => [
			'active' => true,
			'class'  => 'mb-paragraph-b last:mb-0',
		],
		'core/audio'           => [
			'active' => true,
			'class'  => 'mb-paragraph-b last:mb-0',
		],
		'core/file'            => [
			'active' => true,
			'class'  => 'mb-paragraph-b last:mb-0 text-body text-font-primary',
		],
		'core/media-text'      => [
			'active' => true,
		],
		'core/more'            => [
			'active' => true,
		],
		'core/cover'           => [
			'active' => false,
		],
		'core/freeform'        => [
			'active' => false,
		],
		'core/gallery'         => [
			'active' => false,
		],
		'core/button'          => [
			'active' => true,
		],
		'core/spacer'          => [
			'active' => false,
		],
		'core/verse'           => [
			'active' => false,
		],
		'core/html'            => [
			'active' => false,
		],
		'core/archives'        => [
			'active' => false,
		],
		'core/categories'      => [
			'active' => false,
		],
		'core/latest-comments' => [
			'active' => false,
		],
		'core/latest-posts'    => [
			'active' => false,
		],
		'core/calendar'        => [
			'active' => false,
		],
		'core/rss'             => [
			'active' => false,
		],
		'core/search'          => [
			'active' => false,
		],
		'core/tag-cloud'       => [
			'active' => false,
		],
		'core/shortcode'       => [
			'active' => false,
		],
	];

}
