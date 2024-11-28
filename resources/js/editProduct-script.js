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
                'Authorization': `Bearer ${token}`,
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

            // Isi informasi dasar produk
            document.getElementById('id_product').value = data.headers.product_utama.id;
            document.getElementById('product_name').value = data.headers.product_utama.product_name;

            // Pilih kategori produk yang sesuai di dropdown
            const productCategorySelect = document.getElementById('dropdownproduct-category');
            const productTypeId = data.headers.product_utama.product_type_id;
            for (let option of productCategorySelect.options) {
                if (option.value == productTypeId) {
                    option.selected = true;
                    break;
                }
            }

            // Isi detail varian produk
            const variantNameInput = document.getElementById(`product_variant_name_${productVariantId}`);
            const uploadedImageName = document.getElementById(`uploaded_image_name_${productVariantId}`);
            const descriptionInput = document.getElementById(`product_variant_description_${productVariantId}`);
            const stockInput = document.getElementById(`stock_${productVariantId}`);
            const priceInput = document.getElementById(`price_${productVariantId}`);

            if (variantNameInput) variantNameInput.value = data.product.full_name_product;
            if (uploadedImageName) uploadedImageName.textContent = data.product.variant_image;
            if (descriptionInput) descriptionInput.value = data.product.descriptions;
            if (stockInput) stockInput.value = data.product.stock;
            if (priceInput) priceInput.value = data.product.price;

            // Tangani item varian (jika ada)
            if (data.variant_types && Array.isArray(data.variant_types)) {
                data.variant_types.forEach((variantType) => {
                    const variantItemListContainer = document.getElementById(`item_variant_list_container_${productVariantId}`);
                    if (variantItemListContainer) {
                        variantType.items.forEach((item) => {
                            const variantItemElement = document.createElement('div');
                            variantItemElement.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');
                            variantItemElement.innerHTML = `
                                <span>${variantType.variant_item_type_name}</span>
                                <input type="text" value="${item.variant_item_name}" class="border-[1px] border-[#DADCE0] px-3 py-2 w-1/4 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                                <input type="number" value="${item.add_price}" class="border-[1px] border-[#DADCE0] px-3 py-2 w-1/4 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                            `;
                            variantItemListContainer.appendChild(variantItemElement);
                        });
                    }
                });
            }
        } else {
            console.error('Failed to retrieve product details:', result.message || 'Unknown error');
        }
    } catch (error) {
        console.error('An error occurred:', error.message);
    }
});
