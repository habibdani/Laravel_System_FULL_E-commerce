// resources/js/app.js

import './bootstrap';
import { fetchShippings } from './api/fetchShippings';
import { fetchShippingDistricts } from './api/fetchShippingDistricts';
import { fetchProduct3 } from './api/fetchProduct3';

document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    window.csrfToken = csrfToken; // Simpan CSRF token di global scope
    console.log('CSRF Token:', csrfToken); // Pastikan CSRF token sudah ada

    // Logika lain yang membutuhkan CSRF token bisa menggunakan window.csrfToken
});

document.addEventListener('DOMContentLoaded', async function() {
    try {
        // Fetch shippings
        const shippings = await fetchShippings();
        console.log('Shippings:', shippings);

        // Tambahkan opsi dari data API
        const selectElement = document.getElementById('tipe-pembelian');
        shippings.forEach(shipping => {
            const option = document.createElement('option');
            option.value = shipping.id;
            option.textContent = shipping.type_pembelian;
            selectElement.appendChild(option);
        });

        // Anda bisa melanjutkan logika DOM untuk memanipulasi sidebar atau bagian lain
        const selectAlamat = document.getElementById('alamat');
        const ongkirDisplay = document.getElementById('ongkir-display');
        const iframe = document.getElementById("map");

        selectAlamat.addEventListener('change', function() {
            const selectedOption = selectAlamat.options[selectAlamat.selectedIndex];
            const price = selectedOption.dataset.price;
            const city = selectedOption.dataset.city; // Ambil nilai city dari dataset
            const district_id = selectedOption.dataset.district_id;
            const shipping_area_id = selectedOption.dataset.shipping_area_id;

            // Format harga ke dalam format "Rp.xxxx"
            const formattedPrice = `Rp.${parseInt(price).toLocaleString('id-ID')}`;

            const jsonData = {
                price: price,
                city: city,
                district_id: district_id,
                shipping_area_id: shipping_area_id,
            };

            // Perbarui tampilan ongkos kirim
            ongkirDisplay.textContent = formattedPrice;
            ongkirDisplay.setAttribute('price-value', formattedPrice); // Set data-value dengan nilai price
            ongkirDisplay.setAttribute('location-value', JSON.stringify(jsonData)); // Set data-value dengan nilai price

            // Ubah src dari iframe untuk memperbarui peta
            const url = `https://maps.google.com/maps?q=${encodeURIComponent(city)}&t=&z=13&ie=UTF8&iwloc=&output=embed`;
            iframe.src = url;

        });

        // Fetch shipping districts
        const shippingDistricts = await fetchShippingDistricts();
        console.log('Shipping Districts:', shippingDistricts);

        shippingDistricts.forEach(district => {
            const option = document.createElement('option');
            option.value = district.district_id; // Sesuaikan dengan field ID dari response API
            option.dataset.shippingAreaId = district.shipping_area_id;
            option.dataset.price = district.price; // Tambahkan sebagai data-attribute
            option.dataset.city = district.city;
            option.dataset.district_id = district.district_id;
            option.dataset.shipping_area_id = district.shipping_area_id;
            option.textContent = district.alamat; // Sesuaikan dengan field nama dari response API
            selectAlamat.appendChild(option);
        });

        // Fetch products
        const products = await fetchProduct3();
        console.log('Products:', products);

        // Menambahkan produk ke dalam elemen HTML dengan id 'product-list'
        const productList = document.getElementById('product-list');
        const productListSpecial = document.getElementById('product-list-special');
        const productListExplore = document.getElementById('product-list-explore');


        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add(
                'shadow-custom',
                'h-[186.83px]',
                'bg-white',
                'rounded-md',
                'flex',
                'flex-col',
                'justify-between',
                'overflow-hidden'  // Ensure content respects the rounded corners
            );
            productCard.style.width = '149.74px';  // Fixing the width
            productCard.style.flexShrink = '0';    // Prevent shrinking

            const productImage = document.createElement('img');
            productImage.src = `${window.location.origin}/storage/${product.variant_image}`;
            productImage.alt = product.variant_name;
            productImage.classList.add('object-cover', 'w-full', 'h-[100px]', 'mb-2', 'rounded-t-md');  // Rounded corners on the top

            const productName = document.createElement('p');
            productName.textContent = product.variant_name;
            productName.classList.add('text-[12px]', 'font-bold', 'text-center', 'truncate'); // 'truncate' for handling long text
            productName.style.width = '100%';  // Ensure full width usage
            productName.style.whiteSpace = 'nowrap';  // Prevent wrapping
            productName.style.overflow = 'hidden';  // Ensure no overflow
            productName.style.textOverflow = 'ellipsis';  // Add ellipsis for overflow text

            const productPrice = document.createElement('p');
            productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}`;
            productPrice.classList.add('text-[12px]', 'text-center', 'font-semibold', 'text-gray-700');
            productPrice.style.width = '100%';  // Ensure full width usage
            productPrice.style.whiteSpace = 'nowrap';  // Prevent wrapping
            productPrice.style.overflow = 'hidden';  // Ensure no overflow
            productPrice.style.textOverflow = 'ellipsis';  // Add ellipsis for overflow text

            productCard.appendChild(productImage);
            productCard.appendChild(productName);
            productCard.appendChild(productPrice);
            productList.appendChild(productCard);

        });

    } catch (error) {
        console.error('Error loading data:', error);
    }
});
