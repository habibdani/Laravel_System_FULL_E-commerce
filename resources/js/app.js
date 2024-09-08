// resources/js/app.js

import './bootstrap';
// import { fetchShippings } from './api/fetchShippings';
// import { fetchShippingDistricts } from './api/fetchShippingDistricts';
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

// document.addEventListener('DOMContentLoaded', async function() {
//         async function renderProducts() {
//             try {
//                 // Fetch products
//                 const products = await fetchProduct3();
//                 const specialProducts = await fetchSpecialProduct();
//                 const exploreProducts = await fetchExploreProduct();

//                 // Menambahkan produk ke dalam elemen HTML dengan id yang sesuai
//                 const productList = document.getElementById('product-list');
//                 const specialProductList = document.getElementById('special-product-list');
//                 const exploreProductList = document.getElementById('explore-product-list');

//                 // Reusable function to create product cards
//                 const createProductCard = (product) => {
//                     const productCard = document.createElement('div');
//                     productCard.setAttribute('data-product-id', product.product_id);
//                     productCard.setAttribute('product-type-id', product.product_type_id);
//                     productCard.setAttribute('product-variant-id', product.product_variant_id);

//                     // Membuat form secara dinamis
//                     const form = document.createElement('form');
//                     form.method = 'GET';
//                     form.action = `/view-product-details`; // Menggunakan action tanpa query parameter

//                     // Token CSRF Laravel (jika diperlukan untuk pengamanan form)
//                     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//                     const csrfInput = document.createElement('input');
//                     csrfInput.type = 'hidden';
//                     csrfInput.name = '_token';
//                     csrfInput.value = csrfToken;

//                     // Menambahkan input tersembunyi untuk product_variant_id
//                     const productVariantInput = document.createElement('input');
//                     productVariantInput.type = 'hidden';
//                     productVariantInput.name = 'product_variant_id';
//                     productVariantInput.value = product.product_variant_id;

//                     // Tambahkan CSRF dan input tersembunyi ke dalam form
//                     form.appendChild(csrfInput);
//                     form.appendChild(productVariantInput);

//                     productCard.classList.add(
//                         'product-card',
//                         'shadow-custom',
//                         'h-[186.83px]',
//                         'bg-white',
//                         'rounded-md',
//                         'flex',
//                         'flex-col',
//                         'justify-between',
//                         'overflow-hidden'
//                     );
//                     productCard.style.width = '149.74px';
//                     productCard.style.flexShrink = '0';
//                     productCard.style.position = 'relative';

//                     const productImageContainer = document.createElement('div');
//                     productImageContainer.classList.add(
//                         'relative',
//                         'w-full',
//                         'h-[100px]',
//                         'mb-2',
//                         'rounded-t-md',
//                         'overflow-hidden'
//                     );

//                     const productImage = document.createElement('img');
//                     productImage.src = `${window.location.origin}/storage/${product.variant_image}`;
//                     productImage.alt = product.variant_name;
//                     productImage.classList.add('object-cover', 'w-full', 'h-full');
//                     productImageContainer.appendChild(productImage);

//                     if (product.preorder) {
//                         const preorderLabel = document.createElement('span');
//                         preorderLabel.textContent = 'Preorder';
//                         preorderLabel.classList.add(
//                             'bg-black',
//                             'text-white',
//                             'font-poppins',
//                             'text-[10px]',
//                             'font-normal',
//                             'px-2',
//                             'py-1',
//                             'rounded',
//                             'absolute',
//                             'bottom-2',
//                             'left-2'
//                         );
//                         preorderLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
//                         productImageContainer.appendChild(preorderLabel);
//                     }

//                     const productName = document.createElement('p');
//                     productName.textContent = product.variant_name;
//                     productName.classList.add('font-normal', 'text-[#747474]', 'text-left', 'truncate', 'text-[10px]', 'mx-2');
//                     productName.style.width = '100%';
//                     productName.style.whiteSpace = 'nowrap';
//                     productName.style.overflow = 'hidden';
//                     productName.style.textOverflow = 'ellipsis';

//                     const productPrice = document.createElement('p');
//                     productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}`;
//                     productPrice.classList.add('text-[14px]', 'text-left', 'font-semibold', 'text-[#292929]', 'm-2');
//                     productPrice.style.width = '100%';
//                     productPrice.style.whiteSpace = 'nowrap';
//                     productPrice.style.overflow = 'hidden';
//                     productPrice.style.textOverflow = 'ellipsis';

//                     productCard.appendChild(productImageContainer);
//                     productCard.appendChild(productName);
//                     productCard.appendChild(productPrice);

//                     // Append productCard to the form
//                     form.appendChild(productCard);

//                     // Tambahkan form ke dalam DOM
//                     document.body.appendChild(form);

//                     // Event listener for product card click
//                     productCard.addEventListener('click', async () => {
//                         const productVariantId = product.product_variant_id;
//                         const productTypeId = product.product_type_id;
//                         try {
//                             const productDetails = await fetchDetailProduct(productVariantId);
//                             const relateProducts = await fetchRelateProduct(productTypeId);

//                             console.log('Product relate:', relateProducts);
//                             console.log('Product detail:', productDetails);

//                             // Bersihkan produk terkait sebelumnya
//                             // relateProductList.innerHTML = '';
//                             // Render produk terkait
//                             // appendProductsToList(relateProducts, relateProductList, false);
//                             // Perbarui tombol View All produk terkait
//                             // updateViewAllLink(relateProducts.length, relateProductList.clientWidth, relateViewAllLink);

//                             // Submit form untuk membuka halaman detail produk (jika diperlukan)
//                             form.submit();

//                         } catch (error) {
//                             console.error('Error fetching product details:', error);
//                         }
//                     });

//                     return form; // Return the form yang berisi productCard
//                 };

//                 const appendProductsToList = (products, productList, addFirstCard = false) => {
//                     if (addFirstCard) {
//                         const firstCard = document.createElement('div');
//                         firstCard.classList.add(
//                             'shadow-none',
//                             'h-[186.83px]',
//                             'bg-transparent',
//                             'rounded-md',
//                             'flex',
//                             'flex-col',
//                             'justify-between',
//                             'overflow-hidden'
//                         );
//                         firstCard.style.width = '149.74px';
//                         firstCard.style.flexShrink = '0';
//                         firstCard.style.position = 'relative';
//                         productList.appendChild(firstCard);
//                     }

//                     products.forEach(product => {
//                         const productCard = createProductCard(product);
//                         productList.appendChild(productCard);
//                     });
//                 };

//                 // Add products to the lists
//                 appendProductsToList(products, productList, true);
//                 appendProductsToList(specialProducts, specialProductList, false);
//                 appendProductsToList(exploreProducts, exploreProductList, false);

//                 console.log('Adding products:', products);

//                 function updateViewAllLink(totalProducts, listWidth, viewAllLink, isProducts = false) {
//                     const productCardWidth = 149.74;
//                     const visibleProductCount = isProducts
//                         ? Math.floor(listWidth / productCardWidth) - 1
//                         : Math.floor(listWidth / productCardWidth);

//                     const hiddenProductCount = totalProducts - visibleProductCount;

//                     if (hiddenProductCount > 0) {
//                         viewAllLink.innerHTML = `View all (${hiddenProductCount}+) <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
//                             <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
//                         </svg>`;
//                     } else {
//                         viewAllLink.textContent = `View all`;
//                     }
//                 }

//                 // Perbarui link View All
//                 updateViewAllLink(products.length, productList.clientWidth, document.getElementById('view-all-link'));
//                 updateViewAllLink(specialProducts.length, specialProductList.clientWidth, document.getElementById('special-view-all-link'));
//                 updateViewAllLink(exploreProducts.length, exploreProductList.clientWidth, document.getElementById('explore-view-all-link'));

//             } catch (error) {
//                 console.error('Error rendering products:', error);
//             }
//         }

//         renderProducts();

// });
