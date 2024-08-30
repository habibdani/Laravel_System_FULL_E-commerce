@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header') @endcomponent
    @component('components.sidebar') @endcomponent
    @component('components.why-choose-us') @endcomponent
    @component('components.consultation') @endcomponent
    @component('components.partners') @endcomponent
    @component('components.footer') @endcomponent

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
@endsection


