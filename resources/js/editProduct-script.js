document.addEventListener('DOMContentLoaded', async function () {
    try {
        // Ambil ID produk dari URL
        const urlParams = new URL(window.location.href);
        const pathSegments = urlParams.pathname.split('/');
        const productVariantId = pathSegments[pathSegments.length - 1];

        // Validasi ID sebelum melanjutkan
        if (isNaN(productVariantId)) {
            console.error('Invalid productVariantId in URL');
            return;
        }

        // Fetch data dari API
        const response = await fetch(`https://andalprima.hansmade.online/api/product/details?id=${productVariantId}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`, // Sesuaikan token Anda
                'Accept': 'application/json'
            }
        });

        // Periksa apakah respons berhasil
        if (!response.ok) {
            console.error(`Failed to fetch product details. Status: ${response.status}`);
            return;
        }

        const result = await response.json();

        if (result.success) {
            const data = result.data.original;

            // Temukan elemen target
            const mainEditContainer = document.getElementById('mainedit');
            mainEditContainer.innerHTML = ''; // Bersihkan kontainer sebelum menambahkan HTML baru

            // Isi informasi dasar produk
            const basicInfoHTML = `
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Basic Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input id="product_name" type="text" value="${data.headers.product_utama.product_name}" class="px-3 py-2 border-[1px] border-[#DADCE0] mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <input hidden id="id_product" type="text" value="${data.headers.product_utama.id}">
                            </div>
                        </div>
                    </div>
                </div>
            `;
            mainEditContainer.insertAdjacentHTML('beforeend', basicInfoHTML);

            // Isi detail varian produk
            const productVariantHTML = `
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow rounded-lg p-4">
                        <h2 class="font-bold text-gray-700 text-lg mb-4">Variant Details</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Variant Name</label>
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
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="product_variant_description" class="border-[1px] border-[#DADCE0] px-3 py-2 mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">${data.product.descriptions.replace(/<br>/g, '\n')}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            mainEditContainer.insertAdjacentHTML('beforeend', productVariantHTML);

            // Isi variant types
            data.variant_types.forEach((variantType) => {
                const variantTypeHTML = `
                    <div class="bg-white shadow rounded-lg p-4">
                        <h3 class="font-bold text-gray-700 text-lg mb-4">${variantType.variant_item_type_name}</h3>
                        <div id="item_variant_list_container_${variantType.variant_item_type_id}" class="space-y-2">
                            ${variantType.items
                                .map(
                                    (item) => `
                                <div class="flex items-center space-x-2 mb-2">
                                    <span>${variantType.variant_item_type_name}</span>
                                    <input type="text" value="${item.variant_item_name}" class="border-[1px] border-[#DADCE0] px-3 py-2 w-1/4 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                                    <input type="number" value="${item.add_price}" class="border-[1px] border-[#DADCE0] px-3 py-2 w-1/4 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                                </div>
                            `
                                )
                                .join('')}
                        </div>
                    </div>
                `;
                mainEditContainer.insertAdjacentHTML('beforeend', variantTypeHTML);
            });
        } else {
            console.error('Failed to retrieve product details:', result.message || 'Unknown error');
        }
    } catch (error) {
        console.error('An error occurred:', error.message);
    }
});
