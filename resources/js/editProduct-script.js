document.addEventListener('DOMContentLoaded', async function () {
    // Fetch the data from the API
    const token = 'your_token_here'; // Replace with your actual token
    const productVariantId = 25; // Replace with the actual variant ID if necessary
    const response = await fetch(`http://127.0.0.1:8001/api/product/details?id=${productVariantId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    });

    const result = await response.json();

    if (result.success) {
        const data = result.data.original;

        // Populate basic product information
        document.getElementById('id_product').value = data.headers.product_utama.id;
        document.getElementById('product_name').value = data.headers.product_utama.product_name;

        // Select the correct product category in the dropdown
        const productCategorySelect = document.getElementById('dropdownproduct-category');
        const productTypeId = data.headers.product_utama.product_type_id;
        for (let option of productCategorySelect.options) {
            if (option.value == productTypeId) {
                option.selected = true;
                break;
            }
        }

        // Populate product variant details
        document.getElementById('product_variant_name_1').value = data.product.full_name_product;
        document.getElementById('uploaded_image_name_1').textContent = data.product.variant_image; // Assuming this is the name of the uploaded image
        document.getElementById('product_variant_description_1').value = data.product.descriptions;
        document.getElementById('stock_1').value = data.product.stock;
        document.getElementById('price_1').value = data.product.price;

        // Handle variant items (if necessary)
        data.variant_types.forEach((variantType, index) => {
            const variantItemListContainer = document.getElementById(`item_variant_list_container_1`);
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
        });
    } else {
        console.error('Failed to retrieve product details.');
    }
});
