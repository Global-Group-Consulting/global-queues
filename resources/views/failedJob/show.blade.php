@extends("layouts.app")

@section("header_scripts")
  <link href="{{ asset('css/prism.css')  }}" rel="stylesheet"/>
  <script src="{{ asset("js/prism.js") }}"></script>
@endsection

@section("content")
  <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-xl-10">
      <div class="card ">
        <div class="card-header">{{ __('Modifica Job') }}</div>

        <div class="card-body">
          <div class="row">
            <div class="col">
              <strong>Uid</strong>: {{$job["uid"]}}
            </div>
            <div class="col">
              <strong>Nome</strong>: {{$job["name"]}}
            </div>
          </div>

          <div class="row">
            <div class="col">
              <strong>Queue</strong>: {{$job["queue"]}}
            </div>
            <div class="col">
              <strong>Data</strong>: {{$job["created_at"]->format("d/m/Y H:i:s")}}
            </div>
          </div>

          <fieldset class="mt-3">
            <legend>Payload</legend>
            <pre><code
                  class="language-json">{{json_encode(json_decode($job["payload"]), JSON_PRETTY_PRINT)}}</code></pre>
          </fieldset>

          <fieldset class="mt-3">
            <legend>Result</legend>
            <pre><code
                  class="language-json">{{json_encode(json_decode($job["result"]), JSON_PRETTY_PRINT)}}</code></pre>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
@endsection
