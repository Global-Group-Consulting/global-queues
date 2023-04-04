@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        <ul class="nav mb-4 justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('jobList.create')}}">
              <i class="fas fa-plus"></i>
              Aggiungi</a>
          </li>
        </ul>

        <div class="card">
          <div class="card-header">{{ __('Lista Job registrati') }}</div>

          <div class="card-body">

            <div class="table-responsive">
              {{-- Data Table --}}
              <table class="table table-striped">
                <thead>
                <tr>
                  <th scope="col">Titolo</th>
                  <th scope="col">Coda</th>
                  <th scope="col">Classe</th>
                  <th scope="col">Api Call</th>
                  <th scope="col">Descrizione</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                  <tr>
                    <td scope="row">{{ $job->title }}</td>
                    <td scope="row">{{ $job->queueName }}</td>
                    <td scope="row">{{ last(explode("\\", $job->class)) }}</td>
                    <td scope="row">
                      @if ($job->apiUrl)
                        <i class="fas fa-link text-info"
                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                           data-bs-title="{{$job->apiUrl}}"></i>
                      @endif
                    </td>
                    <td scope="row">{{ $job->description }}</td>
                    <td class="text-nowrap">
                      <div class="d-flex align-items-center">
                        <a href="{{route('jobList.edit', $job->id)}}" class="btn btn-link" title="Modifica">
                          <i class="fas fa-edit"></i>
                        </a>

                        <a href="{{route('jobList.create',['clone' => $job->id])}}"
                           class="btn btn-link text-warning" title="Duplica">
                          <i class="fas fa-copy"></i>
                        </a>

                        <button class="btn btn-link text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-bs-id="{{$job->id}}"
                                title="Elimina">
                          <i class="fas fa-trash"></i>
                        </button>

                        <div class="vr"></div>

                        <button class="btn btn-link text-success"
                                data-bs-toggle="modal"
                                data-bs-target="#executeJobModal"
                                data-bs-id="{{$job->id}}"
                                title="Esegui ora">
                          <i class="fa-solid fa-bolt"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include("partials.modals.delete", [
    "action"=> route("jobList.destroy", "_id")
  ])
  @include("partials.modals.executeJob", [
    "action"=> route("jobList.execute", "_id")
  ])
@endsection
