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
			'class'  => 'heading-block standard-headings',
		],
		'core/paragraph'       => [
			'active' => true,
			'class'  => 'text-block text-regular text-font-primary',
		],
		'core/list'            => [
			'active' => true,
			'class'  => 'text-block text-regular text-font-primary standard-lists',
		],
		'core/code'            => [
			'active' => true,
			'class'  => 'default-block text-regular text-font-primary p-pre-padding border-solid border-1 border-pre-border rounded',
		],
		'core/preformatted'    => [
			'active' => true,
			'class'  => 'default-block text-regular text-font-primary p-pre-padding border-solid border-1 border-pre-border rounded',
		],
		'core/table'           => [
			'active' => true,
			'class'  => 'default-block standard-table',
		],
		'core/separator'       => [
			'active' => true,
			'class'  => 'border-separator',
		],
		'core/columns'         => [
			'active' => true,
			'class'  => 'section-block flex -mx-gutter',
		],
		'core/group'           => [
			'active' => true,
			'class'  => 'section-block',
		],
		'core-embed/vimeo'     => [
			'active' => true,
			'class'  => 'default-block',
		],
		'core/video'           => [
			'active' => true,
			'class'  => 'default-block',
		],
		'core/pullquote'       => [
			'active' => true,
			'class'  => 'default-block text-regular text-font-primary',
		],
		'core/quote'           => [
			'active' => true,
			'class'  => 'default-block',
		],
		'core/image'           => [
			'active' => true,
			'class'  => 'default-block',
		],
		'core/audio'           => [
			'active' => true,
			'class'  => 'default-block',
		],
		'core/more'            => [
			'active' => true,
		],
		'core/media-text'      => [
			'active' => false,
		],
		'core/file'            => [
			'active' => false,
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
			'active' => false,
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
