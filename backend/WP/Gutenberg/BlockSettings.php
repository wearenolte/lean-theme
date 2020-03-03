<?php

namespace Lean\WP\Gutenberg;

/**
 * Enumeration for the config of core blocks.
 */
abstract class BlockSettings {

	const MEDIA_BLOCKS = [
		'core/image',
		'core/video',
		'core/audio',
		'acf/image-strip',
		'acf/slider',
	];

	/**
	 * Each block can have:
	 * -- active => true if the block should be displayed in the editor, false if not
	 *              (note that missing blocks will not be dispalyed by default).
	 * -- class => additional classes to add to the block.
	 */
	const CORE_BLOCKS = [
		'core/heading'         => [
			'active' => true,
			'class'  => 'standard-headings standard-text-spacing',
		],
		'core/paragraph'       => [
			'active' => true,
			'class'  => 'standard-text-spacing ' . DesignSystem::CLASSES['text.regular'],
		],
		'core/list'            => [
			'active' => true,
			'class'  => 'standard-lists standard-text-spacing ' . DesignSystem::CLASSES['text.regular'],
		],
		'core/code'            => [
			'active' => false,
			'class'  => 'p-2 border-solid border-1 border-black-10 rounded ' . DesignSystem::CLASSES['text.regular'],
		],
		'core/preformatted'    => [
			'active' => false,
			'class'  => 'p-2 border-solid border-1 border-black-10 rounded ' . DesignSystem::CLASSES['text.regular'],
		],
		'core/table'           => [
			'active' => true,
			'class'  => 'standard-table',
		],
		'core/separator'       => [
			'active' => true,
			'class'  => 'border-separator',
		],
		'core/columns'         => [
			'active' => true,
			'class'  => 'section-block md:flex ' . DesignSystem::CLASSES['gutter.wrapper'],
		],
		'core/group'           => [
			'active' => true,
			'class'  => 'section-block',
		],
		'core-embed/vimeo'     => [
			'active' => false,
			'class'  => 'media-block',
		],
		'core/video'           => [
			'active' => false,
			'class'  => 'media-block',
		],
		'core/pullquote'       => [
			'active' => true,
			'class'  => DesignSystem::CLASSES['text.regular'],
		],
		'core/quote'           => [
			'active' => true,
			'class'  => '',
		],
		'core/image'           => [
			'active' => true,
			'class'  => 'media-block',
		],
		'core/audio'           => [
			'active' => true,
			'class'  => 'media-block',
		],
		'core/more'            => [
			'active' => false,
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
