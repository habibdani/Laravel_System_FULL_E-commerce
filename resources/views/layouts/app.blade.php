<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Andal Prima Adhitama Perkasa')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/icons/andal.svg') }}" type="image/png">
    @vite('resources/css/app.css')
    @stack('head')
</head>
<body>
    <main>
        @yield('content')
    </main>
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>
