<!-- resources\views\shop-page.blade.php -->

@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.productFilterByProductId')@endcomponent
    @component('components.productFilter')@endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent
    @component('components.chatwa')@endcomponent    

    <!-- @vite('resources/js/shop-script.js') -->

    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .product-card {
            animation: fadeInScale 0.5s ease-in-out;
        }

    </style>
@endsection