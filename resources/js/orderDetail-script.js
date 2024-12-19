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

            // <td class="py-3 px-6 text-center">${product.qty}</td>
            products.forEach(product => {
                console.log("produk id : ", product)
                const productRow = `
                    <tr id="row-${product.booking_item_id}" class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">${product.product_name}</td>
                        <td class="py-3 px-6 text-left">${product.variant_detail}</td>
                        <td class="py-3 px-6 text-center">
                            <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                                <button id="decrease-${product.booking_item_id}" class="p-2 h-full text-gray-700 focus:outline-none">
                                    <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                                    </svg>
                                </button>
                                <input id="quantity-${product.booking_item_id}" type="text" disabled value="${product.qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');"/>
                                <button id="increase-${product.booking_item_id}" class="px-2 h-full text-gray-700 focus:outline-none">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="12.1514" y="4.71851" width="2.77002" height="11.8347" transform="rotate(90 12.1514 4.71851)" fill="white"/>
                                        <rect x="7.61914" y="12.0208" width="2.77002" height="11.8347" transform="rotate(-180 7.61914 12.0208)" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">Rp. ${new Intl.NumberFormat('id-ID').format(product.price)}</td>
                        <td class="py-3 px-6 text-right">
                            <button id="deleted-${product.booking_item_id}" class="px-2 inline-flex items-center bg-white text-white py-2 rounded focus:outline-none">
                                <img src="/storage/icons/sampah.svg" alt="sampah" class="h-4 w-4">
                                <span class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left"></span>
                            </button>
                        </td>
                    </tr>
                `;
                productTableBody.innerHTML += productRow;
                // Add event listeners for actions
                document.getElementById(`decrease-${product.booking_item_id}`).addEventListener('click', () => updateQuantity(product.booking_item_id, -1));
                document.getElementById(`increase-${product.booking_item_id}`).addEventListener('click', () => updateQuantity(product.booking_item_id, 1));
                document.getElementById(`deleted-${product.booking_item_id}`).addEventListener('click', () => deleteRow(product.booking_item_id));

                // Tambahkan tombol Update di bagian bawah Product Details
                productTableBody.insertAdjacentHTML('afterend', `
                    <div class="flex mt-4">
                        <button id="update-order-btn" class="px-2 h-full text-white focus:outline-none rounded-md bg-red-500 p-2 hover:bg-red-700 transition duration-300">
                            Update Order
                        </button>
                    </div>
                `);

                // Tambahkan event listener untuk tombol Update
                document.getElementById('update-order-btn').addEventListener('click', () => updateOrder());
            });
        } else {
            console.error('Failed to fetch order details', data.message);
        }
    } catch (error) {
        console.error('Error fetching order details:', error);
    }
});

// Function to update product quantity
function updateQuantity(productId, delta) {
    const quantityInput = document.getElementById(`quantity-${productId}`);
    const decreaseButton = document.getElementById(`decrease-${productId}`);
    const increaseButton = document.getElementById(`increase-${productId}`);

    if (!quantityInput) {
        console.error(`Element quantity-${productId} not found`);
        return;
    }

    // Parse nilai kuantitas, default ke 0 jika nilai tidak valid
    let currentQty = parseInt(quantityInput.value, 10) || 0;

    // Update quantity jika hasil akhir > 0
    const newQty = currentQty + delta;
    if (newQty > 0) {
        quantityInput.value = newQty;

        // Disable decrease button jika nilai == 1
        if (newQty === 1) {
            decreaseButton.disabled = true;
            decreaseButton.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            decreaseButton.disabled = false;
            decreaseButton.classList.remove('opacity-50', 'cursor-not-allowed');
        }

        // Enable increase button (opsional jika ada batas maksimal)
        increaseButton.disabled = false;

        console.log(`Product ${productId} quantity updated to ${quantityInput.value}`);
    }
}

// Function to delete a row
function deleteRow(productId) {
    const row = document.getElementById(`row-${productId}`);
    if (row) {
        row.remove();

        // Optional: Send delete request to server
        console.log(`Product ${productId} removed`);
    }
}

function updateOrder() {
    const bookingId = window.location.pathname.split('/').pop(); // Ambil booking ID dari URL
    const updatedProducts = [];
    const quantityInputs = document.querySelectorAll('[id^="quantity-"]');

    // Loop untuk mengambil data produk
    quantityInputs.forEach(input => {
        const productId = input.id.split('-')[1];
        updatedProducts.push({
            product_id: productId,
            quantity: parseInt(input.value, 10) || 0
        });
    });

    // Kirim data ke server
    fetch('/api/update-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${sessionStorage.getItem('authToken')}`
        },
        body: JSON.stringify({ booking_id: bookingId, products: updatedProducts })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order updated successfully!');
        } else {
            console.error('Failed to update order:', data.message);
            alert('Failed to update order.');
        }
    })
    .catch(error => {
        console.error('Error updating order:', error);
        alert('An error occurred while updating the order.');
    });
}
