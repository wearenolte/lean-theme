/**
 * Adds a small time delay so that a function is not executed too many times sequentially.
 *
 * @param {Function} callback - The function to delay.
 * @param {number} limit - The time of delay.
 * @returns {Function} The delayed function.
 */
export function throttle( callback, limit ) {
  var wait = false
  return function () {
    if ( !wait ) {
      callback.call()
      wait = true
      setTimeout( function delayFunction() {
        wait = false
      }, limit )
    }
  }
}

/**
 * Checks if the page is rendered in a small device.
 *
 * @returns {boolean}
 */
export function isMobile() {
  return window.innerWidth <= 640
}

/**
 * Checks if the page is rendered in a medium device.
 *
 * @returns {boolean}
 */
export function isTablet() {
  return window.innerWidth <= 768
}

/**
 * Checks if the page is rendered in the styleguide.
 *
 * @returns {boolean}
 */
export function isStyleguide() {
  return document.querySelector( '.js-lean-styleguide' ) !== null
}