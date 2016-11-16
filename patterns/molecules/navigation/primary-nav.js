'use strict';

module.exports = function module() {
  const activeClass = 'is-active';
  const hamburger = document.querySelector( '.m__primary-nav .a__hamburger' );
  const menu = document.querySelector( '.m__primary-nav .main-nav' );

  hamburger.onclick = toggle;

  function toggle() {
    hamburger.classList.toggle( activeClass );
    menu.classList.toggle( activeClass );
  }
};
