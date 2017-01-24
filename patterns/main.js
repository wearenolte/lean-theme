import ready from './templates/shared/ready';
import analytics from './templates/shared/analytics';

/**
 * Function that is fired once the page is Reaady to fire any JS, add anything
 * required to be executed after the page is ready.
 */
function onReady() {
  analytics();
}

// The callback is fired when the dom is ready.
ready( onReady );
