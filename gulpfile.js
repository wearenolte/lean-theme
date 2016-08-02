'use strict';

var gulp = require( 'gulp' );
var exec = require( 'child_process' ).exec;
var sass = require( 'gulp-sass' );
var sourcemaps = require( 'gulp-sourcemaps' );
var rename = require( 'gulp-rename' );
var autoprefixer = require( 'gulp-autoprefixer' );
var sassLint = require( 'gulp-sass-lint' );
var phpcs = require( 'gulp-phpcs' );
var browserSync = require( 'browser-sync' ).create();
var tap = require( 'gulp-tap' );
var fs = require( 'fs' );
var gutil = require( 'gulp-util' );
var watch = require( 'gulp-watch' );
var markdox = require( 'gulp-markdox' );

// var notify = require('gulp-notify');
// var babelify = require('babelify');
// var browserify = require('browserify');
// var uglify = require('gulp-uglify');
// var source = require('vinyl-source-stream');
// var buffer = require('vinyl-buffer');
// var gutil = require('gulp-util');
// var eslint = require('gulp-eslint');


var project = '.';
var patterns = project + '/patterns/';


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
 * > dev
 *
 * Runs styles:dev and js:dev
 */
gulp.task( 'dev', [ 'styles:dev', 'js:dev' ] );

/**
 * > watch
 *
 * Runs styles:watch and js:watch
 */
gulp.task( 'watch', [ 'styles:watch', 'js:watch' ] );

/**
 * > lint
 *
 * Runs styles:lint, js:lint and php:lint
 */
gulp.task( 'lint', [ 'styles:lint', 'js:lint', 'php:lint' ] );


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
gulp.task( 'pl:generate', execPatternlabCommand.bind( this, 'generate' ) );

/**
 * > pl:watch
 *
 * Watches for changes in the patterns/source folder and runs pl:generate. Note this does not watch for changes to SCSS files.
 *
 * This is a wrapper for Pattern Lab's own ```php core/console --watch``` command.
 */
gulp.task( 'pl:watch', execPatternlabCommand.bind( this, 'watch' ) );

/**
 * > pl:dev
 *
 * Fires up the Pattern Lab UI using BrowserSync.
 *
 * It watches for changes in SCSS and HTML and automatically compiles where necessary and updates the browser. This is the command you want to use when working on patterns.
 */
gulp.task( 'pl:dev', [ 'styles:watch', 'pl:watch' ], function() {
  browserSync.init( {
    server: patterns + 'public'
  } );

  watch( patterns + 'public/css/style.css', { ignoreInitial: true }, function() {
    gulp.src( patterns + 'public/css/style.css' )
      .pipe( browserSync.stream() );
  } );

  watch( patterns + 'source/_patterns/**/*.twig', { ignoreInitial: true } )
    .on( 'change', browserSync.reload );
} );

function execPatternlabCommand( command ) {
  exec( 'cd vendor/pattern-lab/edition-twig-standard && php core/console --' + command, function( err, stdout, stderr ) {
    console.log( stdout );
    console.log( stderr );
  } );
}


/**
 * ## Styles
 */

/**
 * > styles:build
 *
 * Compiles minified version of the CSS and adds cross-browser prefixes.
 */
gulp.task( 'styles:build', [ 'styles:collate' ], function() {
  return gulp.src( patterns + 'source/css/style.scss' )
    .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
    .pipe( autoprefixer(
      'last 2 version',
      'ie 9',
      'ios 7',
      'android 4'
    ) )
    .pipe( rename( 'style.min.css' ) )
    .pipe( gulp.dest( patterns + 'css' ) );
} );

/**
 * > styles:dev
 *
 * Compiles the unminified version of the CSS including sourcemaps. Does not add cross-browser prefixes.
 */
gulp.task( 'styles:dev', [ 'styles:collate' ], function() {
  var error = function( e ) {
    gutil.log( e );
    stream.end();
  };

  var stream = gulp.src( patterns + 'source/css/style.scss' )
    .pipe( sourcemaps.init() )
    .pipe( sass().on( 'error', error ) )
    .pipe( sourcemaps.write() )
    .pipe( gulp.dest( patterns + 'source/css' ) );
} );

/**
 * > styles:watch
 *
 * Watches for changes to SCSS files in patterns/source/_patterns and runs styles:dev.
 */
gulp.task( 'styles:watch', function() {
  watch( patterns + 'source/_patterns/**/*.scss', { ignoreInitial: false }, function() {
    gulp.start( 'styles:dev' );
  } );
} );

/**
 * > styles:collate
 *
 * Builds the master _styles.scss file by including imports for all *.scss files found in patterns/source/_patterns.
 *
 * It will import files with the .p1.scss (p1 = priority 1) first, so use this on files with variables or other styles which must be loaded at the top of the compiled CSS file.
 */
gulp.task( 'styles:collate', function( cb ) {
  var stream = fs.createWriteStream( patterns + 'source/css/style.scss' );

  var write = function( file ) {
    stream.write( '@import \'' + file.path + '\';\r\n' );
  };

  var lowerPriority = function() {
    gulp.src( [ patterns + 'source/_patterns/**/*.scss', '!' + patterns + 'source/_patterns/**/*.p1.scss' ] )
      .pipe( tap( write ) )
      .on( 'end', cb )
  };

  gulp.src( patterns + 'source/_patterns/**/*.p1.scss' )
    .pipe( tap( write ) )
    .on( 'end', lowerPriority );
} );

/**
 * > styles:lint
 *
 * Validates the SCSS according to our rules defined in .sass-lint.yml.
 */
gulp.task( 'styles:lint', function() {
  return gulp.src( patterns + 'source/css/**/*.scss' )
    .pipe( sassLint() )
    .pipe( sassLint.format() )
    .pipe( sassLint.failOnError() )
} );


/**
 * ## PHP
 */

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
    .pipe( gulp.dest( "./docs" ) );
} );


/**
 * ## Javascript
 */

gulp.task( 'js:build', function() {

} );

gulp.task( 'js:dev', function() {

} );

gulp.task( 'js:watch', function() {

} );

gulp.task( 'js:lint', function() {

} );


// // Task to combine and minify the js scripts.
// gulp.task('js', ['js:combine', 'js:minify'], function() {
//   return;
//   return gulp.src( sourcePath + 'js/production.js')
//   .pipe( notify({
//     title: 'JS completed',
//     message: 'The JS has been created',
//     onLast: true,
//     icon: './assets/images/notify/js.png',
//   }));
// });
//
// /**
//  * Runs a minify task to combine and minify the scripts after are combined in
//  * a single file stored in js as production.js
//  */
// gulp.task('js:minify', ['js:combine_without_sourcemaps'], function(){
//   return gulp.src(sourcePath + 'js/production-min.js')
//   .pipe(uglify())
//   .pipe(gulp.dest(sourcePath + 'js'));
// });
//
// gulp.task('js:combine_without_sourcemaps', function(){
//   return browserified({
//     debug: false,
//     output: 'production-min.js'
//   });
// });
//
// /**
//  * Combines all the files in the scripts array, and creates a source map for the
//  * generated file to easy access to the original files from the browser to
//  * enable faster development process.
//  */
// gulp.task('js:combine', ['browserify']);
//
// gulp.task('browserify', function(){
//   return browserified({
//     debug: true,
//     output: 'production.js'
//   });
// });
//
// var mainJS = sourcePath + 'js/app/main.js';
//
// function browserified( opts ){
//   var options = opts || {};
//   return browserify(mainJS, options)
//   .transform(babelify, {
//     presets: ['es2015']
//   })
//   .bundle()
//   .on('error', gutil.log.bind(gutil, 'Browserify Error'))
//   .pipe(source( options.output ))
//   .pipe(gulp.dest( sourcePath + '/js'));
// };
//
// // Files to inspect in order to follow the same standard
// var jsFiles = [ sourcePath + 'js/app/**/*.js' ];
//
// // Tasks that are handle the lints without breaking the gulp report
// gulp.task('js:lint', ['js:cs']);
//
// // Gulp taks to analyze the code using JS CS rules witouth breaking gulp
// gulp.task('js:cs', function() {
//   return gulp.src( jsFiles )
//   .pipe(eslint())
//   .pipe(eslint.format())
//   .pipe( notify({ message: 'JS Completed', onLast: true }) );
// });
//
// // Tasks for continuous integration using the JS CS rules
// gulp.task('js:cs-ci', function() {
//   return gulp.src( jsFiles )
//   .pipe(eslint())
//   .pipe(eslint.format())
//   .pipe(eslint.failAfterError());
// });
//
// // Group of JS tasks for continuous integration
// gulp.task('js:ci', ['js:cs-ci']);
//

