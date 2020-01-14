// Styles.
import './tailwind.css'

import atoms from './components/atoms/atoms'
import molecules from './components/molecules/molecules'

// Note that DOMContentLoaded is available in IE9+ so you'll have to look at a more complex solution if you need 
// to support older browsers, see https://stackoverflow.com/questions/799981/document-ready-equivalent-without-jquery.
document.addEventListener( 'DOMContentLoaded', () => {
  molecules()
  atoms()
})
