@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        <x-filters-mongo-jobs routeName="mongoJobs.index">aa</x-filters-mongo-jobs>

        <div class="card">
          <div class="card-header">{{ __('Esito Job MongoDb') }}</div>

          <div class="card-body">

            {{-- Data Table --}}
            <table class="table table-striped">
              <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Fallimento</th>
                <th scope="col">Data completamento</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @foreach($jobs as $job)
                <tr>
                  <td>{{ $job->_id }}</td>
                  <td>{{ $job->name }}</td>
                  <td>
                    @if($job->failedAt)
                      {{ $job->failedAt->format("d/m/y H:i:s")}}
                      ({{ $job->failCount }})
                      <button type="button" class="btn btn-link"
                              data-bs-toggle="tooltip" data-bs-placement="top"
                              data-bs-custom-class="custom-tooltip"
                              data-bs-title="{{ $job->failReason }}">
                        <i class="fas fa-circle-info"></i>
                      </button>
                    @endif
                  </td>
                  <td>
                    @if($job->lastFinishedAt)
                      {{ $job->lastFinishedAt->format("d/m/y H:i:s") }}
                    @endif</td>
                  <td class="text-nowrap">
                    <a href="{{route('mongoJobs.show', $job->_id)}}" class="btn btn-link">
                      <i class="fas fa-eye"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <td colspan="99">
                  <div class="d-flex justify-content-center mt-2">
                    {{ $jobs->links()  }}
                  </div>
                </td>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include("partials.modals.delete", [
    "action"=> route("jobList.destroy", "_id")
  ])
@endsection
