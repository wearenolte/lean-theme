// Import bootstrap.
import 'bootstrap/js/src/util'
import 'bootstrap/js/src/carousel'
import 'bootstrap/js/src/collapse'

// Styles.
import './style.scss'

import molecules from './components/molecules/molecules'

const ready = callback => {
  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', callback )
  } else {
    callback()
  }
}

// Call functions when dom is ready.
ready( () => {
  molecules()
})
