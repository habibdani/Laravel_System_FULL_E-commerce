document.addEventListener("DOMContentLoaded", async function () {
    const productContainer = document.getElementById("dashboard-product-list");
    const searchInput = document.querySelector('input[type="text"]');
    const sortSelect = document.querySelector('select');
    const paginationInfo = document.querySelector('.pagination-info');
    const prevButton = document.getElementById('prev-page');
    const nextButton = document.getElementById('next-page');

    let currentPage = 1; // Default page
    let searchQuery = ''; // Default search is empty
    let sortOrder = 'ASC'; // Default sort order
    let sortType = 1; // Default sorting type (Best Match)

    // Function to handle delete button clicks
    function setupDeleteButtons() {
        const deleteButtons = document.querySelectorAll('[id^="delete_product_variant_id_"]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', async function () {
                const productVariantId = this.id.replace('delete_product_variant_id_', ''); // Extract the variant ID from the button ID

                if (confirm("Are you sure you want to delete this product variant?")) {
                    try {
                        // Get the token from sessionStorage
                        const token = sessionStorage.getItem('authToken');

                        if (!token) {
                            alert("Session expired. Please log in again.");
                            window.location.href = "http://127.0.0.1:8001/login"; // Redirect to login
                            return;
                        }

                        console.log('delete product id', productVariantId);
                        // Call the delete API
                        const response = await fetch(`http://127.0.0.1:8001/api/deleted-product/${productVariantId}`, {
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

                        // Re-fetch the product list to update the UI
                        fetchProducts();
                    } catch (error) {
                        console.error("Error deleting product variant:", error);
                        alert("Failed to delete product variant. Please try again.");
                    }
                }
            });
        });
    }

    async function fetchProducts() {
        try {
            // Get the token from sessionStorage
            const token = sessionStorage.getItem('authToken');

            if (!token) {
                alert("Session expired. Please log in again.");
                window.location.href = "http://127.0.0.1:8001/login"; // Redirect to login
                return;
            }

            // Build the query parameters
            const params = new URLSearchParams({
                search: searchQuery,
                order: sortOrder,
                sortType: sortType, // This defines the sorting type
                page: currentPage
            });

            // Fetch the product list with the token and search/sorting params
            const response = await fetch(`http://127.0.0.1:8001/api/list-products-data?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                if (data.message === "Unauthenticated" || response.status === 401) {
                    alert("Session expired. Please log in again.");
                    window.location.href = "http://127.0.0.1:8001/login"; // Redirect to login
                } else {
                    throw new Error('Failed to fetch products');
                }
            }

            const products = data.data.products;

            // Clear the product container before rendering new products
            productContainer.innerHTML = '';

            // Render each product dynamically
            products.forEach(product => {
                const productElement = `
                    <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center mb-4">
                        <div class="flex items-start">
                            <!-- Product Image -->
                            <img src="/storage/${product.variant_image}" alt="${product.full_name_product}" class="h-32 w-32 object-cover mr-4 rounded-lg">

                            <!-- Product Information -->
                            <div class="flex flex-col">
                                <h2 class="font-bold text-lg">${product.full_name_product}</h2>
                                <p class="text-gray-600 text-sm mb-2">${product.descriptions}</p>

                                ${product.preorder ? `<span class="inline-block mt-2 px-2 py-1 text-white bg-green-600 rounded">Pre Order</span>` : ''}
                            </div>
                        </div>

                        <!-- Product Price and Actions -->
                        <div class="flex flex-col items-end">
                            <p class="font-bold text-lg text-green-600">
                                ${product.price_display}
                            </p>

                            <div class="flex items-center space-x-2">
                                 <p class="bg-green-600 text-white px-2 py-1 mt-1 rounded-md text-sm font-semibold">Stock: ${product.stock}</p>
                             </div>

                            <div class="flex mt-4 space-x-2">
                                <!-- Tombol Edit -->
                                <button id="edit_product_variant_id_${product.product_variant_id}"
                                        class="bg-blue-500 text-white flex items-center justify-center w-32 h-8 px-4 py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out"
                                        onclick="window.location.href='/dashboard/product/edit/${product.product_id}'">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" stroke="currentColor">
                                        <path d="M13.1106 4.91081L9.5284 1.32861L1.49133 9.3695L1.45703 12.9822L5.06971 12.9517L13.1106 4.91081Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.2832 3.57324L10.8654 7.15544" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Edit
                                </button>

                                <!-- Tombol Hapus -->
                                <button id="delete_product_variant_id_${product.product_variant_id}" class="bg-red-500 text-white flex items-center justify-center w-32 h-8 px-4 py-2 rounded-md hover:bg-red-600 transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18" stroke="currentColor">
                                        <path d="M12.875 4.36963H1.54297L2.81151 16.7759H11.6065L12.875 4.36963Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4.60938 1.54932H9.81073" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M5.59961 8.06494V12.2486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.81836 8.06494V12.2486" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>

                        </div>
                    </div>
                `;

                // Append the product element to the product container
                productContainer.innerHTML += productElement;
            });

            // Update pagination info
            paginationInfo.textContent = `Menampilkan halaman ${data.data.pagination.current_page} - ${data.data.pagination.per_page} dari ${data.data.pagination.total}`;

            // Update button states
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === data.data.pagination.last_page;

            setupDeleteButtons(); // Call setupDeleteButtons here to add event listeners
        } catch (error) {
            console.error("Failed to fetch product list", error);
            productContainer.innerHTML = "<p class='text-red-500'>Failed to load products.</p>";
        }
    }

    // Fetch products initially
    fetchProducts();

    // Handle search input change
    searchInput.addEventListener('input', function () {
        searchQuery = this.value; // Update search query
        currentPage = 1; // Reset to page 1 when searching
        fetchProducts(); // Fetch products based on new search
    });

    // Handle sorting change
    sortSelect.addEventListener('change', function () {
        switch (this.value) {
            case '1':
                sortOrder = 'ASC';  // Best Match, default
                sortType = 1;  // You can define any additional sorting logic for Best Match
                break;
            case '2':
                sortOrder = 'ASC';  // Price Low to High
                sortType = 2;
                break;
            case '3':
                sortOrder = 'DESC'; // Price High to Low
                sortType = 3;
                break;
        }
        currentPage = 1; // Reset to page 1 when sorting
        fetchProducts(); // Fetch products based on new sort order
    });

    // Handle next page click
    nextButton.addEventListener('click', function () {
        currentPage += 1; // Move to next page
        fetchProducts(); // Fetch next page
    });

    // Handle previous page click
    prevButton.addEventListener('click', function () {
        currentPage -= 1; // Move to previous page
        fetchProducts(); // Fetch previous page
    });

});



