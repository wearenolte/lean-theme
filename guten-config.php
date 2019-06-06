<?php
return [

	/**
	 * FONT SIZES.
	 */
	// You can add as many font sizes as you need. You'll have to edit the styles in
	// atoms/base/_typography.scss by adding the slugs and font sizes.
	// You can also remove all the sizes to disable the font size select option completely.
	'font_sizes' => [
		[
			'name' => __( 'Small', 'LeanName' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Regular', 'LeanName' ),
			'size' => 16,
			'slug' => 'regular',
		],
		[
			'name' => __( 'Large', 'LeanName' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Huge', 'LeanName' ),
			'size' => 40,
			'slug' => 'huge',
		],
	],

	/**
	 * COLORS.
	 */
	// You can add as many colors as you need. You'll have to edit the styles in
	// atoms/base/_colors.scss by adding the slugs and colors.
	// You can also remove all the colors to disable the color settings completely.
	'colors' => [
		[
			'name'  => __( 'White', 'LeanName' ),
			'slug'  => 'white',
			'color' => '#FFFFFF',
		],
		[
			'name'  => __( 'Gray 1', 'LeanName' ),
			'slug'  => 'gray-1',
			'color' => '#F5F5F5',
		],
		[
			'name'  => __( 'Gray 2', 'LeanName' ),
			'slug'  => 'gray-2',
			'color' => '#DCDCDC',
		],
		[
			'name'  => __( 'Gray 3', 'LeanName' ),
			'slug'  => 'gray-3',
			'color' => '#C0C0C0',
		],
		[
			'name'  => __( 'Gray 4', 'LeanName' ),
			'slug'  => 'gray-4',
			'color' => '#A9A9A9',
		],
		[
			'name'  => __( 'Gray 5', 'LeanName' ),
			'slug'  => 'gray-5',
			'color' => '#808080',
		],
		[
			'name'  => __( 'Gray 6', 'LeanName' ),
			'slug'  => 'gray-6',
			'color' => '#696969',
		],
		[
			'name'  => __( 'Black', 'LeanName' ),
			'slug'  => 'black',
			'color' => '#000000',
		],
	],

	/**
	 * BLOCKS.
	 */
	// You can add or remove the blocks you want to use in your theme.
	// The blocks added to 'common' are the ones that will be allowed on all the pages and post types.
	// You can also add your custom post type slugs here to allow certain blocks per CPT.
	'blocks' => [

		'common' => [
			// Common blocks.
			'core/image',
			'core/paragraph',
			'core/heading',
			'core/list',
			'core/gallery',
			'core/quote',
			'core/audio',
			'core/cover',
			'core/file',
			'core/video',

			// ACF blocks.
			'acf/acf-button',
		],

		'post' => [
			// Formatting.
			'core/table',
			'core/verse',
			'core/code',
			'core/freeform',
			'core/html',
			'core/preformatted',
			'core/pullquote',

			// Layout Elements.
			// 'core/button', // Disabled by default to use the ACF custom block.
			'core/text-columns',
			'core/media-text',
			'core/more',
			'core/nextpage',
			'core/separator',
			'core/spacer',

			// Widgets.
			'core/shortcode',
			'core/archives',
			'core/categories',
			'core/latest-comments',
			'core/latest-posts',
			'core/calendar',
			'core/rss',
			'core/search',
			'core/tag-cloud',

			// Embeds.
			'core/embed',
			'core-embed/twitter',
			'core-embed/youtube',
			'core-embed/facebook',
			'core-embed/instagram',
			'core-embed/wordpress',
			'core-embed/soundcloud',
			'core-embed/spotify',
			'core-embed/flickr',
			'core-embed/vimeo',
			'core-embed/animoto',
			'core-embed/cloudup',
			'core-embed/collegehumor',
			'core-embed/dailymotion',
			'core-embed/funnyordie',
			'core-embed/hulu',
			'core-embed/imgur',
			'core-embed/issuu',
			'core-embed/kickstarter',
			'core-embed/meetup-com',
			'core-embed/mixcloud',
			'core-embed/photobucket',
			'core-embed/polldaddy',
			'core-embed/reddit',
			'core-embed/reverbnation',
			'core-embed/screencast',
			'core-embed/scribd',
			'core-embed/slideshare',
			'core-embed/smugmug',
			'core-embed/speaker',
			'core-embed/ted',
			'core-embed/tumblr',
			'core-embed/videopress',
			'core-embed/wordpress-tv',
		],
	],
];
