/**
 * Function that opens the mobile menu when clicking the hamburger
 */
export default function toggleMobileMenu () {
  const hiddenClass = 'hidden'
  const expandedClass = 'expanded'
  const hamburgerClass = '.hamburger'

  document.querySelector( hamburgerClass ).addEventListener( 'click', toggle )

  /**
   * Toggle the mobile menu.
   * 
   * @param {event} event The event triggering this function.
   */
  function toggle ( event ) {
    const hamburger = event.target.classList.contains( hamburgerClass ) ? event.target : event.target.parentNode
    const menu = document.querySelector( hamburger.getAttribute( 'data-target' ) )

    if ( hamburger.classList.contains( expandedClass ) ) {
      hamburger.classList.remove( expandedClass )
      menu.classList.add( hiddenClass )
    } else {
      hamburger.classList.add( expandedClass )
      menu.classList.remove( hiddenClass )
    }
  }
}