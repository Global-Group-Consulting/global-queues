<div class="card mb-4">
  <div class="card-header">
    Filtri
  </div>

  <div class="card-body">
    <form action="{{ route($routeName) }}" method="GET">
      <input type="hidden" name="page" value="{{$query->get('page')}}">

      <div class="row">
        <div class="col-6">
          <x-form-controls.form-select name="filters[queue]" label="Coda del job"
                                       :value="$filters->get('queue')"
                                       :options="$availableQueues"></x-form-controls>
        </div>
        <div class="col-6">
          <x-form-controls.form-select name="filters[name]" label="Job eseguito"
                                      :value="$filters->get('name')"
                                      :options="$availableJobs"></x-form-controls>
        </div>
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary" type="reset">Annulla</button>
        <button class="btn btn-primary" type="submit">Cerca</button>
      </div>
    </form>
  </div>
</div>
