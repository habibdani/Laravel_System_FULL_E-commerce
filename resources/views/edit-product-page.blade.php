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
                    <button id="save_button" class="bg-red-600 text-white px-4 py-2 rounded">+ Simpan Perubahan</button>
                </div>
            </div>

            <!-- Main Form Section -->
            <div id="mainedit" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Basic Info Section and Variant Details will be populated dynamically -->
            </div>
            <div id="variant_items_container" class="lg:col-span-1 space-y-6 mt-4">
                <!-- Variant Items will be populated dynamically -->
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
                const productVariantId = pathSegments[pathSegments.length - 1];
                console.log("Extracted productVariantId:", productVariantId);

                // Validasi ID sebelum melanjutkan
                if (isNaN(productVariantId)) {
                    console.error('Invalid productVariantId in URL');
                    return;
                }

                // Fetch data dari API
                console.log("Fetching product details...");
                const response = await fetch(`https://andalprima.hansmade.online/api/product/details?id=${productVariantId}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                console.log("API Response Status:", response.status);

                // Periksa apakah respons berhasil
                if (!response.ok) {
                    console.error(`Failed to fetch product details. Status: ${response.status}`);
                    return;
                }

                const result = await response.json();
                console.log("API Response Data:", result);

                if (result.success) {
                    const data = result.data.original;

                    // Temukan elemen target
                    const mainEditContainer = document.getElementById('mainedit');
                    const variantItemsContainer = document.getElementById('variant_items_container');
                    if (!mainEditContainer || !variantItemsContainer) {
                        console.error('Containers not found');
                        return;
                    }

                    console.log("Populating product details...");

                    // Bersihkan kontainer sebelum menambahkan HTML baru
                    mainEditContainer.innerHTML = '';
                    variantItemsContainer.innerHTML = '';

                    // Generate HTML untuk informasi dasar produk
                    const basicInfoHTML = `
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white shadow rounded-lg p-4">
                                <h2 class="font-bold text-gray-700 text-lg mb-4">Basic Information</h2>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                        <input type="text" id="product_variant_name" value="${data.product.full_name_product}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Base Price</label>
                                        <input type="number" id="price" value="${data.product.price}" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Stock</label>
                                        <input type="number" id="stock" value="${data.product.stock}" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                        <td>
                                            <input
                                                type="file"
                                                class="form-control"
                                                onchange="uploadImage(event, 'editImagePreview')"
                                            />
                                            <img
                                                src="https://andalprima.hansmade.online/storage/${data.product.variant_image}"
                                                id="editImagePreview"
                                                class="h-32 w-32 object-cover rounded-lg mt-2"
                                                alt="Preview Image"
                                            />
                                        </td>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea id="product_variant_description" class="border-[1px] h-[100px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">${data.product.descriptions.replace(/<br>/g, '\n')}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    mainEditContainer.insertAdjacentHTML('beforeend', basicInfoHTML);

                    console.log("Basic Information section populated.");

                    // Generate HTML untuk variant items
                    data.variant_types.forEach((variantType) => {
                        console.log("Processing variant type:", variantType);

                        variantType.items.forEach((item) => {
                            const variantItemHTML = `
                                <div class="variant-item flex space-x-2 mb-4">
                                    <input type="hidden" class="variant-item-id" value="${item.variant_item_id}">
                                    <input type="text" class="variant-item-name border-[1px] border-[#DADCE0] px-3 py-2 w-1/2 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Variant Item Name" value="${item.variant_item_name}">
                                    <input type="number" class="variant-item-price border-[1px] border-[#DADCE0] px-3 py-2 w-1/4 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Price Variant" value="${item.add_price}">
                                </div>
                            `;
                            variantItemsContainer.insertAdjacentHTML('beforeend', variantItemHTML);
                        });
                    });

                    console.log("Variant Items section populated.");
                } else {
                    console.error('Failed to retrieve product details:', result.message || 'Unknown error');
                }
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
                const response = await fetch('https://andalprima.hansmade.online/api/upload-image', {
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

                const response = await fetch(`https://andalprima.hansmade.online/api/update-product/${productVariantId}`, {
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
@endsection
