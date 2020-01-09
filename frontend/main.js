// Styles.
import './tailwind.css'

import $ from 'jquery'
import atoms from './components/atoms/atoms'
import organisms from './components/organisms/organisms'

// Call functions when dom is ready.
$( document ).ready( () => {
  organisms()
  atoms()
})
