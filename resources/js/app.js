// resources/js/app.js

import './bootstrap';
import { fetchShippings } from './api/fetchShippings';
import { fetchShippingDistricts } from './api/fetchShippingDistricts';
import { fetchProduct3 } from './api/fetchProduct3';
import { fetchExploreProduct } from './api/fetchExploreProduct';
import { fetchSpecialProduct } from './api/fetchSpecialProduct';
import { fetchRelateProduct } from './api/fetchRelateProduct';
import { fetchDetailProduct } from './api/fetchDetailProduct';

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

        async function renderProducts() {
            try {
                // Fetch products
                const products = await fetchProduct3();
                const specialProducts = await fetchSpecialProduct();
                const exploreProducts = await fetchExploreProduct();

                // Menambahkan produk ke dalam elemen HTML dengan id yang sesuai
                const productList = document.getElementById('product-list');
                const specialProductList = document.getElementById('special-product-list');
                const exploreProductList = document.getElementById('explore-product-list');

                // Reusable function to create product cards
                const createProductCard = (product) => {
                    const productCard = document.createElement('div');
                    productCard.setAttribute('data-product-id', product.product_id);
                    productCard.setAttribute('product-type-id', product.product_type_id);
                    productCard.setAttribute('product-variant-id', product.product_variant_id);

                    productCard.classList.add(
                        'product-card',
                        'shadow-custom',
                        'h-[186.83px]',
                        'bg-white',
                        'rounded-md',
                        'flex',
                        'flex-col',
                        'justify-between',
                        'overflow-hidden'
                    );
                    productCard.style.width = '149.74px';
                    productCard.style.flexShrink = '0';
                    productCard.style.position = 'relative';

                    const productImageContainer = document.createElement('div');
                    productImageContainer.classList.add(
                        'relative',
                        'w-full',
                        'h-[100px]',
                        'mb-2',
                        'rounded-t-md',
                        'overflow-hidden'
                    );

                    const productImage = document.createElement('img');
                    productImage.src = `${window.location.origin}/storage/${product.variant_image}`;
                    productImage.alt = product.variant_name;
                    productImage.classList.add('object-cover', 'w-full', 'h-full');
                    productImageContainer.appendChild(productImage);

                    if (product.preorder) {
                        const preorderLabel = document.createElement('span');
                        preorderLabel.textContent = 'Preorder';
                        preorderLabel.classList.add(
                            'bg-black',
                            'text-white',
                            'font-poppins',
                            'text-[10px]',
                            'font-normal',
                            'px-2',
                            'py-1',
                            'rounded',
                            'absolute',
                            'bottom-2',
                            'left-2'
                        );
                        preorderLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
                        productImageContainer.appendChild(preorderLabel);
                    }

                    const productName = document.createElement('p');
                    productName.textContent = product.variant_name;
                    productName.classList.add('font-normal', 'text-[#747474]', 'text-left', 'truncate', 'text-[10px]', 'mx-2');
                    productName.style.width = '100%';
                    productName.style.whiteSpace = 'nowrap';
                    productName.style.overflow = 'hidden';
                    productName.style.textOverflow = 'ellipsis';

                    const productPrice = document.createElement('p');
                    productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}`;
                    productPrice.classList.add('text-[14px]', 'text-left', 'font-semibold', 'text-[#292929]', 'm-2');
                    productPrice.style.width = '100%';
                    productPrice.style.whiteSpace = 'nowrap';
                    productPrice.style.overflow = 'hidden';
                    productPrice.style.textOverflow = 'ellipsis';

                    productCard.appendChild(productImageContainer);
                    productCard.appendChild(productName);
                    productCard.appendChild(productPrice);

                    // Event listener for product card click
                    productCard.addEventListener('click', async () => {
                        const productVariantId = product.product_variant_id;
                        const productTypeId = product.product_type_id;
                        try {
                            const productDetails = await fetchDetailProduct(productVariantId);
                            const relateProducts = await fetchRelateProduct(productTypeId);

                            console.log('Product relate:', relateProducts);

                            // Render related products
                            const relateProductList = document.getElementById('relate-product-list');
                            relateProductList.innerHTML = ''; // Clear previous related products
                            appendProductsToList(relateProducts, relateProductList, false);
                            updateViewAllLink(relateProducts.length, relateProductList.clientWidth, document.getElementById('relate-view-all-link'));

                            // Show related and detail sections
                            const detailSection = document.querySelector('section[name="detail-product"]');
                            detailSection.classList.remove('hidden');

                            const relateSection = document.querySelector('section[name="relate-product"]');
                            relateSection.classList.remove('hidden');

                        } catch (error) {
                            console.error('Error fetching product details:', error);
                        }
                    });

                    return productCard;
                };

                const appendProductsToList = (products, productList, addFirstCard = false) => {
                    if (addFirstCard) {
                        const firstCard = document.createElement('div');
                        firstCard.classList.add(
                            'shadow-none',
                            'h-[186.83px]',
                            'bg-transparent',
                            'rounded-md',
                            'flex',
                            'flex-col',
                            'justify-between',
                            'overflow-hidden'
                        );
                        firstCard.style.width = '149.74px';
                        firstCard.style.flexShrink = '0';
                        firstCard.style.position = 'relative';
                        productList.appendChild(firstCard);
                    }

                    products.forEach(product => {
                        const productCard = createProductCard(product);
                        productList.appendChild(productCard);
                    });
                };

                // Add products to the lists
                appendProductsToList(products, productList, true);
                appendProductsToList(specialProducts, specialProductList, false);
                appendProductsToList(exploreProducts, exploreProductList, false);

                console.log('Adding products:', products);

                function updateViewAllLink(totalProducts, listWidth, viewAllLink, isProducts = false) {
                    const productCardWidth = 149.74;
                    const visibleProductCount = isProducts
                        ? Math.floor(listWidth / productCardWidth) - 1
                        : Math.floor(listWidth / productCardWidth);

                    const hiddenProductCount = totalProducts - visibleProductCount;

                    if (hiddenProductCount > 0) {
                        viewAllLink.innerHTML = `View all (${hiddenProductCount}+) <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>`;
                    } else {
                        viewAllLink.textContent = `View all`;
                    }
                }

                updateViewAllLink(products.length, productList.clientWidth, document.getElementById('view-all-link'));
                updateViewAllLink(specialProducts.length, specialProductList.clientWidth, document.getElementById('special-view-all-link'));
                updateViewAllLink(exploreProducts.length, exploreProductList.clientWidth, document.getElementById('explore-view-all-link'));

            } catch (error) {
                console.error('Error rendering products:', error);
            }
        }

        renderProducts();

    } catch (error) {
        console.error('Error loading data:', error);
    }
});
