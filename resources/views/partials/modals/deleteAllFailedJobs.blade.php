<div class="modal fade" tabindex="-1" id="deleteAllFailedJobsModal">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="post">
      @csrf
      @method('delete')

      <div class="modal-header">
        <h5 class="modal-title">Eliminare tutti i job falliti?</h5>
      </div>
      <div class="modal-body">
        <p>Sei sicuro di voler eliminare TUTTI i job falliti? L'operazione sarà <strong>irreversibile</strong>!</p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-danger">
          Si, elimina tutto
        </button>
      </div>
    </form>
  </div>
</div>
