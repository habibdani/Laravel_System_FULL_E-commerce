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
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Tambah Produk</span>
                </div>

                <div class="flex space-x-2">
                    <button id="unsave_button" class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</button>
                    <button id="save_button" class="bg-red-600 text-white px-4 py-2 rounded">+ Tambah Produk</button>
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
                                <input id="product_name" type="text" class="px-3 py-2 border-[1px] border-[#DADCE0] mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk ini">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Product Kategori</label>
                                <select id="dropdownproduct-category"
                                        class="block w-full rounded-lg border-[1px] border-[#DADCE0] border-gray-300 bg-white px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                                    <!-- Kategori akan diisi secara dinamis melalui JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- klick add_variant_button Tambahkan Variant di dalam sini-->
                    <div id="product-variant-list-container" class="space-y-2 mb-4">

                        <div class="product_varaint bg-white shadow rounded-lg p-4"> {{--div pertma default--}}
                            <h2 class="font-bold text-gray-700 text-lg mb-4">Tambahkan Variant 1</h2>
                            <div class="space-y-4">
                                <div id="item_variant_list_container_1" class="mb-4">
                                    <!-- Tempat varian yang disimpan sementara akan muncul -->
                                </div>
                                <div class="product_variant_item_1 flex items-center space-x-2">
                                    <select id="variant_item_type_1"
                                            class="block w-1/4 rounded-lg border-gray-300 bg-white border-[1px] border-[#DADCE0] px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                                        <!-- Opsi akan diisi secara dinamis menggunakan JavaScript -->
                                    </select>
                                    <input type="text" id="variant_item_name_1" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                                    <input type="number" id="variant_item_add_price_1" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add Price" value="0" min="0">
                                    <button id="add_variant_item_1" value="1" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">+ Tambah Item</button>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                                    <input type="text" id="product_variant_name_1" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ketik nama varian">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Base Price <span class="text-gray-500">(contoh: 10000)</span></label>
                                    <input type="number" id="price_1" value="0" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Stok <span class="text-gray-500">(contoh: 1000)</span></label>
                                    <input type="number" id="stock_1" value="100" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                    <div id="image_preview_1" class="border-2 image_url border-dashed border-gray-300 rounded-lg p-4 text-center">
                                        <span class="text-gray-500">Unggah file atau geser file ke sini</span>
                                        <input type="file" id="image_input_1" class="hidden" accept="image/*">
                                    </div>
                                    <div id="uploaded_image_container_1" class="hidden mt-2 flex items-center justify-between bg-gray-100 rounded-lg p-2">
                                        <span id="uploaded_image_name_1" class="text-gray-700"></span>
                                        <button id="remove_image_button_1" class="bg-red-600 text-white px-2 py-1 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Descripsi</label>
                                    <input type="text" id="product_variant_description_1" class="border-[1px] border-[#DADCE0] price px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Descripsi varian">
                                </div>
                                <div class="flex items-center">
                                    <label class="po_status block text-sm font-medium text-gray-700 mr-4">Pre Order</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="preorder_toggle_1" class="sr-only peer" value="0">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:bg-red-600"></div>
                                        <div class="absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-full"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{-- add new div disni --}}
                    </div>

                    <!-- Bottom Buttons -->
                    <div class="flex justify-end space-x-2">
                        <button id="delete_variant_button" class="delete_varaint bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</button>
                        <button id="add_variant_button" class="tambah_variant bg-red-600 text-white px-4 py-2 rounded">+ Tambah Variant</button>
                    </div>
                </div>

                <!-- Right Section: Type and Variant -->
                <div class="space-y-6">
                    <!-- Type -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Type</h2>

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

    @vite('resources/js/addproduct-script.js')
@endsection
