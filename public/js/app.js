var confirmDelete = document.getElementById('confirmDelete')
confirmDelete.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-whatever')
  var id = button.getAttribute('id')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalBodyInput = confirmDelete.querySelector('.modal-body')
  var inputAnimeName = confirmDelete.querySelector('#anime_name')

  document.getElementById('confirmationForm').action = id;
  modalBodyInput.innerText = 'Desejar remover ' + recipient + '?'
  inputAnimeName.value = recipient
})