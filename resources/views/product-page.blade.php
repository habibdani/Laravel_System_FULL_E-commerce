@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.productDetails')@endcomponent
    @component('components.productRelate')@endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent

    <script>
        window.productVariantId = @json($productVariantId);
        window.productTypeId = @json($productTypeId);
    </script>
    @vite('resources/js/product-script.js')

    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }
    </style>
@endsection
