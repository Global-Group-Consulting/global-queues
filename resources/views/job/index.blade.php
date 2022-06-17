@extends('layouts.app')

@section("header_scripts")
  <link href="{{ asset('css/prism.css')  }}" rel="stylesheet"/>
  <script src="{{ asset("js/prism.js") }}"></script>
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header">{{ __('Job in coda') }}</div>

          <div class="card-body">

            {{-- Data Table --}}
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
              @foreach($jobs as $job)
                @php
                  $payload = new \App\Classes\JobPayload($job->payload);
                @endphp

                <tr>
                  <td scope="row">{{ $payload->uuid }}</td>
                  <td scope="row"><x-job-queue-badge :job="$job"/></td>
                  <td scope="row">{{ $payload->displayName }}</td>
                  <td scope="row" class="text-center">{{ $job->attempts }}</td>
                  <td scope="row" class="text-center">{{ date("d/m/Y H:i:s",$job->available_at) }}</td>
                  <td scope="row" class="text-center">
                    <button class="btn btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#payloadModal">
                      <i class="fas fa-eye"></i>
                      <template>
                        <pre><code class="language-json">{{$payload->toJson()}}</code></pre>
                      </template>
                    </button>
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

  @include("partials.modals.payload", [])
@endsection
