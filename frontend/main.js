// Styles.
import './tailwind.css'

// Our custom JS
import atoms from './components/atoms/atoms'
import molecules from './components/molecules/molecules'
import organisms from './components/organisms/organisms'

// Note that DOMContentLoaded is available in IE9+ so you'll have to look at a more complex solution if you need
// to support older browsers, see https://stackoverflow.com/questions/799981/document-ready-equivalent-without-jquery.
document.addEventListener( 'DOMContentLoaded', () => {
  atoms()
  molecules()
  organisms()
})
