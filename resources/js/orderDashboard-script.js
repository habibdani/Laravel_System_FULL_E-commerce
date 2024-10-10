document.addEventListener("DOMContentLoaded", async function () {
    const orderContainer = document.querySelector('tbody'); // Kontainer untuk menampilkan list order
    const searchInput = document.querySelector('input[type="text"]'); // Input pencarian
    const paginationContainer = document.querySelector('.pagination-container'); // Kontainer untuk paginasi
    const prevButton = document.getElementById('prev-page'); // Tombol untuk halaman sebelumnya
    const nextButton = document.getElementById('next-page'); // Tombol untuk halaman selanjutnya

    let currentPage = 1; // Halaman saat ini
    let searchQuery = ''; // Query pencarian kosong pada awalnya

    async function fetchOrders() {
        try {
            // Dapatkan token dari sessionStorage
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                throw new Error('Token is missing, please log in again.');
            }

            // Membangun query parameter untuk API call
            const params = new URLSearchParams({
                search: searchQuery, // Query pencarian
                page: currentPage // Halaman saat ini
            });

            // Fetch data orders dari API
            const response = await fetch(`http://127.0.0.1:8001/api/list-order?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error('Failed to fetch orders');
            }

            // Pastikan data.data.data adalah array
            const orders = data.data.data;

            // Kosongkan kontainer sebelum menampilkan hasil baru
            orderContainer.innerHTML = '';

            // Render tiap order secara dinamis
            orders.forEach(order => {
                const orderRow = `
                    <tr class="border-b">
                        <td class="p-4">
                            <input type="checkbox" class="h-4 w-4">
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">#${order.bookings_id} by ${order.client_name}</div>
                            <div class="text-sm text-blue-500">${order.client_email}</div>
                        </td>
                        <td class="px-6 py-4">${order.created_at}</td>
                        <td class="px-6 py-4">${order.ship_to}</td>
                        <td class="px-6 py-4">${order.last_update}</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">${order.status_name}</span>
                        </td>
                        <td class="px-6 py-4">Rp. ${new Intl.NumberFormat('id-ID').format(order.amount)}</td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-600 hover:text-gray-900 pr-3">
                                <svg width="29" height="18" viewBox="0 0 29 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.671875" y="0.631836" width="27.2907" height="16.1909" rx="2" fill="white" stroke="#DADCE0"/>
                                    <circle cx="8.08761" cy="8.72725" r="2.04073" fill="#999999"/>
                                    <circle cx="14.3181" cy="8.72725" r="2.04073" fill="#999999"/>
                                    <circle cx="20.5485" cy="8.72725" r="2.04073" fill="#999999"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
                // Tambahkan baris ke tabel order
                orderContainer.innerHTML += orderRow;
            });

            // Update tombol pagination dan kondisi aktif/nonaktif
            prevButton.disabled = data.data.pagination.current_page === 1;
            nextButton.disabled = data.data.pagination.current_page >= data.data.pagination.last_page;

            // Update info pagination
            paginationContainer.innerHTML = `Menampilkan halaman ${data.data.pagination.current_page} - ${data.data.pagination.per_page} dari ${data.data.total}`;

        } catch (error) {
            console.error("Error fetching orders:", error);
            orderContainer.innerHTML = "<tr><td colspan='8' class='text-red-500'>Failed to load orders.</td></tr>";
        }
    }

    // Panggil fetchOrders pertama kali
    fetchOrders();

    // Event listener untuk input pencarian
    searchInput.addEventListener('input', function () {
        searchQuery = this.value; // Update query pencarian
        currentPage = 1; // Reset ke halaman pertama ketika mencari
        fetchOrders(); // Panggil fetchOrders lagi
    });

    // Event listener untuk tombol "Next Page"
    nextButton.addEventListener('click', function () {
        currentPage += 1; // Tambahkan halaman
        fetchOrders(); // Panggil fetchOrders untuk halaman berikutnya
    });

    // Event listener untuk tombol "Previous Page"
    prevButton.addEventListener('click', function () {
        currentPage -= 1; // Kurangi halaman
        fetchOrders(); // Panggil fetchOrders untuk halaman sebelumnya
    });
});
