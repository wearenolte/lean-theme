/**
 * Function that toggles the header menu.
 */
export default function header () {
  const hamburgerSelector = '[data-type="atom/buttons/hamburger"]' 
  const menuSelector = '[data-type="organism/header/header"] ul'
  const hamburger = document.querySelector( hamburgerSelector )

  hamburger.addEventListener( 'click', toggle )

  /**
   * Perform the toggle.
   */
  function toggle () {
    const expanded = 'true' === hamburger.getAttribute( 'aria-expanded' )
    const menu = document.querySelector( menuSelector )

    if ( expanded ) {
      menu.classList.add( 'hidden' )
      hamburger.classList.remove( 'expanded' )
      hamburger.classList.add( 'collpased' )
      hamburger.setAttribute( 'aria-expanded', 'false' )
    } else {
      menu.classList.remove( 'hidden' )
      hamburger.classList.add( 'expanded' )
      hamburger.classList.remove( 'collpased' )
      hamburger.setAttribute( 'aria-expanded', 'true' )
    }
  }
}
