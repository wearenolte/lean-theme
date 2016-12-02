'use strict';

// Load dependencies.
const gulp = require('gulp');
const sass = require('gulp-sass' );
const sourcemaps = require('gulp-sourcemaps');
const gutil = require('gulp-uti');
const webpack = require('webpack');
const webpackConfig = require( './webpack.config.js' );
// Used to minify the CSS
const cssnano = require('gulp-cssnano');
const autoprefixer = require('gulp-autoprefixer');
const sassLint = require('gulp-sass-lint');
// Execute gulp commands in sequence, one after the the other.
const runSequence = require('run-sequence');
const eslint = require( 'gulp-eslint');

// List of tasks see each function for more details about each.
gulp.task( 'styles', styles );
gulp.task( 'styles:dev', styles );
gulp.task( 'styles:build', build );
gulp.task( 'styles:prefix', stylesPrefix );
gulp.task( 'styles:minify', stylesMinify );
gulp.task( 'styles:watch', stylesWatch );
// Linter tasks
gulp.task( 'lint', ['styles:lint', 'js:lint'] );
gulp.task( 'styles:lint', stylesLint );
// JS Tasks
gulp.task( 'js', js );
gulp.task( 'js:dev', js );
gulp.task( 'js:lint', jsLint );

// General Configurations
// Directories where JS and SCSS is placed.
const appDirectories = [ 'atoms', 'molecules', 'templates' ];
// CSS configuration values.
const sassEntryFile = './style.scss';
const cssDestination = './static/css';
const cssGeneratedFile = './static/css/style.css';
// Patterns from where all the sass files are located.
const sassFiles = [
  sassEntryFile,
  './{' + appDirectories.join( ',' ) + '}/**/*.scss',
];
// Browser where prefixers required to be added.
const supportedBrowsers = ['Explorer >= 11', 'iOS >= 7', 'Safari >= 9'];
// Where the sass files are located, used to watch changes on these directories.
const sourceMapsDirectories = './../maps';

/**
 * Function that creates a build file:
 *
 * 1. Compiles the sass file to CSS
 * 2. Minify the generated CSS File
 * 3. Adds prefixes to the final file.
 */
function build( callback ) {
  runSequence( 'styles', 'styles:minify', callback );
}

/**
 * Compiles the sassEntryFile into CSS, also it adds the source maps of the
 * styles in order to locate easily where the styles where defined.
 */
function styles() {
  // Set sourceRoot option to the source maps to link to the original file.
  var sourceMapsOptions = {
    sourceRoot: './../../',
  };

  return gulp.src( sassEntryFile )
    .pipe( sourcemaps.init() )
    .pipe( sass() ).on( 'error', sass.logError )
    .pipe( sourcemaps.write( sourceMapsDirectories, sourceMapsOptions ) )
    .pipe( gulp.dest( cssDestination ))
}

/**
 * Function used to minify the cssGeneratedFile it also adds the prefixes
 * to the minified file based on the supportedBrowsers array.
 */
function stylesMinify() {
  const minifyOptions = {
    autoprefixer: {
      browsers: supportedBrowsers,
      add: true,
    }
  };
  return gulp.src( cssGeneratedFile )
    .pipe( cssnano( minifyOptions ) )
    .pipe( gulp.dest( cssDestination ) );
}

/**
 * Function used to add prefixes to the generated CSS file based on the
 * supportedBrowsers array.
 */
function stylesPrefix() {
  var prefixOptions = {
    browsers: supportedBrowsers,
    cascade: false,
  };
  return gulp.src( cssGeneratedFile )
    .pipe( autoprefixer( prefixOptions ) )
    .pipe( gulp.dest( cssDestination ) );
}

/**
 * Watchs any change on sassDirectories path and on the sassEntryFile. If any
 * change is detected the `styles` task is triggered.
 */
function stylesWatch() {
  gulp.watch( sassFiles, ['styles'] );
}

/**
 * Function that is used to lint on all the sass files and follow all the rules
 * specified on .sass-lint.json
 */
function stylesLint() {
  return gulp.src( sassFiles )
    .pipe( sassLint() )
    .pipe( sassLint.format() )
    .pipe( sassLint.failOnError() );
}

/**
 * Function used to lint on the JS files, using the rules specified on
 * .eslintrc.json.
 */
function jsLint() {
  const jsFiles = [
    './main.js',
    './{' + appDirectories.join( ',' ) + '}/**/*.js',
  ];
  return gulp.src( jsFiles )
    .pipe( eslint() )
    .pipe( eslint.format() )
    .pipe( eslint.failOnError() );
}

var myDevConfig = Object.create(webpackConfig);
myDevConfig.devtool = "sourcemap";
myDevConfig.debug = true;
function js() {
}
