/**
 * Form factory function.
 * @return {Object} Factory function.
 */
function Forms () {
  const $formContainer = $('.o__form')
  /**
   * Init function.
   */
  function init () {
    $formContainer.submit(handleSubmitForm)
  }

  /**
   * Valide form before submit.
   * @param {Object} e Jquery event.
   */
  function handleSubmitForm (e) {
    e.preventDefault()
    e.stopPropagation()
    const $form = $(this)
    if ($form[0].checkValidity() === false) {
      $form.addClass('was-validated')
      return
    }
    $form.removeClass('was-validated')
    // @todo: Serialize form content - $formContainer.serializeArray();
  }

  return Object.freeze({
    init: init
  })
}

export default Forms
