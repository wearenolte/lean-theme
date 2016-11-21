'use strict';

var gulp = require('gulp');
var sass = require( 'gulp-sass' );


// GULP TASKS
gulp.task( 'styles', styles );
gulp.task( 'styles:watch', stylesWatch );

/**
 * Function that is used to compile the sass files into CSS it used the
 * file defined on entryFile as the entry point of the sass to generate the final
 * CSS file.
 */
function styles() {
  var entryFile = './style.scss';
  var destination = './static/css/';

  return gulp.src( entryFile )
  .pipe( sass.sync() ).on( 'error', sass.logError )
  .pipe( gulp.dest( destination ))
}

function stylesWatch() {
  var files = [
    './style.scss',
    './{atoms,molecules,organisms,templates}/**/*.scss',
  ];
  gulp.watch( files, ['styles'] );
}
