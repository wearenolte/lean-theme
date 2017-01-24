/**
* Function that is fired every time the browsers fires a new error event.
*
* @param {Object} error An object with the details of the error.
*/
function errorListener( error ) {
  if ( '_gaq' in window ) {
    _gaq.push([
      '_trackEvent',
      'JavaScript Error',
      error.message,
      `${error.filename}: ${error.lineno}`,
      true
    ]);
  }
}

/**
 * Function that is used to attach an error listener to keep track of the JS
 * generated errors with JS.
 *
 * @source https://davidwalsh.name/track-errors-google-analytics
 */
function attachListener() {
  window.addEventListener( 'error', errorListener );
}

export default attachListener;
