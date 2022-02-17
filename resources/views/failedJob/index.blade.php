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
          <div class="card-header">{{ __('Job falliti') }}</div>

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
                <th scope="col">UUID</th>
                <th scope="col">Queue</th>
                <th scope="col">Job</th>
                <th scope="col" class="text-center">Data fallimento</th>
                <th class="text-center"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($jobs as $job)
                @php
                  $payload = new \App\Classes\JobPayload($job->payload);
                @endphp

                <tr>
                  <td scope="row">{{ $payload->uuid }}</td>
                  <td scope="row">{{ $job->queue }} <br> {{ $job->connection  }}</td>
                  <td scope="row">{{ $payload->displayName }}</td>
                  <td scope="row" class="text-center">{{ $job->failed_at }}</td>
                  <td scope="row" class="text-center">
                    <button class="btn btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#payloadModal"
                            title="Mostra payload">
                      <i class="fas fa-eye"></i>
                      <template>
                        <h4>Exception</h4>
                        <pre style="max-height: 200px"><code class="language-php">{{$job->exception}}</code></pre>

                        <h4 class="mt-4">Payload</h4>
                        <pre><code class="language-json">{{$payload->toJson()}}</code></pre>
                      </template>
                    </button>

                    <button class="btn btn-info" title="Riprova"
                            data-bs-toggle="modal"
                            data-bs-target="#retryModal"
                            data-bs-id="{{$job->id}}"><i class="fas fa-retweet"></i></button>
                    <button class="btn btn-danger" title="Elimina"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-bs-id="{{$job->id}}"><i class="fas fa-trash"></i></button>
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
  @include("partials.modals.retry", [
    "action"=>route('failedJob.retry', "_id")
  ])
  @include("partials.modals.delete", [
    "action"=>route('failedJob.destroy', "_id")
  ])
@endsection
