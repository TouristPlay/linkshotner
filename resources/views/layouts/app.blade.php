<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="icon" href="{{ url('img/logo2-white.png') }}">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  @livewireStyles

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('jqvmap/dist/jquery.vmap.js')  }}"></script>
    <script src="{{ asset('jqvmap/dist/maps/jquery.vmap.world.js')  }}"></script>
    <link href="{{ asset('jqvmap/dist/jqvmap.css')  }}" media="screen" rel="stylesheet" type="text/css">

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jqvmap.min.css"></script>--}}
{{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqvmap/1.5.1/jquery.vmap.min.js"></script>--}}

    <script src="https://cdn.plot.ly/plotly-2.20.0.min.js" charset="utf-8"></script>

</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    @livewire('navigation-dropdown')

    <!-- Page Heading -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>
  </div>

  @stack('modals')
  @include('sweetalert::alert')
  @livewireScripts
  @yield('customScript')
  <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>
