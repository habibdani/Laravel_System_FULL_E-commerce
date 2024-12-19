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
                    <button id="update_button" class="bg-red-600 text-white px-4 py-2 rounded">Simpan Perubahan Produk</button>
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
                                <input id="product_name" type="text" value="" class="px-3 py-2 border-[1px] border-[#DADCE0] mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Nama produk ini">
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
                        <button id="add_variant_button" class="tambah_variant bg-red-600 text-white px-4 py-2 rounded">+ Tambah Product Variant</button>
                    </div>
                </div>

                <!-- Right Section: Type and Variant -->
                <div class="space-y-6">
                    <!-- Type -->
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Update new Product Category</h2>
                        
                        <!-- Form untuk menambahkan kategori produk -->
                        <form id="updateCategoryForm">
                            <div class="mb-4">
                                <label for="dropdownproduct-category-update" class="block text-sm font-medium text-gray-700">Select Category</label>
                                <select id="dropdownproduct-category-update"
                                        class="block w-full rounded-lg border-[1px] border-[#DADCE0] border-gray-300 bg-white px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" 
                                        required>
                                    <!-- Categories will be dynamically populated -->
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="type_name" class="block text-sm font-medium text-gray-700">New Category Name</label>
                                <input type="text" id="type_name" name="type_name" 
                                    class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                    placeholder="Enter new category name" 
                                    required>
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
                                    <label for="dropdown_variant_item_type_update" class="block text-sm font-medium text-gray-700">Select Variant Type</label>
                                    <select id="dropdown_variant_item_type_update"
                                            class="block w-full rounded-lg border-[1px] border-[#DADCE0] border-gray-300 bg-white px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" 
                                            required>
                                        <!-- Variant types will be dynamically populated -->
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="variant_type_name" class="block text-sm font-medium text-gray-700">Variant Type Name</label>
                                    <input type="text" id="variant_type_name" name="variant_type_name" 
                                        class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                                        placeholder="Enter variant type name" 
                                        required>
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
                        const response = await fetch(`https://andalprima.hansmade.online/api/product/true/details?id=${productId}`, {
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

                
                document.getElementById('addVariantTypeForm').addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const dropdown = document.getElementById('dropdown_variant_item_type_update');
                    const variantTypeNameInput = document.getElementById('variant_type_name');

                    const selectedVariantTypeId = dropdown.value;
                    const newVariantTypeName = variantTypeNameInput.value;

                    const token = sessionStorage.getItem('authToken');
                    if (!token) {
                        alert('Token is missing, please log in again.');
                        window.location.href = 'https://andalprima.hansmade.online/login';
                        return;
                    }

                    if (!selectedVariantTypeId) {
                        alert('Please select a variant type to update.');
                        return;
                    }

                    if (!newVariantTypeName.trim()) {
                        alert('Please enter a variant type name.');
                        return;
                    }

                    try {
                        const response = await fetch(`https://andalprima.hansmade.online/api/update-item-type/${selectedVariantTypeId}`, {
                            method: 'POST', // Use appropriate method (PUT or POST) as per your API design
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': `Bearer ${token}`,
                            },
                            body: JSON.stringify({
                                name: newVariantTypeName,
                            }),
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            alert('Variant type updated successfully.');
                            // Optionally, clear the form or refresh the dropdown
                            dropdown.value = '';
                            variantTypeNameInput.value = '';
                        } else {
                            console.error('Failed to update variant type:', result.message);
                            alert('Failed to update variant type.');
                        }
                    } catch (error) {
                        console.error('Error updating variant type:', error);
                        alert('An error occurred while updating variant type.');
                    }
                });

                document.getElementById('updateCategoryForm').addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const dropdown = document.getElementById('dropdownproduct-category-update');
                    const typeNameInput = document.getElementById('type_name');

                    const selectedCategoryId = dropdown.value;
                    const newCategoryName = typeNameInput.value;

                    const token = sessionStorage.getItem('authToken');
                    if (!token) {
                        alert('Token is missing, please log in again.');
                        window.location.href = 'https://andalprima.hansmade.online/login';
                        return;
                    }

                    if (!selectedCategoryId) {
                        alert('Please select a category to update.');
                        return;
                    }

                    if (!newCategoryName.trim()) {
                        alert('Please enter a new category name.');
                        return;
                    }

                    try {
                        const response = await fetch(`https://andalprima.hansmade.online/api/update-product-type/${selectedCategoryId}`, {
                            method: 'POST', // Use appropriate method (PUT or POST) as per your API design
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'Authorization': `Bearer ${token}`,
                            },
                            body: JSON.stringify({
                                name: newCategoryName,
                            }),
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            alert('Category updated successfully.');
                            populateCategoryDropdown(); // Refresh dropdown
                        } else {
                            console.error('Failed to update category:', result.message);
                            alert('Failed to update category.');
                        }
                    } catch (error) {
                        console.error('Error updating category:', error);
                        alert('An error occurred while updating category.');
                    }
                });

                // Fungsi untuk merender elemen produk
                function renderProductVariants(productVariantListContainer, productVariants) {
                    productVariants.forEach((variant, index) => {
                        const increment = index + 1; // Penomoran varian

                        const variantDiv = document.createElement('div');
                        variantDiv.className = `iniproduct_variant_${increment} bg-white shadow rounded-lg p-4`;

                        const variantTitle = `<h2 class="font-bold text-gray-700 text-lg mb-4">Product Variant ${increment}</h2>`;
                        variantDiv.innerHTML += variantTitle;

                        let variantDetails = `
                            <div class="space-y-4">
                                <div id="item_variant_list_container_${increment}" class="mb-4">
                        `;

                        // Loop melalui `variant_item_details`
                        variant.variant_item_details.forEach((detail, detailIndex) => {
                            // Tambahkan setiap `detail` ke dalam kontainer
                            detail.items.forEach((item, itemIndex) => {
                                const uniqueIndex = `${increment}_${detailIndex}_${itemIndex}`;

                                variantDetails += `
                                    <div id="variant_item_row_${uniqueIndex}" class="product_variant_item_${increment} flex items-center space-x-2 mb-2">
                                        <select id="variant_item_type_${uniqueIndex}" class="block w-1/4 rounded-lg border-gray-300 bg-white border-[1px] border-[#DADCE0] px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                                            <option value="${detail.variant_item_type_id}">${detail.variant_item_type_name}</option>
                                        </select>
                                        <input hidden id="variant_item_id_${uniqueIndex}" value="${item.variant_item_id}">
                                        <input type="text" id="variant_item_name_${uniqueIndex}" value="${item.variant_item_name || ''}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                                        <input type="number" id="variant_item_add_price_${uniqueIndex}" value="${item.add_price || 0}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add Price" min="0">
                                        <button id="delete_variant_item_${uniqueIndex}" onclick="deleteVariantItem('${uniqueIndex}')" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">Hapus Item</button>
                                    </div>
                                `;
                            });
                        });

                        variantDetails += `
                                    <button onclick="addVariantItemRow('item_variant_list_container_${increment}', ${increment})" class="bg-green-500 text-white px-3 text-[12px] py-2 rounded">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                                    <input type="text" id="product_variant_name_${increment}" value="${variant.full_name_product}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ketik nama varian">
                                    <input hidden id="product_variant_id_${increment}" value="${variant.product_variant_id}">
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
                                    <input type="file" class="form-control" onchange="uploadImage(event, 'image_preview_${increment}')">
                                    <img src="/storage/${variant.variant_image}" id="image_preview_${increment}" class="h-32 w-32 object-cover rounded-lg mt-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Descripsi</label>
                                    <input type="text" id="product_variant_description_${increment}" value="${variant.descriptions || ''}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Descripsi varian">
                                </div>
                                 <div class="flex items-center">
                                    <label class="po_status block text-sm font-medium text-gray-700 mr-4">Pre Order</label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="preorder_toggle_${increment}" class="sr-only peer" value="0">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:bg-red-600"></div>
                                        <div class="absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-full"></div>
                                    </label>
                                </div>
                                <button id="delete_product_variant_${increment}" onclick="deleteProductVariant('${increment}')" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">Hapus Product Varaint</button>
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

        // Fungsi untuk menghapus baris item varian
        function deleteVariantItem(uniqueIndex) {
            const rowElement = document.getElementById(`variant_item_row_${uniqueIndex}`);
            if (rowElement) {
                rowElement.parentNode.removeChild(rowElement);
            }
        }

        function addVariantItemRow(containerId, variantIndex) {
            const container = document.getElementById(containerId);
            if (!container) {
                console.warn(`Container with ID ${containerId} not found.`);
                return;
            }

            const currentCount = container.childElementCount;
            const uniqueIndex = `${variantIndex}_${currentCount}`;

            const row = document.createElement('div');
            row.id = `variant_item_row_${uniqueIndex}`;
            row.className = `product_variant_item_${variantIndex} flex items-center space-x-2 mb-2`;

            row.innerHTML = `
                <select id="variant_item_type_${uniqueIndex}" class="block w-1/4 rounded-lg border-gray-300 bg-white border-[1px] border-[#DADCE0] px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                    <option value="">Loading...</option>
                </select>
                <input hidden id="variant_item_id_${uniqueIndex}" value="9999999">
                <input type="text" id="variant_item_name_${uniqueIndex}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                <input type="number" id="variant_item_add_price_${uniqueIndex}" value="0" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add Price" min="0">
                <button id="delete_variant_item_${uniqueIndex}" onclick="deleteVariantItem('${uniqueIndex}')" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">Hapus Item</button>
            `;

            container.appendChild(row);

            // Isi dropdown setelah row ditambahkan
            const dropdown = document.getElementById(`variant_item_type_${uniqueIndex}`);
            if (dropdown && variantTypes.length) {
                populateDropdown(variantTypes, dropdown);
            }
        }


        const API_BASE_URL = 'https://andalprima.hansmade.online';
        // Fungsi untuk mengupload gambar
        async function uploadImage(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = `${API_BASE_URL}/login`;
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch(`${API_BASE_URL}/api/upload-image`, {
                    method: 'POST',
                    headers: { Authorization: `Bearer ${token}` },
                    body: formData,
                });

                const data = await response.json();
                if (data.success) {
                    const preview = document.getElementById(previewId);
                    preview.src = data.data.image_url.replace('https://andalprima.hansmade.online', '').trim();
                    preview.classList.remove('hidden');
                } else {
                    alert(data.message || 'Failed to upload image');
                }
            } catch (error) {
                console.error('Error uploading image:', error);
                alert('Terjadi kesalahan saat mengupload gambar.');
            }
        }

        let variantTypes = [];

        async function fetchVariantTypes() {
            try {
                const response = await fetch('/api/list-variant-type', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    variantTypes = data.data.original; // Pastikan sesuai dengan struktur response API
                } else {
                    console.error("Gagal mendapatkan data varian tipe:", data.message);
                }
            } catch (error) {
                console.error("Error saat memanggil API:", error);
            }
        }

        // Panggil saat halaman dimuat
        fetchVariantTypes();

        function populateDropdown(variantTypes, dropdownElement) {
            if (!variantTypes || !variantTypes.length) {
                console.error("Data varian tipe kosong atau belum tersedia.");
                return;
            }

            dropdownElement.innerHTML = '<option value="">Pilih Tipe Varian</option>';
            variantTypes.forEach(variantType => {
                const option = document.createElement('option');
                option.value = variantType.id;
                option.textContent = variantType.name;
                dropdownElement.appendChild(option);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('dropdown_variant_item_type_update');
            fetchVariantTypes().then(() => populateDropdown(variantTypes, dropdown));
        });
        

        function deleteProductVariant(increment) {
            // Popup konfirmasi sebelum melanjutkan
            if (confirm("Are you sure you want to delete this product variant?")) {
                try {
                    // Asynchronous function untuk menjalankan API dan logika
                    (async () => {
                        // Ambil token dari sessionStorage
                        const token = sessionStorage.getItem('authToken');

                        if (!token) {
                            alert("Session expired. Please log in again.");
                            window.location.href = "https://andalprima.hansmade.online/login"; // Redirect ke login
                            return;
                        }

                        console.log('Deleting product variant with ID:', increment);

                        // Panggil API untuk menghapus product variant
                        const response = await fetch(`https://andalprima.hansmade.online/api/deleted-product/${increment}`, {
                            method: 'DELETE',
                            headers: {
                                'Authorization': `Bearer ${token}`,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Failed to delete product variant.');
                        }

                        alert("Product variant deleted successfully!");

                        // Hapus elemen HTML dengan class `product_variant_${increment}`
                        const element = document.querySelector(`.product_variant_${increment}`);
                        if (element) {
                            element.remove();
                        }

                        // Refresh daftar produk (opsional, jika diperlukan)
                        fetchProducts();
                    })();
                } catch (error) {
                    console.error("Error deleting product variant:", error);
                    alert("Failed to delete product variant. Please try again.");
                }
            }
        }

        async function populateCategoryDropdown() {
            const dropdownCategoryUpdate = document.getElementById('dropdownproduct-category-update');

            try {
                const response = await fetch('/api/list-product-type', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    const categories = data.data.original;

                    dropdownCategoryUpdate.innerHTML = '<option value="">Select a category</option>';
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        dropdownCategoryUpdate.appendChild(option);
                    });
                } else {
                    console.error('Failed to fetch categories:', data.message);
                    alert('Failed to fetch categories.');
                }
            } catch (error) {
                console.error('Error fetching categories:', error);
                alert('An error occurred while fetching categories.');
            }
        }

        // Panggil saat halaman dimuat
        populateCategoryDropdown();

        document.getElementById('update_button').addEventListener('click', async function () {
            try {
                console.log("Saving product details...");

                const urlParams = new URL(window.location.href);
                const pathSegments = urlParams.pathname.split('/');
                const productId = pathSegments[pathSegments.length - 1];

                // Ambil nilai dari input dan elemen HTML
                const productName = document.getElementById('product_name').value; 

                const productTypeId = document.getElementById('dropdownproduct-category').value;

                // Loop melalui elemen dengan kelas 'product_variant'
                const productVariants = Array.from(document.querySelectorAll('[class^="iniproduct_variant_"]')).map((variantElement, index) => {
                    const increment = index + 1;

                    // Ambil nilai untuk setiap variant
                    const variantId = document.getElementById(`product_variant_id_${increment}`).value;
                    const variantName = document.getElementById(`product_variant_name_${increment}`).value;
                    const price = parseFloat(document.getElementById(`price_${increment}`).value);
                    const stock = parseInt(document.getElementById(`stock_${increment}`).value, 10);
                    const imageUrl = document.getElementById(`image_preview_${increment}`).src;
                    const poStatus = document.getElementById(`preorder_toggle_${increment}`).value === "1";
                    const descriptions = document.getElementById(`product_variant_description_${increment}`).value;

                    // Loop melalui elemen dalam container item variant
                    const variantItems = Array.from(document.querySelectorAll(`#item_variant_list_container_${increment} .product_variant_item`)).map(itemElement => {
                        const uniqueIndex = itemElement.dataset.index;

                        // Ambil nilai untuk setiap variant item
                        return {
                            id: document.getElementById(`variant_item_id_${uniqueIndex}`).value,
                            variant_item_type_id: document.getElementById(`variant_item_type_${uniqueIndex}`).value,
                            product_variant_item_name: document.getElementById(`variant_item_name_${uniqueIndex}`).value,
                            price_variant: parseFloat(document.getElementById(`variant_item_add_price_${uniqueIndex}`).value)
                        };
                    });

                    return {
                        id: variantId,
                        product_variant_name: variantName,
                        price: price,
                        stock: stock,
                        image_url: imageUrl,
                        po_status: poStatus,
                        descriptions: descriptions,
                        product_variant_item: variantItems
                    };
                });

                // Debug log moved after the initialization of productVariants
                console.log('habibi', productVariants);

                // Bentuk payload
                const payload = {
                    product_name: productName,
                    product_type_id: parseInt(productTypeId, 10),
                    product_variant: productVariants
                };

                console.log("Payload to send:", payload);

                // Kirim data ke API
                const authToken = sessionStorage.getItem('authToken'); // Ambil token dari sessionStorage
                if (!authToken) {
                    console.error("Auth token is missing in sessionStorage");
                    alert("Autentikasi tidak valid. Silakan login kembali.");
                    return;
                }

                const response = await fetch(`https://andalprima.hansmade.online/api/update-product/${productId}`, {
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
                    window.location.href = 'https://andalprima.hansmade.online/dashboard/product';
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
