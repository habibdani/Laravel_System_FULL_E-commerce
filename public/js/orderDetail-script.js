document.addEventListener("DOMContentLoaded", async function () {
    try {
        const urlPath = window.location.pathname;
        const bookingId = urlPath.split('/').pop();

        const token = sessionStorage.getItem('authToken');
            if (!token) {
                throw new Error('Token is missing, please log in again.');
            }

        const response = await fetch(`/api/detail-order?id=${bookingId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            const order = data.data.order[0]; // Ambil data pesanan
            const products = data.data.products; // Ambil data produk

            // Set order details
            document.getElementById('order-id').textContent = `Order Details: #${order.bookings_id}`;
            document.getElementById('order-date').textContent = order.created_at;
            document.getElementById('order-status').textContent = order.status_name;
            document.getElementById('order-status').style.backgroundColor = order.color_status;
            document.getElementById('client-name').textContent = order.client_name;
            document.getElementById('client-phone').textContent = order.client_phone_number;
            document.getElementById('client-email').textContent = order.client_email;
            document.getElementById('client-address').textContent = order.address;
            document.getElementById('client-city').textContent = order.city;
            document.getElementById('client-code-pos').textContent = order.code_pos;

            // Render product details in table
            const productTableBody = document.getElementById('product-list');
            productTableBody.innerHTML = ''; // Clear existing rows

            products.forEach(product => {
                const productRow = `
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">${product.product_name}</td>
                        <td class="py-3 px-6 text-left">${product.variant_detail}</td>
                        <td class="py-3 px-6 text-center">${product.qty}</td>
                        <td class="py-3 px-6 text-center">Rp. ${new Intl.NumberFormat('id-ID').format(product.price)}</td>
                    </tr>
                `;
                productTableBody.innerHTML += productRow;
            });
        } else {
            console.error('Failed to fetch order details', data.message);
        }
    } catch (error) {
        console.error('Error fetching order details:', error);
    }
});
