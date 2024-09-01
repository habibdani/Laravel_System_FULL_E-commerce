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

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function showSlide(slideNumber) {
                document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
                document.getElementById('slide-' + slideNumber).classList.remove('hidden');

                document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
                    btn.classList.remove('text-white', 'bg-[#E01535]');
                    btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
                });

                document.getElementById('btn-slide-' + slideNumber).classList.add('text-white', 'bg-[#E01535]');
                document.getElementById('btn-slide-' + slideNumber).classList.remove('text-[#9D9D9D]', 'bg-transparent');
            }

            window.addEventListener('load', function() {
                showSlide(2);
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.add('sidebar-hidden');
                sidebar.classList.remove('sidebar-visible');

                const toggleBtn = document.getElementById('toggle');
                toggleBtn.classList.add('toggle-hidden');
                toggleBtn.classList.remove('toggle-visible');

                const btnSlide2 = document.getElementById('btn-slide-2');
                btnSlide2.classList.add('text-white', 'bg-[#E01535]');
                btnSlide2.classList.remove('text-[#9D9D9D]', 'bg-transparent');

            });
        });
    </script>
    <style>
        #buttom-sidebar{
            margin-bottom: 25%;
        }
    </style>
@endsection


