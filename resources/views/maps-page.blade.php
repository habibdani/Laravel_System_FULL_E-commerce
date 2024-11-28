<!-- resources/views/maps-page.blade.php -->

@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-default') @endcomponent
    @component('components.sidebar',['clientTypeId' => $clientTypeId]) @endcomponent
    @component('components.maps') @endcomponent
    @component('components.chatwa')@endcomponent    

    <!-- Load jQuery -->
    <script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Load Leaflet.js for map rendering -->
    <link rel="stylesheet" href="http://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="http://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    @vite('resources/js/maps-script.js')
    <style>
        #buttom-sidebar{
            margin-bottom: 15%;
        }
    </style>
@endsection
