document.addEventListener("DOMContentLoaded", async function () {
    const dropdownCategory = document.getElementById('dropdownproduct-category');

    try {
        // Fetch list of product types from the API
        const response = await fetch('/api/list-product-type', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            const categories = data.data.original; // Get the list of categories

            // Clear the existing options in the dropdown
            dropdownCategory.innerHTML = '';

            // Add a default "Select a category" option
            dropdownCategory.innerHTML += `<option value="">Select a category</option>`;

            // Populate the dropdown with the categories from the API
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                dropdownCategory.appendChild(option);
            });
        } else {
            console.error('Failed to fetch categories:', data.message);
            alert('Failed to fetch categories');
        }
    } catch (error) {
        console.error('Error fetching categories:', error);
        alert('An error occurred while fetching categories.');
    }
});

// list varian type


// // image
document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById('image_input_1');
    const imagePreview = document.getElementById('image_preview_1');
    const uploadedImageContainer = document.getElementById('uploaded_image_container_1');
    const uploadedImageName = document.getElementById('uploaded_image_name_1');
    const removeImageButton = document.getElementById('remove_image_button_1');
    const loadingSpinner = document.getElementById('loading_spinner');

    // Klik div untuk memilih gambar
    imagePreview.addEventListener('click', function () {
        imageInput.click(); // Klik input file secara otomatis
    });

    // Ketika file gambar dipilih
    imageInput.addEventListener('change', async function (event) {
        const file = event.target.files[0];
        if (!file) {
            return;
        }

        const token = sessionStorage.getItem('authToken');
        if (!token) {
            alert('Token is missing, please log in again.');
            return;
        }

        const formData = new FormData();
        formData.append('image', file); // Tambahkan file ke form data

        // Tampilkan spinner dan sembunyikan area preview
        loadingSpinner.classList.remove('hidden');
        imagePreview.classList.add('hidden');

        try {
            const response = await fetch('https://andalprima.hansmade.online/api/upload-image', {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                const imageUrl = data.data.image_url;
                const imageName = imageUrl.split('/').pop(); // Mendapatkan nama file dari URL
                alert("Gambar berhasil diunggah!");

                // Tampilkan nama file yang sudah di-hash
                uploadedImageName.textContent = imageName;
                // Sembunyikan spinner dan tampilkan container untuk gambar yang diunggah
                loadingSpinner.classList.add('hidden');
                uploadedImageContainer.classList.remove('hidden');
            } else {
                alert('Gagal mengunggah gambar');
                loadingSpinner.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengunggah gambar.');
            loadingSpinner.classList.add('hidden');
            imagePreview.classList.remove('hidden');
        }
    });

    // Hapus gambar yang diunggah
    removeImageButton.addEventListener('click', async function () {
        try {
            const token = sessionStorage.getItem('authToken');
            const imagenameElement = document.getElementById('uploaded_image_name_1');
            const imagename = imagenameElement.textContent.trim();

            if (!token) {
                alert('Token is missing, please log in again.');
                return;
            }
            // Hit API delete-image
            loadingSpinner.classList.remove('hidden');

            const response = await fetch('https://andalprima.hansmade.online/api/delete-image', {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "image_url": imagename // Kirim nama file gambar yang dihapus
                })
            });

            const result = await response.json();

            if (response.ok && result.success) {
                console.log('Image deleted successfully');

                // Reset input dan tampilkan kembali area unggah
                imageInput.value = '';
                imagePreview.classList.remove('hidden');
                uploadedImageContainer.classList.add('hidden');
                uploadedImageName.textContent = '';
                loadingSpinner.classList.add('hidden');

            } else {
                console.error('Failed to delete image:', result.message);
                loadingSpinner.classList.add('hidden');
            }
        } catch (error) {
            console.error('Error deleting image:', error);
            loadingSpinner.classList.add('hidden');
        }
    });
});


document.addEventListener("DOMContentLoaded", async function () {
    let variantTypes = []; // Menyimpan opsi dropdown dari API

    // Fetch list of variant types from the API and populate the dropdown
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
            variantTypes = data.data.original;

            // Setelah data tersedia, isi dropdown pertama (variant_item_type_1)
            const initialDropdown = document.getElementById('variant_item_type_1');
            if (initialDropdown) {
                populateDropdown(variantTypes, initialDropdown);
            } else {
                console.error('Dropdown pertama variant_item_type_1 tidak ditemukan.');
            }

        } else {
            alert('Gagal mengambil data tipe varian.');
        }
    } catch (error) {
        alert('Terjadi kesalahan saat mengambil data tipe varian.');
        console.error(error);
    }

    // Fungsi untuk mengisi dropdown setelah elemen tersedia di DOM
    function populateDropdown(variantTypes, dropdownElement) {
        if (!variantTypes.length) {
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

    // Event listener untuk tombol Tambah Variant Item
    document.addEventListener('click', function(event) {

        // Pastikan event target mengarah ke tombol Tambah Item dengan ID dinamis
        if (event.target && event.target.id.startsWith('add_variant_item_')) {
            event.preventDefault();

            const variantCount = event.target.id.split('_').pop(); // Ambil ID unik varian
            let variantItemCount = document.querySelectorAll(`#item_variant_list_container_${variantCount} .input_variant_item_list`).length + 1; // Hitung item varian yang ada

            const selectedVariantType = document.getElementById(`variant_item_type_${variantCount}`);
            const variantName = document.getElementById(`variant_item_name_${variantCount}`).value.trim();
            const variantAddPrice = document.getElementById(`variant_item_add_price_${variantCount}`).value.trim();

            // Validasi input
            if (!selectedVariantType.value || !variantName) {
                alert('Tolong pilih tipe varian dan masukkan detail varian.');
                return;
            }

            const variantListContainer = document.getElementById(`item_variant_list_container_${variantCount}`);

            // Buat elemen untuk menampilkan varian yang disimpan
            const variantRow = document.createElement('div');
            variantRow.classList.add('flex', 'justify-between', 'items-center', 'bg-gray-100', 'rounded', 'px-4', 'py-2', 'mb-2', 'input_variant_item_list');
            variantRow.id = `input_variant_item_list_${variantCount}`;

            variantRow.innerHTML = `
                <div id="input_type_${variantCount}" class="flex space-x-4">
                    <span><strong>${selectedVariantType.options[selectedVariantType.selectedIndex].text}</strong></span>
                    <span>${variantName}</span>
                    <span>${variantAddPrice}</span>
                    <input type="hidden" id="input_variant_type_id_${variantCount}_${variantItemCount}" value="${selectedVariantType.value}">
                    <input type="hidden" id="input_variant_item_name_${variantCount}_${variantItemCount}" value="${variantName}">
                    <input type="hidden" id="input_variant_item_addprice_${variantCount}_${variantItemCount}" value="${variantAddPrice}">
                </div>
                <button class="delete-variant bg-red-600 text-white px-2 py-1 rounded" id="delete_variant_${variantCount}_${variantItemCount}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            // Tambahkan varian yang disimpan ke dalam kontainer
            variantListContainer.appendChild(variantRow);

            // Tambahkan event listener untuk tombol hapus varian item
            const deleteButton = document.getElementById(`delete_variant_${variantCount}_${variantItemCount}`);
            deleteButton.addEventListener('click', function () {
                variantRow.remove(); // Hapus elemen varian
            });

            // Reset input setelah varian ditambahkan
            selectedVariantType.value = '';
            document.getElementById(`variant_item_name_${variantCount}`).value = '';
            document.getElementById(`variant_item_add_price_${variantCount}`).value = '';
            document.getElementById(`variant_item_add_price_${variantCount}`).value = '0';
        }
    });

    // Fungsi untuk menangani upload image
    // Fungsi untuk menangani upload image
    function setupImageUploadHandlers(variantCount) {
        // Dapatkan elemen-elemen berdasarkan variantCount
        const imageInput = document.getElementById(`image_input_${variantCount}`);
        const imagePreview = document.getElementById(`image_preview_${variantCount}`);
        const uploadedImageContainer = document.getElementById(`uploaded_image_container_${variantCount}`);
        const uploadedImageName = document.getElementById(`uploaded_image_name_${variantCount}`);
        const removeImageButton = document.getElementById(`remove_image_button_${variantCount}`);
        const loadingSpinner = document.getElementById('loading_spinner');

        // Klik div untuk memilih gambar
        imagePreview.addEventListener('click', function () {
            imageInput.click(); // Klik input file secara otomatis
        });

        // Ketika file gambar dipilih
        imageInput.addEventListener('change', async function (event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }

            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                return;
            }

            const formData = new FormData();
            formData.append('image', file); // Tambahkan file ke form data

            // Tampilkan spinner dan sembunyikan area preview (jika spinner ada)
            if (loadingSpinner) loadingSpinner.classList.remove('hidden');
            imagePreview.classList.add('hidden');

            try {
                const response = await fetch('https://andalprima.hansmade.online/api/upload-image', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    const imageUrl = data.data.image_url;
                    const imageName = imageUrl.split('/').pop(); // Mendapatkan nama file dari URL
                    alert("Gambar berhasil diunggah!");
                    // Tampilkan nama file yang sudah di-hash
                    uploadedImageName.textContent = imageName;
                    uploadedImageContainer.classList.remove('hidden');
                } else {
                    alert('Gagal mengunggah gambar');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengunggah gambar.');
            } finally {
                if (loadingSpinner) loadingSpinner.classList.add('hidden');
            }
        });

        // Hapus gambar yang diunggah
        removeImageButton.addEventListener('click', async function () {
            try {
                const token = sessionStorage.getItem('authToken');
                const imageName = uploadedImageName.textContent.trim();

                if (!token) {
                    alert('Token is missing, please log in again.');
                    return;
                }

                // Hit API delete-image
                if (loadingSpinner) loadingSpinner.classList.remove('hidden');

                const response = await fetch('https://andalprima.hansmade.online/api/delete-image', {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "image_url": imageName // Kirim nama file gambar yang dihapus
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    console.log('Image deleted successfully');
                    // Reset input dan tampilkan kembali area unggah
                    imageInput.value = '';
                    imagePreview.classList.remove('hidden');
                    uploadedImageContainer.classList.add('hidden');
                    uploadedImageName.textContent = '';
                } else {
                    console.error('Failed to delete image:', result.message);
                }
            } catch (error) {
                console.error('Error deleting image:', error);
            } finally {
                if (loadingSpinner) loadingSpinner.classList.add('hidden');
            }
        });
    }

    // Event listener untuk tombol Tambah Variant baru
    const tambahVariantButton = document.getElementById('add_variant_button');
    let variantCount = 1; // Inisialisasi counter varian

    tambahVariantButton.addEventListener('click', function (event) {
        event.preventDefault();
        variantCount++; // Tambah counter varian

        // Fungsi untuk menambahkan elemen varian baru ke DOM
        const variantListContainer = document.getElementById('product-variant-list-container');

        const variantDiv = document.createElement('div');
        variantDiv.classList.add('product_varaint', 'bg-white', 'shadow', 'rounded-lg', 'p-4', 'mb-4');
        variantDiv.innerHTML = `
            <h2 class="font-bold text-gray-700 text-lg mb-4">Tambahkan Variant ${variantCount}</h2>
            <div class="space-y-4">
                <div id="item_variant_list_container_${variantCount}" class="mb-4"></div>
                <div class="product_variant_item_${variantCount} flex items-center space-x-2">
                    <select id="variant_item_type_${variantCount}" class="block w-1/4 rounded-lg border-gray-300 bg-white border-[1px] border-[#DADCE0] px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
                        <!-- Opsi akan diisi secara dinamis menggunakan JavaScript -->
                    </select>
                    <input type="text" id="variant_item_name_${variantCount}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Detail varian">
                    <input type="number" id="variant_item_add_price_${variantCount}" class="border-[1px] border-[#DADCE0] block w-1/4 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Add Price" value="0" min="0">
                    <button id="add_variant_item_${variantCount}" class="bg-red-600 text-white px-3 text-[12px] py-2 rounded">+ Tambah Item</button>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Variant Name</label>
                    <input type="text" id="product_variant_name_${variantCount}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Ketik nama varian">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Base Price</label>
                    <input type="number" id="price_${variantCount}" value="0" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok <span class="text-gray-500">(contoh: 1000)</span></label>
                    <input type="number" id="stock_${variantCount}" value="100" min="0" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="10000">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <div id="image_preview_${variantCount}" class="border-2 image_url border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <span class="text-gray-500">Unggah file atau geser file ke sini</span>
                        <input type="file" id="image_input_${variantCount}" class="hidden" accept="image/*">
                    </div>
                    <div id="uploaded_image_container_${variantCount}" class="hidden mt-2 flex items-center justify-between bg-gray-100 rounded-lg p-2">
                        <span id="uploaded_image_name_${variantCount}" class="text-gray-700"></span>
                        <button id="remove_image_button_${variantCount}" class="bg-red-600 text-white px-2 py-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <input type="text" id="product_variant_description_${variantCount}" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Descripsi varian">
                </div>
                <div class="flex items-center">
                    <label class="po_status block text-sm font-medium text-gray-700 mr-4">Pre Order</label>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="preorder_toggle_${variantCount}" class="sr-only peer" value="0">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:bg-red-600"></div>
                        <div class="absolute left-[2px] top-[2px] bg-white w-5 h-5 rounded-full transition-transform peer-checked:translate-x-full"></div>
                    </label>
                </div>
            </div>
        `;

        // Menambahkan varian baru ke container
        variantListContainer.appendChild(variantDiv);

        // Isi dropdown varian dengan data dari API
        const dropdownElement = document.getElementById(`variant_item_type_${variantCount}`);
        if (dropdownElement) {
            populateDropdown(variantTypes, dropdownElement);
        }

        // Setup image upload handlers untuk varian baru
        setupImageUploadHandlers(variantCount);
    });

    function togglePreOrder(checkbox) {
        const id = checkbox.id;
        const toggleNumber = id.split('_').pop(); // Ambil nomor dinamis dari ID

        if (checkbox.checked) {
            checkbox.value = "1"; // Pre Order aktif
        } else {
            checkbox.value = "0"; // Pre Order nonaktif
        }
    }

    document.addEventListener('click', function(event) {
        if (event.target && event.target.id.startsWith('preorder_toggle_')) {
            togglePreOrder(event.target);
        }
    });
});

// Mendapatkan referensi tombol delete_variant_button
const deleteButton = document.getElementById('delete_variant_button');

// Menambahkan event listener ketika tombol diklik
deleteButton.addEventListener('click', function() {
    // Mendapatkan elemen container yang berisi semua product_variant
    const container = document.getElementById('product-variant-list-container');
    
    // Mendapatkan semua elemen dengan kelas product_variant di dalam container
    const productVariants = container.getElementsByClassName('product_varaint');
    
    // Cek jika ada elemen product_variant di dalam container
    if (productVariants.length > 0) {
        // Menghapus elemen product_variant yang paling terakhir (yang paling bawah)
        const lastVariant = productVariants[productVariants.length - 1];
        lastVariant.remove();  // Menghapus elemen tersebut dari DOM
    } else {
        alert('Tidak ada varian produk yang dapat dihapus.');
    }
});


const overlay = document.getElementById('overlay');
const popupMessage = document.getElementById('popup-save-product');
const saveButton = document.getElementById('save_button');
const confirmButton = document.getElementById('confirm-button');
const cancelButton = document.getElementById('cancel-button');
const loadingSpinner = document.getElementById('loading_spinner');

saveButton.addEventListener('click', () => {
    popupMessage.innerText = 'Anda akan menambahkan produk baru!';

    overlay.classList.remove('hidden');
});

cancelButton.addEventListener('click', () => {
    overlay.classList.add('hidden');
});

confirmButton.addEventListener('click', async () => {
    overlay.classList.add('hidden');
    loadingSpinner.classList.remove('hidden');
    // Ambil data dari input form
    const productName = document.getElementById('product_name').value;
    const adminId = sessionStorage.getItem('adminId');
    const productTypeId = document.getElementById('dropdownproduct-category').value;

    let productVariantArray = [];

    // Hitung ada berapa banyak variant yang ada di container
    const variantContainers = document.querySelectorAll('[class^=product_varaint]');

    // Loop untuk setiap variant
    variantContainers.forEach((variant, index) => {
        const variantNumber = index + 1;
        const variantName = document.getElementById(`product_variant_name_${variantNumber}`).value;
        const price = document.getElementById(`price_${variantNumber}`).value;
        const stock = document.getElementById(`stock_${variantNumber}`).value;
        const imageUrl = `https://andalprima.hansmade.online/storage/images/${document.getElementById(`uploaded_image_name_${variantNumber}`).innerText}`;
        const poStatus = document.getElementById(`preorder_toggle_${variantNumber}`).checked ? 1 : 0;
        const description = document.getElementById(`product_variant_description_${variantNumber}`).value;

        let variantItemArray = [];

        const variantItems = document.querySelectorAll(`#item_variant_list_container_${variantNumber} .input_variant_item_list`);

        variantItems.forEach((item, itemIndex) => {
            const itemName = document.getElementById(`input_variant_item_name_${variantNumber}_${itemIndex + 1}`).value;
            const itemType = document.getElementById(`input_variant_type_id_${variantNumber}_${itemIndex + 1}`).value;
            const itemAddPrice = document.getElementById(`input_variant_item_addprice_${variantNumber}_${itemIndex + 1}`).value;

            variantItemArray.push({
                product_variant_item_name: itemName,
                variant_item_type_id: itemType,
                price_variant: itemAddPrice
            });
        });

        productVariantArray.push({
            product_variant_name: variantName,
            price: price,
            stock: stock,
            image_url: imageUrl,
            po_status: poStatus,
            descriptions: description,
            product_variant_item: variantItemArray
        });
    });

    const payload = {
        product_name: productName,
        admin_id: adminId,
        product_type_id: productTypeId,
        product_variant: productVariantArray
    };

    // Debug payload sebelum hit API
    console.log('Payload untuk API:', payload);

    // Jika sudah yakin dengan payload, lanjutkan ke hit API
    try {
        const response = await fetch('https://andalprima.hansmade.online/api/insert-product', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${sessionStorage.getItem('authToken')}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        console.log('Response dari API:', result);
        if (result.success) {  // Asumsi response API mengandung field 'success'
            alert('Produk berhasil ditambahkan!');
            // Lakukan redirect atau aksi lain jika perlu
            loadingSpinner.classList.add('hidden');
            window.location.href = 'https://andalprima.hansmade.online/dashboard/product';
        } else {
            alert('Gagal menambahkan produk. Coba lagi!');
        }
    } catch (error) {
        console.error('Error saat memanggil API:', error);
        loadingSpinner.classList.add('hidden');
    }
});

const form = document.getElementById('addCategoryForm');
const loadingSpinner2 = document.getElementById('loadingSpinner2');
const responseMessage = document.getElementById('responseMessage');

form.addEventListener('submit', async (event) => {
    event.preventDefault(); // Mencegah reload halaman saat submit
    
    const typeName = document.getElementById('type_name').value;

    // Menyiapkan payload
    const payload = {
        type_name: typeName
    };

    const token = sessionStorage.getItem('authToken');
        
        // Cek jika token tidak ada
        if (!token) {
            alert('Token is missing, please log in again.');
            return; // Tidak lanjutkan eksekusi jika token tidak ada
        }


    try {
        // Menampilkan spinner loading
        loadingSpinner2.classList.remove('hidden');
        responseMessage.textContent = '';

        // Mengirim request ke API
        const response = await fetch('https://andalprima.hansmade.online/api/insert-product-type', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}` // Gunakan token autentikasi jika perlu
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();
        
        // Menyembunyikan spinner setelah response
        

        // Mengecek apakah response berhasil
        if (response.ok && result.success) {
            responseMessage.textContent = 'Category added successfully!';
            responseMessage.classList.add('text-green-500');
            responseMessage.classList.remove('text-red-500');
            loadingSpinner2.classList.add('hidden');
            // Reset form setelah berhasil
            form.reset();
        } else {
            responseMessage.textContent = 'Failed to add category. Please try again.';
            responseMessage.classList.add('text-red-500');
            responseMessage.classList.remove('text-green-500');
            loadingSpinner2.classList.add('hidden');
        }
    } catch (error) {
        // Menyembunyikan spinner jika terjadi error
        loadingSpinner2.classList.add('hidden');
        console.error('Error:', error);
        responseMessage.textContent = 'An error occurred. Please try again.';
        responseMessage.classList.add('text-red-500');
        responseMessage.classList.remove('text-green-500');
    }
});

const form3 = document.getElementById('addVariantTypeForm');
    const loadingSpinner3 = document.getElementById('loadingSpinner3');
    const responseMessage3 = document.getElementById('responseMessage3');

    form3.addEventListener('submit', async (event) => {
        event.preventDefault(); // Mencegah reload halaman saat submit
        
        const variantTypeName = document.getElementById('variant_type_name').value;

        // Menyiapkan payload
        const payload = {
            varaint_type_name: variantTypeName
        };

        // Mengambil token dari sessionStorage
        const token = sessionStorage.getItem('authToken');
        
        // Cek jika token tidak ada
        if (!token) {
            alert('Token is missing, please log in again.');
            return; // Tidak lanjutkan eksekusi jika token tidak ada
        }

        try {
            // Menampilkan spinner loading
            loadingSpinner3.classList.remove('hidden');
            responseMessage3.textContent = '';

            // Mengirim request ke API
            const response = await fetch('https://andalprima.hansmade.online/api/insert-variant-type', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}` // Menggunakan token yang sudah diambil dari sessionStorage
                },
                body: JSON.stringify(payload)
            });

            const result = await response.json();
            
            // Menyembunyikan spinner setelah response
            loadingSpinner3.classList.add('hidden');

            // Mengecek apakah response berhasil
            if (response.ok && result.success) {
                responseMessage3.textContent = 'Variant Type added successfully!';
                responseMessage3.classList.add('text-green-500');
                responseMessage3.classList.remove('text-red-500');
                
                // Reset form setelah berhasil
                form3.reset();

                // Reload halaman setelah sukses
                setTimeout(() => {
                    window.location.reload(); // Reload halaman setelah 1 detik
                }, 1000); // Bisa disesuaikan, misalnya 1 detik untuk memberi waktu pada pengguna melihat pesan sukses
            } else {
                responseMessage3.textContent = 'Failed to add variant type. Please try again.';
                responseMessage3.classList.add('text-red-500');
                responseMessage3.classList.remove('text-green-500');
            }
        } catch (error) {
            // Menyembunyikan spinner jika terjadi error
            loadingSpinner3.classList.add('hidden');
            console.error('Error:', error);
            responseMessage3.textContent = 'An error occurred. Please try again.';
            responseMessage3.classList.add('text-red-500');
            responseMessage3.classList.remove('text-green-500');
        }
    });