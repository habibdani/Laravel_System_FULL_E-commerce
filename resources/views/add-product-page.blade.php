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
                    <img src="{{ asset('storage/icons/Keranjang-black.svg') }}" alt="Tambah Produk" class="h-5 w-5 mr-2">
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Tambah Produk</span>
                </div>

                <div class="flex space-x-2">
                    <a href="#" class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</a>
                    <a href="#" class="bg-red-600 text-white px-4 py-2 rounded">+ Tambah Produk</a>
                </div>
            </div>

            <!-- Main Form Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Section: Basic Information and Variant Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Basic Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk ini">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk ini">
                            </div>
                        </div>
                    </div>

                    <!-- Tambahkan Variant -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Tambahkan Variant</h2>
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <select class="block w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option>Pilih Tipe Varian</option>
                                </select>
                                <input type="text" class="block w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                                <a href="#" class="bg-red-600 text-white px-4 py-2 rounded">+ Tambah Item</a>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                                <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ketik nama varian">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Base Price <span class="text-gray-500">(contoh: 10000)</span></label>
                                <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                    <span class="text-gray-500">Unggah file atau geser file ke sini</span>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <label class="block text-sm font-medium text-gray-700 mr-4">Pre Order</label>
                                <input type="checkbox" class="h-5 w-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Buttons -->
                    <div class="flex justify-end space-x-2">
                        <a href="#" class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</a>
                        <a href="#" class="bg-red-600 text-white px-4 py-2 rounded">+ Tambah Variant</a>
                    </div>
                </div>

                <!-- Right Section: Type and Variant -->
                <div class="space-y-6">
                    <!-- Type -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Type</h2>
                        <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option>Pilih Kategori Produk</option>
                        </select>
                    </div>

                    <!-- Variant -->
                    <div class="bg-white shadow rounded-lg p-4 flex items-center justify-center">
                        <div class="text-center">
                            <img src="{{ asset('storage/icons/warning.svg') }}" alt="Warning" class="h-10 w-10 mb-2">
                            <p class="text-gray-500">Variant tidak boleh kosong</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your JS -->
    {{-- @vite('resources/js/addProductDashboard-script.js') --}}
@endsection
