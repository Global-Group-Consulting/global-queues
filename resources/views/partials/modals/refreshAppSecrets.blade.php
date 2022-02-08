<div class="modal fade" tabindex="-1" id="refreshAppSecrets">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="post">
      @csrf
      @method('PATCH')

      <div class="modal-header">
        <h5 class="modal-title">Rigenerare i codici?</h5>
      </div>
      <div class="modal-body">
        <p>Sei sicuro di rigenerare i codici publici e privati? L'operazione comporterà il malfunzionamento delle app che usano già i codici esistenti e pertanto dovranno essere aggiornate per usare i nuovi codici!</p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-danger">
          Si, rigenera
        </button>
      </div>
    </form>
  </div>
</div>
