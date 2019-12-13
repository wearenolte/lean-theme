import styleSelect from 'styleselect'

/**
 * Init SelectStyle to all Selects.
 * http://mikemaccana.github.io/styleselect/
 */
export default function initStyleSelect() {
  const selects = document.querySelectorAll( '.select' )

  setTimeout( () =>
    selects.forEach( select => {
      styleSelect( select )
    })
  )
}