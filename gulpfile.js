'use strict';

var gulp = require( 'gulp' );
var rename = require( 'gulp-rename' );
var phpcs = require( 'gulp-phpcs' );
var browserSync = require( 'browser-sync' ).create();
var watch = require( 'gulp-watch' );
var markdox = require( 'gulp-markdox' );
var shell = require( 'gulp-shell' );


var project = '.';
var patterns = project + '/patterns/';
var vendor = project + '/vendor/';
var patternsSource = patterns + 'source/';
var patternsPublic = patterns + 'public/';
var patternLab = vendor + 'pattern-lab/edition-twig-standard/';


/**
 * # Gulp Commands
 *
 * Run them with ```gulp <command>```, e.g. ```gulp pl:dev```.
 */


/**
 * ## General
 */

/**
 * > Default task
 *
 * Runs pl:dev
 */
gulp.task( 'default', [ 'pl:dev' ] );





/**
 * ## Pattern Lab
 */

/**
 * > pl:generate
 *
 * Runs Pattern Lab's generate command. This will convert the patterns in the patterns/source folder to the right format, and copy them to the patterns/public folder ready to be viewed. Note this does not compile the CSS from SCSS.
 *
 * This is a wrapper for Pattern Lab's own ```php core/console --generate``` command.
 */
gulp.task( 'pl:generate', shell.task( [
  'cd ' + patternLab + ' && php core/console --generate'
] ) );

/**
 * > pl:watch
 *
 * Watches for changes in the patterns/source folder and runs pl:generate. Note this does not watch for changes to SCSS files.
 *
 * This is a wrapper for Pattern Lab's own ```php core/console --watch``` command.
 */
gulp.task( 'pl:watch', shell.task( [
  'cd ' + patternLab + ' && php core/console --watch'
] ) );

/**
 * > pl:bs
 *
 * Fires up the Pattern Lab UI using BrowserSync. Automatically refreshes the browser whenever the patterns are built.
 */
gulp.task( 'pl:bs', function() {
  browserSync.init( {
    server: patternsPublic
  } );

  watch( [
    patternsPublic + '**/*.css',
    patternsPublic + '**/*.html',
    patternsPublic + '**/*.js'
  ] )
    .on( 'change', browserSync.reload );

  // watch( patternsPublic + 'css/style.css', { events: ['change'] }, function() {
  //   gulp.src( patternsPublic + 'css/style.css' )
  //     .pipe( browserSync.stream() );
  // } );
} );

/**
 * > pl:dev
 *
 * Fires up the Pattern Lab UI using BrowserSync.
 *
 * It watches for changes in SCSS and HTML and automatically compiles where necessary and updates the browser. This is the command you want to use when working on patterns.
 */
gulp.task( 'pl:dev', [ 'view:watch', 'pl:watch', 'pl:bs' ] );

/**
 * > patterns:watch
 *
 * Wrapper for `npm run watch` for the front-end files.
 */
gulp.task( 'view:watch', shell.task( [
  'cd ' + patternsSource + ' && npm run watch'
] ) );


/**
 * ## Lint
 */

/**
 * > lint
 *
 * Runs php:lint and all lint tasks for the front-end files.
 */
gulp.task( 'lint', [ 'php:lint', 'view:lint' ] );

/**
 * > php:lint
 *
 * Validates the PHP according to the standard WordPress rules with some exceptions. These are defined in codesniffer.ruleset.xml.
 */
gulp.task( 'php:lint', function() {
  var phpFiles = [
    '*.php',
    'src/**/*.php'
  ];

  var phpOptions = {
    bin: './vendor/bin/phpcs',
    standard: './codesniffer.ruleset.xml',
    colors: true
  };

  return gulp.src( phpFiles )
    .pipe( phpcs( phpOptions ) )
    .pipe( phpcs.reporter( 'log' ) )
    .pipe( phpcs.reporter( 'fail' ) );
} );

/**
 * > view:lint
 *
 * Wrapper for `npm run lint` for the front-end files.
 */
gulp.task( 'view:lint', shell.task( [
  'cd ' + patternsSource + ' && npm run lint'
] ) );


/**
 * ## Documentation
 */

/**
 * > docs
 *
 * Builds this documentation for the Gulp Commands.
 */
gulp.task( 'docs', function() {
  gulp.src( './gulpfile.js' )
    .pipe( markdox() )
    .pipe( rename( 'gulp-commands.md' ) )
    .pipe( gulp.dest( './docs' ) );
} );
