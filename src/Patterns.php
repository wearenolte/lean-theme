<?php namespace Leanp;

//use PatternLab\Config;
//use PatternLab\Console;
//use PatternLab\Dispatcher;
//use PatternLab\PatternData\Exporters\PatternPathSrcExporter;
//use PatternLab\PatternEngine\Twig\Loaders\PatternLoader;

/**
 * Class for working with twig templates from patternlab.
 */
class Patterns
{
//	private static $_loader;

	private static $_twig;

	/**
	 * Init.
	 */
	public static function init() {
//		Dispatcher::init();
//		$baseDir = get_template_directory() .'/vendor/pattern-lab/edition-twig-standard/';
//		Config::init($baseDir,false);
//
//		$ppdExporter             = new PatternPathSrcExporter();
//		$patternPathSrc          = $ppdExporter->run();
//		$options                 = array();
//		$options["patternPaths"] = $patternPathSrc;
////		$patternEngineBasePath   = PatternEngine::getInstance()->getBasePath();
////		$patternLoaderClass      = $patternEngineBasePath."\Loaders\PatternLoader";
////		$patternLoader           = new $patternLoaderClass($options);
//		self::$_loader = new PatternLoader($options);

		$loader = new \Twig_Loader_Filesystem( get_template_directory() . '/patterns/source/_patterns' );

		self::$_twig = new \Twig_Environment( $loader, array(
			'cache' => defined( 'WP_DEBUG' ) && WP_DEBUG ? false : get_template_directory() . '/cache/twig',
		) );
	}

	/**
	 * Render a template
	 *
	 * @param string $pattern The name of the pattern.
	 * @param array  $data    Data to pass to the pattern.
	 * @param bool   $echo	  Whether to echo the rendered template.
	 * @return bool|string
	 */
	public static function render( $pattern, $data = [], $echo = true ) {
//		$rendered = self::$_loader->render( $options );

		$rendered = self::$_twig->render( $pattern, $data );

		if ( $echo ) {
			echo $rendered;
			return true;
		}

		return $rendered;
	}
}
