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
                  <td scope="row">
                    <x-job-queue-badge :job="$job"/>

                    <br> {{ $job->connection  }}</td>
                  <td scope="row">{{ last(explode("\\", $payload->displayName)) }}</td>
                  <td scope="row" class="text-center">{{ $job->failed_at }}</td>
                  <td scope="row" class="text-center text-nowrap">
                    @include('components.failed-job-btns', ['job' => $job, 'payload' => $payload])
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
