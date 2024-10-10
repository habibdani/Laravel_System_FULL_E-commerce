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

    async function fetchProducts() {
        try {
            // Get the token from sessionStorage
            const token = sessionStorage.getItem('authToken');

            if (!token) {
                throw new Error('Token is missing, please log in again.');
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
                throw new Error('Failed to fetch products');
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
                                ${product.stock ? `<span class="inline-block mt-2 px-2 py-1 text-white bg-green-500 rounded">Stock Available</span>` : ''}
                            </div>
                        </div>

                        <!-- Product Price and Actions -->
                        <div class="flex flex-col items-end">
                            <p class="font-bold text-lg text-green-600">
                                ${product.price_display}
                            </p>

                            <div class="flex mt-4">
                                <a href="#" class="bg-blue-500 text-white px-3 py-2 rounded mr-2">Edit</a>
                                <a href="#" class="bg-red-500 text-white px-3 py-2 rounded">Hapus</a>
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
