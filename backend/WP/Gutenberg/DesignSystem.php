<?php

namespace Lean\WP\Gutenberg;

/**
 * Enumeration of design system variables we need in PHP
 * (note that ideally we would read these from tailwind.config.js to save duplication, but for now this will do).
 */
abstract class DesignSystem {

	const EDITOR = [
		'COLORS'     => [
			'Black'      => '#000',
			'Light Gray' => '#f1f3f4',
		],
		'FONT_SIZES' => [
			'Regular' => 1,
			'Large'   => 1.125,
			'Small'   => .875,
		],
	];

	const CLASSES = [
		'text.regular'   => 'text-base text-black-100 font-primary leading-normal',
		'gutter.wrapper' => '-mx-1',
		'gutter.column'  => 'px-1',
	];

	const BREAKPOINTS = [
		'sm' => 576,
		'md' => 768,
		'lg' => 992,
		'xl' => 1200,
	];

}
