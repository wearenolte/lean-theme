'use strict';

var gulp = require( 'gulp' );
var sass = require( 'gulp-sass' );
var rename = require( 'gulp-rename' );
var phpcs = require( 'gulp-phpcs' );
var browserSync = require( 'browser-sync' ).create();
var watch = require( 'gulp-watch' );
var markdox = require( 'gulp-markdox' );
var shell = require( 'gulp-shell' );


var project = '.';
var vendor = project + '/vendor/';

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
