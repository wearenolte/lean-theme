// Import bootstrap.
import 'bootstrap/js/src/util'
import 'bootstrap/js/src/carousel'
import 'bootstrap/js/src/collapse'
// Import theme functions.
import ready from './shared/ready'
import Analytics from './shared/Analytics'
import Forms from './shared/Forms'
// Styles.
import './style.scss'

// Call functions when dom is ready.
ready(() => {
  Analytics().init()
  Forms().init()
})
