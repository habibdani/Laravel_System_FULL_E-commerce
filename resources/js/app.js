// resources/js/app.js

import './bootstrap';
// import { fetchShippings } from './api/fetchShippings';
// import { fetchShippingDistricts } from './api/fetchShippingDistricts';

import { fetchRelateProduct } from './api/fetchRelateProduct';
import { fetchDetailProduct } from './api/fetchDetailProduct';

document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    window.csrfToken = csrfToken; // Simpan CSRF token di global scope
    console.log('CSRF Token:', csrfToken); // Pastikan CSRF token sudah ada

    // Logika lain yang membutuhkan CSRF token bisa menggunakan window.csrfToken
});

document.addEventListener('DOMContentLoaded', async function() {
        

});
