<?php namespace LeanNs;

/**
 * Class for working with twig templates from patternlab.
 */
class Patterns
{
	/**
	 * Init.
	 */
	public static function init() {
	}

	/**
	 * Return with acf fields added in a usable format.
	 *
	 * @return array|bool|null
	 */
	public static function get_posts() {
		$posts = [];

		foreach ( $posts as &$post ) {
			$post->acf = \Lean\Acf::get_post_field( $post->id );
			$post->post_content = do_shortcode( $post->post_content );
		}

		return $posts;
	}

	/**
	 * Return with acf fields added in a usable format.
	 *
	 * @return array|bool|null
	 */
	public static function get_post() {
		$post = [];

		$post->acf = \Lean\Acf::get_post_field( $post->id );
		$post->post_content = do_shortcode( $post->post_content );

		return $post;
	}
}
