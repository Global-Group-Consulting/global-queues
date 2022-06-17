@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">{{ __('Esito Job eseguiti') }}</div>

          <div class="card-body">

            {{-- Data Table --}}
            <table class="table table-striped">
              <thead>
              <tr>
                <th scope="col">UID</th>
                <th scope="col">Name</th>
                <th scope="col">Queue</th>
                <th scope="col">Data completamento</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @foreach($jobs as $job)
                <tr>
                  <td scope="row">{{ $job->uid }}</td>
                  <td scope="row">{{ last(explode("\\", $job->name)) }}</td>
                  <td scope="row"><x-job-queue-badge :job="$job"/></td>
                  <td scope="row">{{ $job->created_at->format("d/m/y H:i:s") }}</td>
                  <td class="text-nowrap">
                    <a href="{{route('jobResult.show', $job->id)}}" class="btn btn-link">
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
