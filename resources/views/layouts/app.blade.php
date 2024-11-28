<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Andal Prima Adhitama Perkasa')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/icons/andal.svg') }}" type="image/png">
    @vite('https://andalprima.hansmade.online/css/app.css')
    @stack('head')

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.0.6"></script>
</head>
<body>
    <main>
        @yield('content')
        @component('components.loading') @endcomponent
    </main>
    @vite('https://andalprima.hansmade.online/js/app.js')
    @stack('scripts')
</body>
</html>
