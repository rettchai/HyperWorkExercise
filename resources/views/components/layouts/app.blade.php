<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    @if (empty($title))
        <title>Apps</title>
    @else
        <title>{{ $title }}</title>
    @endif

    <link rel="icon" type="image/x-icon" href="https://sync.rmutr.ac.th/favicon.ico">

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    @wireUiScripts
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

    {{-- <script src="https://cdn.jsdelivr.net/npm/@preline/preline@1.0.0/dist/hs-ui.bundle.min.js"></script> --}}

    {{-- <script src="https://unpkg.com/alpinejs@3.12.3/dist/cdn.min.js" defer></script> --}}
    {{-- @wireUiScripts --}}


</head>

<body>

    @include('layouts.navbar')

    @include('layouts.aside')

    {{-- @include('layouts.body') --}}

    <div class="p-4  sm:ml-64">
        <div class="p-4 border-2 bg-gray-100 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            {{ $slot }}
        </div>
        {{-- @include('layouts.footer') --}}
    </div>



    @livewireScripts


</body>

</html>
