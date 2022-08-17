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
              <strong>ID</strong>: {{$job["_id"]}}
            </div>
            <div class="col">
              <strong>Nome</strong>: {{$job["name"]}}
            </div>
          </div>

          <div class="row">
            <div class="col">
              <strong>Data prossima esecuzione</strong>: {{$job["nextRunAt"]}}
            </div>
            <div class="col">
              <strong>Data fallimento</strong>: {{$job["failedAt"]}}
            </div>
          </div>

          <div class="row">
            <div class="col">
              <strong>Data ultima esecuzione</strong>: {{$job["lastRunAt"]}}
            </div>
            <div class="col">
              <strong>Data completamento</strong>: {{$job["lastFinishedAt"]}}
            </div>
          </div>

          @if($job["failedAt"])
            <fieldset class="mt-3">
              <legend>Fail Reason</legend>
              <pre><code
                    class="language-json">{{$job["failReason"]}}</code></pre>
            </fieldset>
          @endif

          <fieldset class="mt-3">
            <legend>Result</legend>
            <pre><code
                  class="language-json">{{json_encode($job["result"], JSON_PRETTY_PRINT)}}</code></pre>
          </fieldset>

          <fieldset class="mt-3">
            <legend>Payload</legend>
            <pre><code
                  class="language-json">{{json_encode($job["data"], JSON_PRETTY_PRINT)}}</code></pre>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
@endsection
