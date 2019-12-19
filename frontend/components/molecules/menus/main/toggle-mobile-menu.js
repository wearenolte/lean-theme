/**
 * Function that opens the mobile menu when clicking the hamburger
 */
export default function toggleMobileMenu () {
  const activeClass = 'is-active'
  const hamburger = document.querySelector( '.js-hamburger' )
  const menu = document.querySelector( '.js-menu-container' )

  if ( !hamburger || !menu ) {
    return
  }

  hamburger.addEventListener( 'click', toggle )

  /**
   * Open mobile menu.
   */
  function openMenu() {
    hamburger.classList.add( activeClass )
    menu.classList.add( activeClass )
    menu.classList.remove( 'hidden' )
  }

  /**
   * Close mobile menu.
   */
  function closeMenu() {
    hamburger.classList.remove( activeClass )
    menu.classList.remove( activeClass )
    menu.classList.add( 'hidden' )
  }

  /**
   * Function that is called every time the hamburger element is clicked.
   */
  function toggle () {
    if ( hamburger.classList.contains( activeClass ) ) {
      closeMenu()
    } else {
      openMenu()
    }
  }
}