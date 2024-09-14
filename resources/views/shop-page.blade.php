<!-- resources\views\shop-page.blade.php -->

@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.banner')@endcomponent
    @component('components.productExplore')@endcomponent
    @component('components.productSpecial')@endcomponent
    @component('components.product3')@endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent

    @vite('resources/js/shop-script.js')

    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }
    </style>
@endsection
