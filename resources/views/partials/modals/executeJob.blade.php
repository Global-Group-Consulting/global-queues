<div class="modal fade" tabindex="-1" id="executeJobModal">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="post">
      @csrf
      @method('POST')

      <div class="modal-header">
        <h5 class="modal-title">Eseguire questo Job?</h5>
      </div>
      <div class="modal-body">
        <p>Sei sicuro di voler eseguire manualmente questo job? L'operazione sarà <strong>irreversibile</strong>!</p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-danger">
          Si, esegui
        </button>
      </div>
    </form>
  </div>
</div>
