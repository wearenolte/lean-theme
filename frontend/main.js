// Styles.
import './tailwind.css'
import './style.scss'

import $ from 'jquery'
import atoms from './components/atoms/atoms'
import molecules from './components/molecules/molecules'

// Call functions when dom is ready.
$( document ).ready( () => {
  molecules()
  atoms()
})
