window.addEventListener('DOMContentLoaded', function () {
  /**
   * @type {*[]}
   */
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  
  const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    // @ts-ignore
    return new window.bootstrap.Tooltip(tooltipTriggerEl)
  })
})
