<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    @hasSection("title")
      @yield("title") |
    @endif
    Global Queues</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  @yield("header_scripts")
</head>

<body>
<div id="app">
  <main class="">
    {{-- sidebar --}}
    <div class="d-flex h-100">
      @auth
        <x-the-sidebar></x-the-sidebar>
{{--        @include('partials.sidebar')--}}
      @endauth

      <div class="flex-fill d-flex flex-column mw-100 overflow-hidden">
        @auth
          @include('partials.navbar')
        @endauth

        <div class="py-4 flex-fill"
             style="oveflow-y:auto; overflow-x: hidden">

          @if(session()->has('error'))
            <div class="alert alert-danger mx-3">
              {{ session()->get('error') }}
            </div>
          @endif

          @if(session()->has('success'))
            <div class="alert alert-success mx-3">
              {{ session()->get('success') }}
            </div>
          @endif

          @yield('content')
        </div>
      </div>
    </div>
  </main>
</div>
</body>

</html>
