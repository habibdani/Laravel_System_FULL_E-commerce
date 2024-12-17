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
                    <img src="{{ asset('storage/icons/keranjang-black.svg') }}" alt="Edit Produk" class="h-5 w-5 mr-2">
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Edit Produk</span>
                </div>

                <div class="flex space-x-2">
                    <button id="unsave_button" class="bg-white text-red-600 border border-red-600 px-4 py-2 rounded">Batal</button>
                    <button id="save_button" class="bg-red-600 text-white px-4 py-2 rounded">Simpan Perubahan Produk</button>
                </div>
            </div>

            <!-- Main Form Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Section: Basic Information and Variant Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Product</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input id="product_name" type="text" class="px-3 py-2 border-[1px] border-[#DADCE0] mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk ini">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Product Category</label>
                                <select id="dropdownproduct-category"
                                        class="block w-full rounded-lg border-[1px] border-[#DADCE0] border-gray-300 bg-white px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                                    <!-- Kategori akan diisi secara dinamis melalui JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- klick add_variant_button Tambahkan Variant di dalam sini-->
                    <div id="product-variant-list-container" class="space-y-2 mb-4">

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
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Update new Product Category</h2>
                        
                        <!-- Form untuk menambahkan kategori produk -->
                        <form id="addCategoryForm">
                            <div class="mb-4">
                                <label for="type_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input type="text" id="type_name" name="type_name" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter category name" required>
                            </div>
                            
                            <div class="mb-4">
                                <button type="submit" class="bg-[#E01535] text-white px-4 py-2 rounded-md">Update Category</button>
                            </div>
                        </form>
                        
                        <!-- Loading Spinner (optional) -->
                        <div id="loadingSpinner2" class="hidden text-center">
                            <span class="text-gray-500">Loading...</span>
                        </div>
                        
                        <!-- Success/Error Message -->
                        <div id="responseMessage" class="mt-4 text-center"></div>
                    </div>

                    <!-- Variant -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="w-full max-w-sm">
                            <h2 class="font-bold text-gray-700 text-lg mb-4">Update Variant Type Item</h2>
                            
                            <!-- Form untuk menambahkan tipe varian item -->
                            <form id="addVariantTypeForm">
                                <div class="mb-4">
                                    <label for="variant_type_name" class="block text-sm font-medium text-gray-700">Variant Type Name</label>
                                    <input type="text" id="variant_type_name" name="variant_type_name" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter variant type name" required>
                                </div>
                                
                                <div class="mb-4">
                                    <button type="submit" class="bg-[#E01535] text-white px-4 py-2 rounded-md">Update Variant Type</button>
                                </div>
                            </form>
                            
                            <!-- Loading Spinner (optional) -->
                            <div id="loadingSpinner3" class="hidden text-center">
                                <span class="text-gray-500">Loading...</span>
                            </div>
                            
                            <!-- Success/Error Message -->
                            <div id="responseMessage3" class="mt-4 text-center"></div>
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            try {
                console.log("Script loaded successfully!");

                // Ambil ID produk dari URL
                const urlParams = new URL(window.location.href);
                const pathSegments = urlParams.pathname.split('/');
                const productId = pathSegments[pathSegments.length - 1];
                console.log("Extracted productId:", productId);

                if (isNaN(productId)) {
                    console.error('Invalid productId in URL');
                    return;
                }

                // Fungsi untuk mendapatkan data dari API
                async function fetchProductDetails(productId) {
                    try {
                        console.log("Fetching product details...");
                        const response = await fetch(`http://127.0.0.1:8001/api/product/true/details?id=${productId}`, {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                            },
                        });

                        const result = await response.json();

                        if (result.success) {

                            const productCategory = result.data.original.product_type;
                            const dropdownCategory = document.getElementById('dropdownproduct-category');
                            if (dropdownCategory) {
                                try {
                                    const categoryResponse = await fetch('/api/list-product-type', {
                                        method: 'GET',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                        },
                                    });

                                    const categoryData = await categoryResponse.json();

                                    if (categoryResponse.ok && categoryData.success) {
                                        const categories = categoryData.data.original; 

                                        dropdownCategory.innerHTML = '';

                                        dropdownCategory.innerHTML += `<option value="">Select a category</option>`;

                                        categories.forEach(category => {
                                            const option = document.createElement('option');
                                            option.value = category.id;
                                            option.textContent = category.name;

                                            if (category.id === productCategory) {
                                                option.selected = true;
                                            }

                                            dropdownCategory.appendChild(option);
                                        });
                                    } else {
                                        console.error('Failed to fetch categories:', categoryData.message);
                                        alert('Failed to fetch categories');
                                    }
                                } catch (error) {
                                    console.error('Error fetching categories:', error);
                                    alert('An error occurred while fetching categories.');
                                }
                            }

                            return result.data.original;

                        } else {
                            console.error('Failed to fetch product details:', result.message);
                            return null;
                        }
                    } catch (error) {
                        console.error('Error fetching product details:', error);
                        return null;
                    }
                }

                // Fungsi untuk merender elemen produk
                function renderProductVariants(productVariantListContainer, productVariants) {
                    productVariants.forEach((variant, index) => {
                        const increment = index + 1; // Penomoran varian

                        const variantDiv = document.createElement('div');
                        variantDiv.className = 'product_variant bg-white shadow rounded-lg p-4';

                        const variantTitle = `<h2 class="font-bold text-gray-700 text-lg mb-4">Product Variant ${increment}</h2>`;
                        variantDiv.innerHTML += variantTitle;

                        const variantDetails = `
                            <div class="space-y-4">
                                <div id="item_variant_list_container_${increment}" class="mb-4"></div>
                                <div class="product_variant_item_${increment} flex items-center space-x-2">
                                    <select id="variant_item_type_${increment}" class="block w-1/4 rounded-lg border-gray-300 bg-white border-[1px] border-[#DADCE0] px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                                        <!-- Options menyusul dari script dropdown -->
                                    </select>
                                    <input type="text" id="variant_item_name_${increment}" value="${variant.variant_item_details?.[0]?.items?.[0]?.variant_item_name || ''}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                                    <input type="number" id="variant_item_add_price_${increment}" value="${variant.variant_item_details?.[0]?.items?.[0]?.add_price || 0}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add Price" min="0">
                                    <button id="add_variant_item_${increment}" value="${variant.variant_item_details?.[0]?.items?.[0]?.variant_item_id || ''}" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">+ Tambah Item</button>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                                    <input type="text" id="product_variant_name_${increment}" value="${variant.full_name_product}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ketik nama varian">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Base Price <span class="text-gray-500">(contoh: 10000)</span></label>
                                    <input type="number" id="price_${increment}" value="${variant.price || 0}" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Stok <span class="text-gray-500">(contoh: 1000)</span></label>
                                    <input type="number" id="stock_${increment}" value="${variant.stock || 0}" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="1000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                    <div id="image_preview_${increment}" class="border-2 image_url border-dashed border-gray-300 rounded-lg p-4 text-center">
                                        <span class="text-gray-500">Unggah file atau geser file ke sini</span>
                                        <input type="file" id="image_input_${increment}" class="hidden" accept="image/*">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Descripsi</label>
                                    <input type="text" id="product_variant_description_${increment}" value="${variant.descriptions || ''}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Descripsi varian">
                                </div>
                            </div>
                        `;

                        variantDiv.innerHTML += variantDetails;
                        productVariantListContainer.appendChild(variantDiv);
                    });
                }

                // Eksekusi utama
                (async function () {
                    const productDetails = await fetchProductDetails(productId);

                    if (productDetails) {
                        const productNameInput = document.getElementById('product_name');
                        productNameInput.value = productDetails.product_name;

                        const productVariantListContainer = document.getElementById('product-variant-list-container');
                        renderProductVariants(productVariantListContainer, productDetails.product_variant);
                    } else {
                        console.error('No product details available.');
                    }
                })();

                
                    
            } catch (error) {
                console.error('An error occurred:', error.message);
            }

        });

        async function uploadImage(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = '/login';
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch('http://127.0.0.1:8001/api/upload-image', {
                    method: 'POST',
                    headers: { Authorization: `Bearer ${token}` }, // Tambahkan Bearer Token
                    body: formData,
                });

                const data = await response.json();
                if (data.success) {
                    // Update src atribut untuk pratinjau gambar
                    const preview = document.getElementById(previewId);
                    preview.src = data.data.image_url; // Pastikan field ini sesuai dengan respons API
                    preview.classList.remove('hidden'); // Tampilkan jika sebelumnya tersembunyi
                    alert('Gambar berhasil diunggah!');
                } else {
                    alert(data.message || 'Failed to upload image');
                }
            } catch (error) {
                console.error('Error uploading image:', error);
                alert('Terjadi kesalahan saat mengupload gambar.');
            }
        }

        // Event listener untuk save_button
        document.getElementById('save_button').addEventListener('click', async function () {
            try {
                console.log("Saving product details...");

                // Ambil ID produk dari URL
                const urlParams = new URL(window.location.href);
                const pathSegments = urlParams.pathname.split('/');
                const productVariantId = pathSegments[pathSegments.length - 1];
                console.log("Product Variant ID for update:", productVariantId);

                // Ambil data dari form
                const productVariantName = document.getElementById('product_variant_name').value;
                const price = parseFloat(document.getElementById('price').value);
                const stock = parseInt(document.getElementById('stock').value);
                const image = document.getElementById('editImagePreview').src;
                const descriptions = document.getElementById('product_variant_description').value;

                // Ambil variant items dari container
                const variantItemsContainer = document.getElementById('variant_items_container');
                const variantItems = Array.from(variantItemsContainer.querySelectorAll('.variant-item')).map((item) => ({
                    id: parseInt(item.querySelector('.variant-item-id').value),
                    product_variant_item_name: item.querySelector('.variant-item-name').value,
                    price_variant: parseFloat(item.querySelector('.variant-item-price').value),
                }));

                // Buat payload
                const payload = {
                    product_variant: {
                        id: parseInt(productVariantId),
                        product_variant_name: productVariantName,
                        price: price,
                        stock: stock,
                        image_url: image,
                        po_status: false,
                        descriptions: descriptions,
                        product_variant_item: variantItems,
                    },
                };

                console.log("Payload to send:", payload);

                // Kirim data ke API
                const authToken = sessionStorage.getItem('authToken'); // Ambil token dari sessionStorage
                if (!authToken) {
                    console.error("Auth token is missing in sessionStorage");
                    alert("Autentikasi tidak valid. Silakan login kembali.");
                    return;
                }

                const response = await fetch(`http://127.0.0.1:8001/api/update-product/${productVariantId}`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${authToken}`, // Tambahkan Bearer Token di header
                    },
                    body: JSON.stringify(payload),
                });

                console.log("API Response Status:", response.status);

                if (!response.ok) {
                    console.error("Failed to update product. Response:", await response.json());
                    alert("Gagal memperbarui produk. Silakan cek konsol untuk detail.");
                    return;
                }

                const result = await response.json();
                console.log("API Response Data:", result);

                if (result.success) {
                    alert("Produk berhasil diperbarui!");
                    window.location.href = 'http://127.0.0.1:8001/dashboard/product';
                } else {
                    alert("Gagal memperbarui produk: " + (result.message || "Unknown error"));
                }
            } catch (error) {
                console.error("Error while saving product details:", error.message);
                alert("Terjadi kesalahan saat menyimpan produk.");
            }
        });
    </script>

    <!-- @vite('resources/js/addproduct-script.js') -->
@endsection
