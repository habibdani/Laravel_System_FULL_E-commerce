

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Andal Prima Adhitama Perkasa</title>
     <!-- Favicon -->
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
     <link rel="icon" href="{{ asset('storage/icons/andal.svg') }}" type="image/png">
     <!-- Other meta tags and links -->
     @vite('resources/css/app.css')
 </head>
 <style>
    .font-roboto {
      font-family: 'Roboto', sans-serif;
    }
    .font-poppins{
        font-family: 'Poppins', sans-serif;
    }
  </style>
 <body>
     {{-- @component('components.header') @endcomponent --}}

     <main>
         @yield('content')
     </main>

     {{-- @component('components.footer') @endcomponent --}}
 </body>
 </html>

