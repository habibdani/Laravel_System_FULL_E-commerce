// resources/js/app.js

import './bootstrap';
import { fetchShippings } from './api/fetchShippings';
import { fetchShippingDistricts } from './api/fetchShippingDistricts';

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

        $('#alamat').select2({
            placeholder: "Pilih Alamat",
            allowClear: true,
        });

    } catch (error) {
        console.error('Error loading data:', error);
    }
});
