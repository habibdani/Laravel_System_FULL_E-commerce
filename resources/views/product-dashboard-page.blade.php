@extends('layouts.app')

@section('title', 'Andal Prima')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Dashboard Content -->
        <div class="flex-1 p-4">
            <!-- Product Header -->
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <img src="{{ asset('storage/icons/Keranjang-black.svg') }}" alt="Product" class="h-5 w-5 mr-2">
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Product</span>
                </div>
                <a href="{{ route('dashboard.product.add') }}" class="bg-red-600 text-white px-4 py-2 rounded">+ Tambah Produk</a>
            </div>

            <!-- Product Filter Options -->
            <div class="flex justify-between items-center mt-4">
                <span>Menampilkan 1-24 dari 205 produk</span>
                <div class="flex space-x-4">
                    <select class="border rounded p-2">
                        <option>Best Match</option>
                        <option>Price Low to High</option>
                        <option>Price High to Low</option>
                    </select>
                    <input type="text" placeholder="Cari produk" class="border rounded p-2 w-64">
                </div>
            </div>

            <!-- Product List Container (to be filled by JS) -->
            <div id="dashboard-product-list" class="mt-4 space-y-4">
                <!-- Product list will be rendered here by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Include your JS -->
    @vite('resources/js/productDashboard-script.js')
@endsection
