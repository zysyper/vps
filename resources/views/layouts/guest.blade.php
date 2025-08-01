<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Lestari Adv' }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-slate-200 dark:bg-slate-700">
    @include('pages.nontifikasi.notif')

    @yield('content')

    @livewireScripts
</body>

</html>
