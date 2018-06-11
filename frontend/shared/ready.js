/**
* Function that emulates the $(document).on('ready') from jQuery,
* using vanilla JS.
*
* @param {Function} callback A callback that is fired when the page is Ready.
*/
const ready = callback => {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', callback)
  } else {
    callback()
  }
}

export default ready
