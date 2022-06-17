@extends('layouts.app')

@section("header_scripts")
  <link href="{{ asset('css/prism.css')  }}" rel="stylesheet"/>
  <script src="{{ asset("js/prism.js") }}"></script>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center mb-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex">
            {{ __('Job in attesa - Ultimi 5') }}
            <a class="ms-auto" href="{{route('job.index')}}">Mostra tutti</a></div>

          <div class="card-body">
            <table class="table table-striped ">
              <colgroup>
                <col style="width: 25%">
                <col style="width: 15%">
                <col style="width: 25%">
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 1%;">
              </colgroup>
              <thead>
              <tr>
                <th scope="col">Uuid</th>
                <th scope="col">Queue</th>
                <th scope="col">Job</th>
                <th scope="col" class="text-center">Tentativi</th>
                <th scope="col" class="text-center">Data creazione</th>
                <th class="text-center">Payload</th>
              </tr>
              </thead>
              <tbody>
              @foreach($pendingJobs as $job)
                @php
                  $payload = new \App\Classes\JobPayload($job->payload);
                @endphp

                <tr>
                  <td scope="row">{{ $payload->uuid }}</td>
                  <td scope="row"><x-job-queue-badge :job="$job"/></td>
                  <td scope="row">{{ last(explode("\\", $payload->displayName)) }}</td>
                  <td scope="row" class="text-center">{{ $job->attempts }}</td>
                  <td scope="row" class="text-center">{{ date("d/m/Y H:i:s",$job->available_at) }}</td>
                  <td scope="row" class="text-center">
                    <button class="btn btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#payloadModal">
                      <i class="fas fa-eye"></i>
                      <div class="d-none template">
                        <pre><code class="language-json">{{$payload->toJson()}}</code></pre>
                      </div>
                    </button>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex">
            {{ __('Job Falliti - Ultimi 5') }}
            <a class="ms-auto" href="{{route('failedJob.index')}}">Mostra tutti</a>
          </div>

          <div class="card-body">
            <table class="table table-striped ">
              <colgroup>
                <col style="width: 25%">
                <col style="width: 15%">
                <col style="width: 25%">
                <col style="width: 10%">
                <col style="width: 15%">
                <col style="width: 1%;">
              </colgroup>
              <thead>
              <tr>
                <th scope="col">UUID</th>
                <th scope="col">Queue</th>
                <th scope="col">Job</th>
                <th scope="col" class="text-center">Data fallimento</th>
                <th class="text-center"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($failedJobs as $job)
                @php
                  $payload = new \App\Classes\JobPayload($job->payload);
                @endphp

                <tr>
                  <td scope="row">{{ $payload->uuid }}</td>
                  <td scope="row"><x-job-queue-badge :job="$job"/></td>
                  <td scope="row">{{ last(explode("\\", $payload->displayName)) }}</td>
                  <td scope="row" class="text-center">{{ $job->failed_at }}</td>
                  <td scope="row" class="text-center text-nowrap">
                    @include('components.failed-job-btns', ['job' => $job, 'payload' => $payload])
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

  @include("partials.modals.payload", [])
  @include("partials.modals.retry", [
    "action"=>route('failedJob.retry', "_id")
  ])
  @include("partials.modals.delete", [
    "action"=>route('failedJob.destroy', "_id")
  ])
@endsection
