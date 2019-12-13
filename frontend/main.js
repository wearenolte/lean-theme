// Styles.
import './tailwind.css'
import './style.scss'

import $ from 'jquery'
import atoms from './components/atoms/atoms'

// Call functions when dom is ready.
$( document ).ready( () => {
  atoms()
})
