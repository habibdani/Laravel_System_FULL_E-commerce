document.addEventListener("DOMContentLoaded", async function () {
    const orderContainer = document.querySelector('tbody'); // Kontainer untuk menampilkan list order
    const searchInput = document.querySelector('input[type="text"]'); // Input pencarian
    const paginationContainer = document.querySelector('.pagination-container'); // Kontainer untuk paginasi
    const prevButton = document.getElementById('prev-page'); // Tombol untuk halaman sebelumnya
    const nextButton = document.getElementById('next-page'); // Tombol untuk halaman selanjutnya
    const overlay = document.getElementById('overlay'); // Popup overlay
    const popupStatus = document.getElementById('popup-status'); // Status text in popup
    const confirmButton = document.getElementById('confirm-button'); // Confirm button
    const cancelButton = document.getElementById('cancel-button'); // Cancel button
    let pendingBookingsId = null; // Variable to store pending booking ID
    let pendingStatusId = null; // Variable to store pending status ID
    let pendingStatusName = ''; // Variable to store status name for confirmation

    let currentPage = 1; // Halaman saat ini
    let searchQuery = ''; // Query pencarian kosong pada awalnya

    async function fetchOrders() {
        try {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                throw new Error('Token is missing, please log in again.');
            }

            const params = new URLSearchParams({
                search: searchQuery,
                page: currentPage
            });

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

            const orders = data.data.data;
            orderContainer.innerHTML = '';

            orders.forEach(order => {
                const orderRow = `
                    <tr class="border-b">
                        <td class="p-4">
                            <input type="checkbox" class="h-4 w-4">
                        </td>
                        <td class="px-6 py-4">
                            <div id="order${order.bookings_id}" value="${order.bookings_id}" class="text-sm font-medium text-gray-900">#${order.bookings_id} by ${order.client_name}</div>
                            <div class="text-sm text-blue-500">${order.client_email}</div>
                        </td>
                        <td class="px-6 py-4">${order.created_at}</td>
                        <td class="px-6 py-4">${order.ship_to}</td>
                        <td class="px-6 py-4">${order.last_update}</td>
                        <td class="px-6 py-4">
                            <button style="background-color: ${order.color_status}" class="text-sm text-white font-medium px-2.5 py-1 rounded toggle-dropdown">${order.status_name}</button>
                            <ul class="dropdown hidden absolute text-left z-20 mt-2 w-40 bg-white border rounded shadow-lg">
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="3" data-status-name="Ship">Ship</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="2" data-status-name="Paid">Paid</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="4" data-status-name="Confirmed">Confirmed</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="5" data-status-name="Delivered">Delivered</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="6" data-status-name="Unpaid">Unpaid</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="7" data-status-name="Reject">Reject</li>
                                <li class="p-2 hover:bg-gray-100 cursor-pointer" data-status-id="1" data-status-name="Order Receipt">Order Receipt</li>
                            </ul>
                        </td>
                        <td class="px-6 py-4">Rp. ${new Intl.NumberFormat('id-ID').format(order.amount)}</td>
                        <td class="px-6 py-4 text-center relative">
                            <button class="text-gray-600 hover:text-gray-900 pr-3 order-detail-btn" data-booking-id="${order.bookings_id}">
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
                orderContainer.innerHTML += orderRow;
            });

            prevButton.disabled = data.data.pagination.current_page === 1;
            nextButton.disabled = data.data.pagination.current_page >= data.data.pagination.last_page;
            paginationContainer.innerHTML = `Menampilkan halaman ${data.data.pagination.current_page} dari ${data.data.pagination.last_page}`;

            // Event listener for dropdown toggle
            document.querySelectorAll('.toggle-dropdown').forEach(button => {
                button.addEventListener('click', function (e) {
                    const dropdown = this.nextElementSibling;
                    dropdown.classList.toggle('hidden');
                });
            });

            // Event listener for selecting status from dropdown
            document.querySelectorAll('.dropdown li').forEach(item => {
                item.addEventListener('click', function () {
                    pendingStatusId = this.getAttribute('data-status-id');
                    pendingStatusName = this.getAttribute('data-status-name');
                    const orderElement = this.closest('tr').querySelector('div[id^="order"]');
                    pendingBookingsId = orderElement.getAttribute('value'); // Ambil booking_id dari value

                    // Tampilkan popup
                    showPopup(pendingStatusName);
                });
            });

        } catch (error) {
            console.error("Error fetching orders:", error);
            orderContainer.innerHTML = "<tr><td colspan='8' class='text-red-500'>Failed to load orders.</td></tr>";
        }
    }

    function showPopup(statusName) {
        popupStatus.textContent = statusName; // Update status text in the popup
        overlay.classList.remove('hidden'); // Show the overlay
    }

    function hidePopup() {
        overlay.classList.add('hidden'); // Hide the overlay
    }

    confirmButton.addEventListener('click', async function () {
        if (pendingBookingsId && pendingStatusId) {
            await updateOrderStatus(pendingBookingsId, pendingStatusId); // Call function to update status
            hidePopup(); // Hide popup after updating status
        }
    });

    cancelButton.addEventListener('click', function () {
        hidePopup(); // Hide popup on cancel
    });

    async function updateOrderStatus(bookingsId, statusId) {
        try {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                throw new Error('Token is missing, please log in again.');
            }

            const response = await fetch('http://127.0.0.1:8001/api/update-status-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id: bookingsId,
                    status_id: statusId
                })
            });

            const data = await response.json();

            if (data.success) {
                fetchOrders(); // Refresh the orders list
            } else {
                throw new Error('Failed to update status');
            }

        } catch (error) {
            console.error('Error updating order status:', error);
            alert('Error updating order status');
        }
    }

    fetchOrders();

    searchInput.addEventListener('input', function () {
        searchQuery = this.value;
        currentPage = 1;
        fetchOrders();
    });

    nextButton.addEventListener('click', function () {
        currentPage += 1;
        fetchOrders();
    });

    prevButton.addEventListener('click', function () {
        currentPage -= 1;
        fetchOrders();
    });

    document.addEventListener('click', function(event) {
        // Check if the clicked element has the class 'order-detail-btn'
        const button = event.target.closest('.order-detail-btn');
        if (button) {
            const bookingId = button.getAttribute('data-booking-id');
            console.log('Redirecting to booking ID:', bookingId); // Debugging output
            window.location.href = `/dashboard/orders/detail/${bookingId}`;
        }
    });
});
