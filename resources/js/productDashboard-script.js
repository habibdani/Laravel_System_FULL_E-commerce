import { fetchProductDashboard } from './api/fetchProductDashboard';

document.addEventListener("DOMContentLoaded", async function () {
    const productContainer = document.getElementById("dashboard-product-list");

    try {
        // Fetch the product list
        const products = await fetchProductDashboard();
        console.log("Fetched products:", products);
        // Render each product dynamically
        products.forEach(product => {
            const productElement = `
                <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <!-- Product Image -->
                        <img src="/storage/${product.variant_image}" alt="${product.full_name_product}" class="h-24 w-24 object-cover mr-4 rounded-lg">

                        <!-- Product Information -->
                        <div>
                            <h2 class="font-bold text-lg">${product.full_name_product}</h2>
                            <p class="text-gray-600 text-sm">Varian: ${product.variant_name}</p>
                            <p class="text-gray-600 text-sm">Harga: Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}</p>
                            ${product.preorder ? `<span class="inline-block mt-2 px-2 py-1 text-yellow-800 bg-yellow-200 rounded">Pre Order</span>` : ''}
                        </div>
                    </div>

                    <!-- Product Price and Actions -->
                    <div class="text-right">
                        <a href="#" class="bg-blue-500 text-white px-3 py-2 rounded">Edit</a>
                        <a href="#" class="bg-red-500 text-white px-3 py-2 rounded ml-2">Hapus</a>
                    </div>
                </div>
            `;

            // Append the product element to the product container
            productContainer.innerHTML += productElement;
        });
    } catch (error) {
        console.error("Failed to fetch product list", error);
        productContainer.innerHTML = "<p class='text-red-500'>Failed to load products.</p>";
    }
});
