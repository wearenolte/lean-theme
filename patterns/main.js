const ready = require( './templates/shared/ready' );

/*
 * Function that is fired once the page is Reaady to fire any JS, add anything
 * required to be executed after the page is ready.
 */
function onReady() {
  require( './templates/shared/analytics' )();
}

ready( onReady );
