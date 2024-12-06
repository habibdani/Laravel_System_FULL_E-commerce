// resources\js\product-script.js

import { fetchRelateProduct } from './api/fetchRelateProduct';
import { fetchDetailProduct } from './api/fetchDetailProduct';
import { data } from 'autoprefixer';

document.addEventListener('DOMContentLoaded', function() {
    async function renderProductDetail() {
        try {
            const productVariantId = window.productVariantId;

            // Fetch product details
            const productDetails = await fetchDetailProduct(productVariantId);
            console.log('Product detail:', productDetails);

            // Pastikan data API valid sebelum memproses
            if (!productDetails) {
                throw new Error('Data product details tidak valid');
            }

            const productData = productDetails.product;
            const variantTypes = productDetails.variant_types; // Mengambil variant_types dari respons API

            // Update gambar
            const mainImage = document.getElementById('mainImage');
            mainImage.src = `/storage/${productData.variant_image}`;

            const rightImage = document.getElementById('rightImage');
            rightImage.src = `/storage/${productData.variant_image}`;

             // Generate Thumbnails
            const thumbnailContainer = document.getElementById('list-image-product'); // Ambil elemen container thumbnail
            thumbnailContainer.innerHTML = ''; // Hapus thumbnail sebelumnya

            // Loop untuk generate 3 thumbnail dari gambar yang sama
            for (let i = 1; i <= 3; i++) {
                const thumbnail = document.createElement('img');
                thumbnail.id = `thumbnail${i}`;
                thumbnail.src = `/storage/${productData.variant_image}`;
                thumbnail.alt = `Thumbnail ${i}`;
                thumbnail.classList.add('thumbnail', 'w-[75px]', 'h-[75px]', 'object-cover', 'border-2', 'border-gray-300', 'rounded-lg', 'cursor-pointer');

                // Tambahkan event listener untuk mengganti mainImage saat thumbnail diklik
                thumbnail.addEventListener('click', () => {
                    mainImage.src = thumbnail.src;

                    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('border-[#E01535]'));

                    thumbnail.classList.add('border-[#E01535]');
                });

                thumbnailContainer.appendChild(thumbnail);
            }

            // Update detail produk
            const productTitle = document.getElementById('productTitle');
            productTitle.innerText = productData.full_name_product;
            productTitle.setAttribute('product-variant-id',productData.product_variant_id)

            let price_percentage = sessionStorage.getItem('price_percentage');
            price_percentage = !isNaN(price_percentage) && price_percentage !== null ? parseFloat(price_percentage) : 0;
            let variant_price = productData.price;
            let finalPrice = variant_price; // Jika price_percentage null, tidak ada penjumlahan
            if (price_percentage !== null) {
                let priceIncrease = (price_percentage / 100) * variant_price;
                finalPrice = variant_price + priceIncrease;
            }

            const productPrice = document.getElementById('productPrice');
            const formattedPrice = `Rp. ${new Intl.NumberFormat('id-ID', { style: 'decimal', minimumFractionDigits: 0 }).format(finalPrice)}`;
            productPrice.setAttribute('price-value-product', finalPrice);
            productPrice.innerText = formattedPrice;

            const stockElement = document.getElementById('productStock');
            stockElement.innerText = productData.stock;

            const productDescription = document.getElementById('productDescription');
            productDescription.innerHTML = productData.descriptions;
            // Tempat untuk menyisipkan HTML varian produk
            const variantContainer = document.getElementById('variantContainer');
            // Hapus isi kontainer sebelumnya (jika ada)
            variantContainer.innerHTML = '';

            // Pastikan variantTypes valid
            if (variantTypes && Array.isArray(variantTypes)) {
                variantTypes.forEach((variantType, index) => {
                    // Buat elemen div untuk setiap tipe varian
                    const variantDiv = document.createElement('div');
                    variantDiv.classList.add('mb-3');

                    // Buat elemen p untuk judul varian
                    const variantTitle = document.createElement('p');
                    variantTitle.id = `type-${index + 1}`;  // Set ID dinamis berdasarkan indeks
                    variantTitle.classList.add('text-gray-600', 'text-[12px]', 'font-semibold', 'label-variant-item-type');
                    variantTitle.innerText = variantType.variant_item_type_name; // Isi dengan nama variant type
                    variantTitle.setAttribute('value', variantType.variant_item_type_id)
                    variantDiv.appendChild(variantTitle);

                    // Buat elemen div untuk opsi varian
                    const optionDiv = document.createElement('div');
                    optionDiv.id = `Option-type-${index + 1}`;  // Set ID dinamis berdasarkan indeks
                    optionDiv.classList.add('flex', 'space-x-2', 'mt-1');

                    // Tambahkan setiap item varian sebagai tombol
                    variantType.items.forEach(item => {
                        const button = document.createElement('button');
                        button.classList.add(
                            'variant-option',
                            'p-1',
                            'bg-white',
                            'border-2',
                            'border-[#747474]',
                            'text-[#747474]',
                            'rounded',
                            'hover:border-[#E01535]',
                            'hover:text-[#E01535]',
                            'hover:bg-[#F9F5F6]');
                        button.innerText = item.variant_item_name;
                        button.setAttribute('add_price', item.add_price);
                        button.setAttribute('variant_item_id', item.variant_item_id);
                        button.setAttribute('variant_item_name', item.variant_item_name);

                        optionDiv.appendChild(button); // Tambahkan tombol ke dalam optionDiv
                    });

                    // Tambahkan optionDiv ke dalam variantDiv
                    variantDiv.appendChild(optionDiv);

                    // Tambahkan variantDiv ke dalam container utama
                    variantContainer.appendChild(variantDiv);
                });
            }

            const variantSideContainer = document.getElementById('variantSideContainer');

            // Hapus isi kontainer sebelumnya (jika ada)
            variantSideContainer.innerHTML = '';

            // Pastikan variantTypes valid
            if (variantTypes && Array.isArray(variantTypes)) {
                variantTypes.forEach((variantType, index) => {
                    // Buat elemen p untuk label varian
                    const labelElement = document.createElement('p');
                    labelElement.id = `type-label-${index + 1}`;  // Set ID dinamis berdasarkan indeks
                    labelElement.setAttribute('variant_item_type_id',variantType.variant_item_type_id);
                    labelElement.setAttribute('variant_item_type_name',variantType.variant_item_type_name);
                    labelElement.classList.add('text-gray-600', 'text-[12px]');
                    labelElement.innerText = variantType.variant_item_type_name; // Isi dengan nama variant type
                    variantSideContainer.appendChild(labelElement);

                    // Buat elemen p untuk value varian
                    const valueElement = document.createElement('p');
                    valueElement.id = `type-value-${index + 1}`;  // Set ID dinamis berdasarkan indeks
                    valueElement.classList.add('text-gray-800', 'font-semibold', 'mb-2', 'text-[12px]');
                    valueElement.innerText = '-'; // Default value atau bisa di-update nantinya
                    valueElement.setAttribute('variant_item_id', '');
                    valueElement.setAttribute('variant_item_name', '');
                    variantSideContainer.appendChild(valueElement);
                });
            }
        } catch (error) {
            console.error('Terjadi kesalahan saat mengambil atau memproses detail produk:', error);
        }
    }

    renderProductDetail();

    async function renderRelateProducts() {
        try {
            const productTypeId = window.productTypeId;

            // Fetch products
            const products = await fetchRelateProduct(productTypeId);

            // Menambahkan produk ke dalam elemen HTML dengan id yang sesuai
            const productList = document.getElementById('relate-product-list');

            // Reusable function to create product cards
            const createProductCard = (product) => {
                const productCard = document.createElement('div');
                productCard.setAttribute('data-product-id', product.product_id);
                productCard.setAttribute('product-type-id', product.product_type_id);
                productCard.setAttribute('product-variant-id', product.product_variant_id);

                // Membuat form secara dinamis
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = `/view-product`; // Menggunakan action tanpa query parameter

                // Token CSRF Laravel (jika diperlukan untuk pengamanan form)
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;

                // Menambahkan input tersembunyi untuk product_variant_id
                const productVariantInput = document.createElement('input');
                productVariantInput.type = 'hidden';
                productVariantInput.name = 'product_variant_id';
                productVariantInput.value = product.product_variant_id;

                // Menambahkan input tersembunyi untuk product_type_id
                const productTypeInput = document.createElement('input');
                productTypeInput.type = 'hidden';
                productTypeInput.name = 'product_type_id';
                productTypeInput.value = product.product_type_id;

                // Tambahkan CSRF dan input tersembunyi ke dalam form
                form.appendChild(csrfInput);
                form.appendChild(productVariantInput);
                form.appendChild(productTypeInput);

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

                let price_percentage = sessionStorage.getItem('price_percentage');
                price_percentage = !isNaN(price_percentage) && price_percentage !== null ? parseFloat(price_percentage) : 0;
                let variant_price = product.variant_price;
                let finalPrice = variant_price; // Jika price_percentage null, tidak ada penjumlahan
                if (price_percentage !== null) {
                    let priceIncrease = (price_percentage / 100) * variant_price;
                    finalPrice = variant_price + priceIncrease;
                }

                const productPrice = document.createElement('p');
                productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(finalPrice)}`;
                productPrice.classList.add('text-[14px]', 'text-left', 'font-semibold', 'text-[#292929]', 'm-2');
                productPrice.style.width = '100%';
                productPrice.style.whiteSpace = 'nowrap';
                productPrice.style.overflow = 'hidden';
                productPrice.style.textOverflow = 'ellipsis';

                productCard.appendChild(productImageContainer);
                productCard.appendChild(productName);
                productCard.appendChild(productPrice);

                // Append productCard to the form
                form.appendChild(productCard);

                // Tambahkan form ke dalam DOM
                document.body.appendChild(form);

                // Event listener for product card click
                productCard.addEventListener('click', async () => {
                    try {
                        form.submit();

                    } catch (error) {
                        console.error('Error fetching product details:', error);
                    }
                });

                return form; // Return the form yang berisi productCard
            };

            const appendProductsToList = (products, productList) => {

                products.forEach(product => {
                    const productCard = createProductCard(product);
                    productList.appendChild(productCard);
                });
            };

            // Add products to the lists
            appendProductsToList(products, productList);

            function updateViewAllLink(totalProducts, listWidth, viewAllLink, isProducts = false) {
                const productCardWidth = 149.74;
                const visibleProductCount = isProducts
                    ? Math.floor(listWidth / productCardWidth) - 1
                    : Math.floor(listWidth / productCardWidth);

                const hiddenProductCount = totalProducts - visibleProductCount;

                // if (hiddenProductCount > 0) {
                //     viewAllLink.innerHTML = `View all (${hiddenProductCount}+) <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                //         <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                //     </svg>`;
                // } else {
                //     viewAllLink.textContent = `View all`;
                // }
            }

            // Perbarui link View All
            updateViewAllLink(products.length, productList.clientWidth, document.getElementById('relate-view-all-link'));

        } catch (error) {
            console.error('Error rendering products:', error);
        }
    }

    renderRelateProducts();

    function showSlide(slideNumber) {
        document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
        document.getElementById('slide-' + slideNumber).classList.remove('hidden');

        document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
            btn.classList.remove('text-white', 'bg-[#E01535]');
            btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
        });

        document.getElementById('btn-slide-' + slideNumber).classList.add('text-white', 'bg-[#E01535]');
        document.getElementById('btn-slide-' + slideNumber).classList.remove('text-[#9D9D9D]', 'bg-transparent');
    }

    window.addEventListener('load', function() {
        showSlide(2);
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle');
        const considebar = document.getElementById('container-sidebar');

        sidebar.classList.remove('sidebar-visible');
        sidebar.classList.add('sidebar-hidden');
        considebar.style.width = "20px"; // Menambahkan style="width: 20px !important;"

        // considebar.classList.add('z-20');
        // considebar.classList.remove('z-20');
        toggleBtn.classList.remove('toggle-visible');
        toggleBtn.classList.add('toggle-hidden');

        const button2 = document.getElementById('btn-slide-2');
        button2.removeAttribute('disabled');

        const jumlahitem = document.getElementById('jumlahitem');
        jumlahitem.classList.remove('hidden');

        // const toslide2andshop = document.getElementById('to-slide-2-and-shop');
        // toslide2andshop.classList.add('hidden');

        // const totalbayar = document.getElementById('totalbayar');
        // totalbayar.classList.remove('hidden');

        const toggleIcon = toggleBtn.querySelector('img');
        const hiddenIcon = toggleBtn.getAttribute('data-hidden-icon');
        toggleIcon.src = hiddenIcon; // Mengganti src dengan gambar tersembunyi

        const totalBayarElement = document.getElementById('totalbayar');
        totalBayarElement.classList.add('hidden');
    });

});
