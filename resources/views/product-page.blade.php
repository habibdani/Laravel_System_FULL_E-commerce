@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.productDetails')@endcomponent
    @component('components.productFilter')@endcomponent
    @component('components.productRelate')@endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent
    @component('components.chatwa')@endcomponent    

    <script>
        window.productVariantId = @json($productVariantId);
        window.productTypeId = @json($productTypeId);
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1, // Elemen terlihat 10% di viewport
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('parallax-visible');
                    }
                });
            }, observerOptions);

            // Pilih semua elemen dengan kelas 'parallax-appear'
            const parallaxElements = document.querySelectorAll('.parallax-appear');
            parallaxElements.forEach((el) => observer.observe(el));
        });
    </script>
    @vite('resources/js/product-script.js')

    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }
        .parallax-appear {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .parallax-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection
