/**
 * Function that creates the menu logic for the header
 */
function menu() {
  const activeClass = 'is-active';
  const hamburger = document.querySelector( '.m__primary-nav .a__hamburger' );
  const menu = document.querySelector( '.m__primary-nav .main-nav' );

  hamburger.addEventListener( 'click', toggle );

  /**
   * Function that is called every time the hamburger element is clicked.
   */
  function toggle() {
    hamburger.classList.toggle( activeClass );
    menu.classList.toggle( activeClass );
  }
}

export default menu;
