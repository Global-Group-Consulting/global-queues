<div class="card mb-4">
  <div class="card-header">
    Filtri
  </div>

  <div class="card-body">
    <form action="{{ route($routeName) }}" method="GET">
      <input type="hidden" name="page" value="{{$query->get('page')}}">

      <div class="row">
        <div class="col-6">
          <x-form-controls.form-select name="filters[name]" label="Nome Job"
                                       :value="$filters->get('name')"
                                       :options="$availableJobs"></x-form-controls>
        </div>
        <div class="col-3">
          <label class="form-label">&nbsp;</label>
          <x-form-controls.form-checkbox name="filters[failed]" label="Ha fallito"
                                         :value="$filters->get('failed')"></x-form-controls>
        </div>
        <div class="col-3">
          <label class="form-label">&nbsp;</label>
          <x-form-controls.form-checkbox name="filters[not_failed]" label="Non ha fallito"
                                         :value="$filters->get('not_failed')"></x-form-controls>
          <label class="form-label">&nbsp;</label>
        </div>
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-outline-primary" type="reset">Annulla</button>
        <button class="btn btn-primary" type="submit">Cerca</button>
      </div>
    </form>
  </div>
</div>
