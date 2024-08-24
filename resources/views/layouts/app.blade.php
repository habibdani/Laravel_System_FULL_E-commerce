{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel Project')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @yield('header')

    <div class="content">
        @yield('content')
    </div>

    @include('layouts.footer')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html> --}}

{{-- ============================================================================================ --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Andal Prima')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <!-- Add your header content here -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-red-600 text-white py-4">
        <div class="container mx-auto">
            <div class="flex justify-between">
                <div>
                    <p>© 2022-2024 PT. Andal Prima Adhitama Perkasa. All rights reserved.</p>
                    <p>Jl. Jombang Raya No.26, Pd. Aren, Kec.Pd. Aren, Kota Tangerang Selatan, Banten 15224</p>
                </div>
                <div>
                    <p>Monday – Saturday</p>
                    <p>07:30 – 16:30</p>
                    <p>Email: team@andalprima.co.id</p>
                    <p>Phone: +62 878 8211 2000</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
 --}}

 {{-- ============================================================================= --}}

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>@yield('title', 'Andal Prima')</title>
     @vite('resources/css/app.css')
     {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
 </head>
 <body>
     @component('components.header') @endcomponent

     <main>
         @yield('content')
     </main>

     @component('components.footer') @endcomponent
 </body>
 </html>

