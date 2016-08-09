<?php namespace LeanNs;

use Timber\Timber;

/**
 * Class for working with twig templates from patternlab.
 */
class Patterns
{
	/**
	 * Init.
	 */
	public static function init() {
		$timber = new \Timber\Timber();

		Timber::$dirname = [ 'patterns/source/_patterns', 'patterns/patternlab-starterkit-twig/dist/_patterns' ];
	}

	/**
	 * Return Timber::get_posts() with acf fields added in a usable format.
	 *
	 * @return array|bool|null
	 */
	public static function get_posts() {
		$posts = Timber::get_posts();

		foreach ( $posts as &$post ) {
			$post->acf = \Lean\Acf::get_post_field( $post->id );
		}

		return $posts;
	}
}
