import SmoothScroll from 'smooth-scroll'

/**
 * Polyfill for smooth scroll behaviour
 */
export default function smoothScrollAnimation () {
  if ( !( 'scrollBehavior' in document.documentElement.style ) ) {
    new SmoothScroll( 'a[href*="#"]' )
  }
}
