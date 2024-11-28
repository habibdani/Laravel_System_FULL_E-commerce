@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Dashboard Content -->
        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <img src="{{ asset('storage/icons/keranjang-black.svg') }}" alt="Tambah Produk" class="h-5 w-5 mr-2">
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Edit Produk</span>
                </div>

                <div class="flex space-x-2">
                    <button id="unsave_button" class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</button>
                    <button id="save_button" class="bg-red-600 text-white px-4 py-2 rounded">+ Seimpan Perubahan</button>
                </div>
            </div>

            <!-- Main Form Section -->
            <div id="mainedit" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
             
            </div>
        </div>
    </div>
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Penambahan Produk</h2>
            <p class="text-sm text-gray-700 mb-2">Apakah Anda yakin ingin menambahkan produk ini?</p>
            <p id="popup-save-product" class="text-2xl font-bold text-[#E01535] mb-6"></p>
            <div class="flex justify-center space-x-4">
                <button id="confirm-button" class="bg-[#E01535] text-white px-4 py-2 rounded-md">Konfirmasi</button>
                <button id="cancel-button" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md">Batal</button>
            </div>
        </div>
    </div>

    @vite('resources/js/editProduct-script.js')
@endsection
