@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent
        {{-- <x-sidebar-dashboard /> --}}

        <!-- Main Dashboard Content -->
        <div class="flex-1 p-4 ">
            <a href="#" class="flex items-center px-3 py-2 rounded">
                <img src="{{ asset('storage/icons/diagram-black.svg') }}" alt="diagram" class="h-5 w-5 mr-2">
                <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Dashboard</span>
            </a>
            <!-- Adjusted Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3">
                <!-- Weekly Sales and Total Order (1/4 width) -->
                <div class="lg:col-span-1 space-y-3">
                    <x-weekly-sales />
                    <x-total-order />
                </div>

                <!-- Total Sales and Top Products (3/4 width) -->
                <div class="lg:col-span-3 space-y-3">
                    <x-total-sales-chart />
                    <x-top-products-chart />
                </div>
            </div>
        </div>
    </div>

@endsection
