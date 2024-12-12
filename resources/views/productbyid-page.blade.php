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

    <script>
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
