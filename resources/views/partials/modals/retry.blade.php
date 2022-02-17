<div class="modal fade" tabindex="-1" id="retryModal">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="post">
      @csrf
      @method('PATCH')

      <div class="modal-header">
        <h5 class="modal-title">Rimettero in coda l'elemento?</h5>
        {{--        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
      </div>
      <div class="modal-body">
        <p>Sei sicuro di voler rimettere in coda questo elemento? L'operazione sarà <strong>irreversibile</strong>!</p>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
        <button type="submit" class="btn btn-danger">
          Si, rimetti in coda
        </button>
      </div>
    </form>
  </div>
</div>
