<?php

namespace Lean\WP\Gutenberg;

/**
 * Enumeration of design system variables we need in PHP
 * (note that ideally we would read these from tailwind.config.js to save duplication, but for now this will do).
 */
abstract class DesignSystem {

	const EDITOR_COLORS = [
		'Light Gray' => '#f1f3f4',
	];

}
