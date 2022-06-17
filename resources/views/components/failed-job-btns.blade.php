<div class="btn-group" v-pre>
  <button type="button" class="btn btn-warning"
          data-bs-toggle="modal"
          data-bs-target="#payloadModal"
          title="Mostra payload" >
    <i class="fas fa-eye"></i>
    <div class="d-none template" >
      <h4>Exception</h4>
      <pre style="max-height: 200px"><code class="language-php">{{$job->exception}}</code></pre>

      <h4 class="mt-4">Payload</h4>
      <pre><code class="language-json">{{$payload->toJson()}}</code></pre>
    </div>
  </button>

  <button type="button" class="btn btn-outline-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
          aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>

  <ul class="dropdown-menu">
    <li><a class="dropdown-item text-info" href="#"
           data-bs-toggle="modal"
           data-bs-target="#retryModal"
           data-bs-id="{{$job->id}}">
        <i class="fas fa-retweet me-3" style="width: 18px"></i>Riprova
      </a></li>
    <li><a class="dropdown-item text-danger" href="#"
           data-bs-toggle="modal"
           data-bs-target="#deleteModal"
           data-bs-id="{{$job->id}}">
        <i class="fas fa-trash me-3" style="width: 18px"></i>Elimina
      </a></li>
  </ul>
</div>
