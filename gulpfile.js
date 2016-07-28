'use strict';

/******************************************************************************
 | >   PLUGINS
 ******************************************************************************/

var gulp = require( 'gulp' );
var exec = require( 'child_process' ).exec;
var sass = require( 'gulp-sass' );
var sourcemaps = require( 'gulp-sourcemaps' );
var rename = require( 'gulp-rename' );
var autoprefixer = require( 'gulp-autoprefixer' );
var sassLint = require( 'gulp-sass-lint' );
var phpcs = require( 'gulp-phpcs' );
var browserSync = require( 'browser-sync' ).create();


// var notify = require('gulp-notify');
// var babelify = require('babelify');
// var browserify = require('browserify');
// var uglify = require('gulp-uglify');
// var source = require('vinyl-source-stream');
// var buffer = require('vinyl-buffer');
// var gutil = require('gulp-util');
// var eslint = require('gulp-eslint');


/******************************************************************************
 | >  Variables
 ******************************************************************************/

var project = '.';
var patterns = project + '/patterns/';


/******************************************************************************
 | >   General
 ******************************************************************************/

gulp.task( 'default', [ 'pl:dev' ] );
gulp.task( 'dev', [ 'styles:dev', 'js:dev' ] );
gulp.task( 'watch', [ 'styles:watch', 'js:watch' ] );
gulp.task( 'lint', [ 'styles:lint', 'js:lint', 'php:lint' ] );


/******************************************************************************
 | >  Patternlab
 ******************************************************************************/

var execPatternlabCommand = function ( command ) {
  exec( 'cd vendor/pattern-lab/edition-twig-standard && php core/console --' + command, function ( err, stdout, stderr ) {
    console.log( stdout );
    console.log( stderr );
  } );
};

gulp.task( 'pl:help', execPatternlabCommand.bind( this, 'help' ) );

gulp.task( 'pl:generate', execPatternlabCommand.bind( this, 'generate' ) );

gulp.task( 'pl:watch', execPatternlabCommand.bind( this, 'watch' ) );

gulp.task( 'pl:dev', [ 'styles:dev', 'styles:watch', 'pl:watch' ], function () {
  browserSync.init( {
    server: patterns + 'public'
  } );

  gulp.watch( patterns + 'public/css/style.css', { ignoreInitial: true }, function () {
    gulp.src( patterns + 'public/css/style.css' )
      .pipe( browserSync.stream() );
  } );

  gulp.watch( patterns + 'source/_patterns/**/*.twig', { ignoreInitial: true } )
    .on( 'change', browserSync.reload );
} );


/******************************************************************************
 | >   Styles
 ******************************************************************************/

gulp.task( 'styles:build', function () {
  return gulp.src( patterns + 'source/css/style.scss' )
    .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
    .pipe( rename( 'style.min.css' ) )
    .pipe( gulp.dest( patterns + 'css' ) );
} );

gulp.task( 'styles:dev', function () {
  return gulp.src( patterns + 'source/css/style.scss' )
    .pipe( sourcemaps.init() )
    .pipe( sass().on( 'error', sass.logError ) )
    .pipe( autoprefixer(
      'last 2 version',
      'ie 9',
      'ios 7',
      'android 4'
    ) )
    .pipe( sourcemaps.write() )
    .pipe( gulp.dest( patterns + 'source/css' ) );
} );

gulp.task( 'styles:watch', function () {
  gulp.watch( patterns + 'source/css/**/*.s+(a|c)ss', [ 'styles:dev' ] );
} );

gulp.task( 'styles:lint', function () {
  return gulp.src( patterns + 'source/css/**/*.s+(a|c)ss' )
    .pipe( sassLint() )
    .pipe( sassLint.format() )
    .pipe( sassLint.failOnError() )
} );


/******************************************************************************
 | >   PHP
 ******************************************************************************/

var phpFiles = [
  '*.php',
  'src/**/*.php'
];

var phpOptions = {
  bin: './vendor/bin/phpcs',
  standard: './codesniffer.ruleset.xml',
  colors: true
};

gulp.task( 'php:lint', function () {
  return gulp.src( phpFiles )
    .pipe( phpcs( phpOptions ) )
    .pipe( phpcs.reporter( 'log' ) )
    .pipe( phpcs.reporter( 'fail' ) );
} );


/******************************************************************************
 | >   JS TASKS
 ******************************************************************************/

gulp.task( 'js:build', function () {

} );

gulp.task( 'js:dev', function () {

} );

gulp.task( 'js:watch', function () {

} );

gulp.task( 'js:lint', function () {

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

