'use strict';

// Load dependencies.
const gulp = require('gulp');
const notify = require('gulp-notify');
const watch = require('gulp-watch');
const sass = require('gulp-sass' );
const sourcemaps = require('gulp-sourcemaps');
const gutil = require('gulp-util');
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
// Used to minify the CSS
const cssnano = require('gulp-cssnano');
const autoprefixer = require('gulp-autoprefixer');
const sassLint = require('gulp-sass-lint');
// Execute gulp commands in sequence, one after the the other.
const runSequence = require('run-sequence');
const eslint = require( 'gulp-eslint');
const svgstore = require( 'gulp-svgstore' );
const svgmin = require('gulp-svgmin');
const path = require('path');

gulp.task( 'build', [ 'styles:build', 'js:build' ] );
gulp.task( 'build:dev', [ 'styles:dev', 'js:dev' ] );
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
gulp.task( 'js:build', jsBuild );
gulp.task( 'js:watch', jsWatch );
gulp.task( 'js:lint', jsLint );
gulp.task( 'watch', ['js:watch', 'styles:watch'] );
gulp.task( 'icons', icons );

// General Configurations
// Directories where JS and SCSS is placed.
const appDirectories = [ 'atoms', 'molecules', 'organisms', 'templates' ];
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
const loaders = [{
  test: /\.js$/,
  exclude: /node_modules/,
  loader: 'babel-loader',
  query: {
    presets: ['es2015']
  },
}];

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

  var prefixOptions = {
    browsers: supportedBrowsers,
    cascade: false,
  };

  return gulp.src( sassEntryFile )
    .pipe( sourcemaps.init() )
    .pipe( sass() ).on( 'error', function( error ) {
        notify.onError({
            title: "Sass Error",
            message: error.message
        })(error);
      }
    )
    .pipe( autoprefixer( prefixOptions ) )
    .pipe( sourcemaps.write( sourceMapsDirectories, sourceMapsOptions ) )
    .pipe( gulp.dest( cssDestination ))
    .on('end', () => log.success( 'Style compilation of sass into css file ended ') )
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
  log.success( 'CSS minification files started' );
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
  log.success( 'Add prefixes to the generated CSS file, started' );
  return gulp.src( cssGeneratedFile )
    .pipe( autoprefixer( prefixOptions ) )
    .pipe( gulp.dest( cssDestination ) );
}

/**
 * Watchs any change on sassDirectories path and on the sassEntryFile. If any
 * change is detected the `styles` task is triggered.
 */
function stylesWatch() {
  log.success( 'Start to watch for .scss changes' );
  watch( sassFiles, { ignoreInitial: true }, styles );
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
    .pipe( eslint.failAfterError() );
}

const webpackConfig = require('./webpack.config.js');
const jsEntryFile = './main.js';

/**
 * Function used to create the JS to be used on specifc pages, by default
 * creates a source map associated with each JS file to make easier to debug.
 */
function js() {
  let options = Object.assign(webpackConfig, { devtool: 'source-map' });
  return jsTask( options );
}

/**
 * Watches the changes of the JS and creates a single file with source maps,
 * the genreated JS is on dev mode.
 */
function jsWatch() {
  let options = Object.assign( webpackConfig, {
    devtool: 'source-map',
    watch: true,
    module: {
      loaders,
    }
  });
  return jsTask( options );
}

/**
 * Function that creates a Build file, in this case it creates a minifed version
 * of the generated JS useful for production purposes.
 */
function jsBuild() {
  let plugins = [
    new webpack.optimize.UglifyJsPlugin({
      compress: {
        warnings: false
      }
    })
  ];
  let options = Object.assign( webpackConfig, {
    plugins,
    module: {
      loaders,
    }
  });
  return jsTask( options );
}

/**
 * Function used to run webpack with a set of custom options based on the task
 * being executed.
 *
 * @param object options The options to be used to run webpack, by default uses webpack.config.js.
 * @return stream Returns a gulp task to be used.
 */
function jsTask( options ) {
  return gulp.src( jsEntryFile )
    .pipe( webpackStream( options, null, function(err, stats) {
      if ( stats.compilation.errors.length > 0 ) {
        notify.onError({
            title: "JS Error",
            message: stats.compilation.errors[0].error
        })(stats.compilation.errors[0].error);
      }
    }))
    .pipe( gulp.dest( './static/js' ) );
}

/*
 * Function used to log data to the console via gutil function
 */
const log = {
  success(msg) {
    gutil.log( gutil.colors.green( msg ) );
  }
}

function icons() {
  return gulp
    .src( [ 'static/icons/*.svg', '!static/icons/icons.svg' ] )
    .pipe( svgmin(function( file ) {
      const prefix = path.basename( file.relative, path.extname( file.relative ) );
      return {
        plugins: [{
            cleanupIDs: {
              prefix: prefix + '-',
              minify: true
            }
        }]
      }
    }))
    .pipe( svgstore({ inlineSvg: true }) )
    .pipe( gulp.dest( 'static/icons' ) );
}
