import 'intersection-observer'

/**
 * Function that triggers animations on scroll.
 */
export default function scroll () {
  const animTriggerClass = 'anim-enter-trigger'
  const animElems = document.querySelectorAll(
    // All columns:
    '[data-cols] > *,' + 
    // All top-level elements except cols and groups:
    '.post-content > :not([data-type="core/columns"]):not([data-type="core/group"]),' +
    // All elements in a top-level group except other cols and groups:
    '.post-content > [data-type="core/group"] > * > :not([data-type="core/columns"]):not([data-type="core/group"])'
  )

  const io = new IntersectionObserver(
    entries => {
      entries.forEach( entry => {
        if ( entry.intersectionRatio > 0 ) {
          entry.target.classList.add( animTriggerClass ) 
          io.unobserve( entry.target )
        }
      })
      
    }
  )

  animElems.forEach( element => {
    io.observe( element )
  })
}
