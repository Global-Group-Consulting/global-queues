window.addEventListener("DOMContentLoaded", function () {
  const deleteModal = document.getElementById("deleteModal");
  const executeJobModal = document.getElementById("executeJobModal");
  const retryModal = document.getElementById("retryModal");
  const payloadModal = document.getElementById("payloadModal");
  
  const formModals = []
  deleteModal && (formModals.push(deleteModal));
  retryModal && (formModals.push(retryModal));
  executeJobModal && (formModals.push(executeJobModal));
  
  formModals.forEach((modal) => {
    modal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      const button = event.relatedTarget
      
      // Extract info from data-bs-* attributes
      const id = button.dataset.bsId
      const form = this.querySelector('form')
      
      if (!form.originalAction) {
        form.originalAction = form.action
      }
      
      form.action = form.originalAction.replace("_id", id)
    })
  })
  
  
  if (payloadModal) {
    payloadModal.addEventListener('show.bs.modal', function (event) {
      // Button that triggered the modal
      const button = event.relatedTarget
      const templateTag = button.querySelector(".template");
      const modalContent = event.currentTarget.querySelector(".modal-body")
      
      modalContent.innerHTML = "";
      
      if (!templateTag) {
        return;
      }
      
      modalContent.innerHTML = templateTag.innerHTML;
      
      Prism.highlightAllUnder(modalContent);
    })
  }
})
