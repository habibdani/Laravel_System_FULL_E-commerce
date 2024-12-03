document.addEventListener('DOMContentLoaded', () => {
    const loadingSpinner = document.getElementById('loading_spinner');
    loadingSpinner.classList.remove('hidden');

    setTimeout(() => {
        const quantityInput = document.getElementById('quantity');
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const addButton = document.getElementById('add');
        let stock = parseInt(document.getElementById('productStock').innerText);
        const priceElement = document.getElementById('productPrice');
        const mainImage = document.getElementById('mainImage');
        const basePrice = parseFloat(priceElement.getAttribute('price-value-product')) || 0;

        let selectedPrices = {};

        function updatePrice() {
            let totalPrice = basePrice;

            Object.values(selectedPrices).forEach(price => {
                totalPrice += price;
            });

            priceElement.setAttribute('price-value-product', totalPrice);
            priceElement.textContent = `Rp. ${totalPrice.toLocaleString()}`;
        }

        const variantContainer = document.getElementById('variantContainer');

        if (variantContainer) {
            variantContainer.addEventListener('click', (event) => {
                if (event.target.classList.contains('variant-option')) {
                    const button = event.target;

                    const parentId = button.closest('[id^="Option-type-"]').id;
                    const index = parseInt(parentId.split('-')[2]);

                    const variantButtons = document.querySelectorAll(`#${parentId} .variant-option`);
                    const variantSideValue = document.getElementById(`type-value-${index}`);

                    if (variantSideValue) {
                        variantButtons.forEach(btn => btn.classList.remove('active'));

                        button.classList.add('active');

                        variantSideValue.textContent = button.textContent;
                        const variantItemId = button.getAttribute('variant_item_id');
                        const variantItemName = button.getAttribute('variant_item_name');

                        variantSideValue.setAttribute('variant_item_id', variantItemId);
                        variantSideValue.setAttribute('variant_item_name', variantItemName);

                        const additionalPrice = parseFloat(button.getAttribute('add_price')) || 0;

                        selectedPrices[index] = additionalPrice;

                        updatePrice();
                    } else {
                        console.warn(`Elemen dengan ID type-value-${index} tidak ditemukan.`);
                    }
                }
            });
        } else {
            console.error('Elemen variantContainer tidak ditemukan.');
        }
        // // Menggunakan event delegation untuk opsi varian

        // Event listeners for Thumbnail images
        const thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', () => {
                // Ganti src dari gambar utama dengan src dari thumbnail yang diklik
                mainImage.src = thumbnail.src;

                // Hapus border merah dari semua thumbnail
                thumbnails.forEach(thumb => thumb.classList.remove('border-[#E01535]', 'border-gray-300'));

                // Tambahkan border merah ke thumbnail yang diklik
                thumbnail.classList.add('border-[#E01535]');
            });
        });

        decreaseButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                stock += 1;
                // document.getElementById('productStock').innerText = stock;
            }
        });


        increaseButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < stock) {
                quantityInput.value = currentValue + 1;
                stock -= 1;
                // document.getElementById('productStock').innerText = stock; // Perbarui tampilan stok
            }
        });

        const productStockElement = document.getElementById('productStock');
        
        if (quantityInput && productStockElement) {
            let totalStock = parseInt(productStockElement.innerText, 10); // Total stok awal
        
            // Pastikan totalStock adalah angka yang valid
            if (isNaN(totalStock)) {
                console.error("Total stok awal tidak valid.");
                return;
            }
        
            quantityInput.addEventListener('keydown', (event) => {
                setTimeout(() => {
                    let currentValue = parseInt(quantityInput.value, 10);
        
                    // Validasi nilai input
                    if (isNaN(currentValue) || currentValue < 1) {
                        currentValue = 1; // Tetapkan nilai minimum jika invalid
                    } else if (currentValue > totalStock) {
                        currentValue = totalStock; // Batasi input ke stok maksimum
                    }
        
                    quantityInput.value = currentValue; // Perbarui input ke nilai valid
        
                    // Hitung stok tersisa
                    const stock = totalStock - currentValue;
        
                    // Perbarui tampilan stok tersisa
                    // productStockElement.innerText = stock;
                }, 0); // Timeout diperlukan untuk menangkap nilai terbaru setelah key press
            });
        
            // Tambahkan event untuk menangani perubahan stok dinamis jika diperlukan
            quantityInput.addEventListener('blur', () => {
                totalStock = parseInt(productStockElement.innerText, 10); // Perbarui total stok jika stok awal berubah
                if (isNaN(totalStock)) totalStock = 0;
            });
        } else {
            console.error("Element quantityInput atau productStock tidak ditemukan di DOM.");
        }        
        
        // fuction ketika menambahkan product ke keranjang
        addButton.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle');
            const considebar = document.getElementById('container-sidebar');

            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
            considebar.classList.add('z-20');
            considebar.classList.remove('z-20');
            toggleBtn.classList.remove('toggle-hidden');
            toggleBtn.classList.add('toggle-visible');
            considebar.style.width = "0px";
            const toggleIcon = toggleBtn.querySelector('img');
            const visibleIcon = toggleBtn.getAttribute('data-visible-icon');
            toggleIcon.src = visibleIcon;

            const productVariantId = document.getElementById('productTitle').getAttribute('product-variant-id');
            const productVariantName = document.getElementById('productTitle').innerText;
            const productImage = document.getElementById('rightImage').getAttribute('src');

            const variantContainer = document.getElementById('variantSideContainer');
            let variantDetails = [];

            if (variantContainer) {
                const typeLabels = variantContainer.querySelectorAll('[id^="type-label-"]');
                const typeValues = variantContainer.querySelectorAll('[id^="type-value-"]');

                // Check if typeLabels and typeValues are not empty
                if (typeLabels.length > 0 && typeValues.length > 0) {
                    variantDetails = Array.from(typeValues).map((valueElem, index) => {
                        const typeLabelElem = typeLabels[index];
                        return {
                            variant_item_type_id: typeLabelElem?.getAttribute('variant_item_type_id') || '',
                            variant_item_type_name: typeLabelElem?.getAttribute('variant_item_type_name') || '',
                            variant_item_name: valueElem.getAttribute('variant_item_name') || '',
                            variant_item_id: valueElem.getAttribute('variant_item_id') || ''
                        };
                    });
                }
            }

            const qty = quantityInput.value;
            const pricesatuan = parseFloat(priceElement.getAttribute('price-value-product'));
            const price = parseFloat(priceElement.getAttribute('price-value-product')) * qty;
            const priceDisplay = `Rp. ${price.toLocaleString('id-ID')}`;

            // Check sessionStorage for existing product_card_count
            let productCardCount = parseInt(sessionStorage.getItem('product_card_count')) || 0;

            let isExisting = false;
            // Check if productVariantId already exists in sessionStorage
            for (let i = 0; i < productCardCount; i++) {
                const storedProductId = sessionStorage.getItem(`product_variant_id_${i}`);
                if (storedProductId === productVariantId) {
                    // Update quantity and price if the product already exists
                    const currentQty = parseInt(sessionStorage.getItem(`product_varaint_quantity_${i}`)) || 0;
                    const newQty = currentQty + parseInt(qty);
                    const currentPrice = parseFloat(sessionStorage.getItem(`product_variant_price_value_${i}`)) || 0;
                    const newPrice = currentPrice + parseInt(price);

                    sessionStorage.setItem(`product_varaint_quantity_${i}`, newQty);
                    sessionStorage.setItem(`product_variant_price_value_${i}`, newPrice);
                    sessionStorage.setItem(`product_price_text_${i}`, `Rp. ${newPrice.toLocaleString('id-ID')}`);
                    sessionStorage.setItem(`product_variant_item_count_${i}`,variantDetails.length);

                    // Update the rendered HTML for the existing product
                    const existingProductCard = document.querySelector(`.sidebar-product-card[value="${productVariantId}"]`);
                    if (existingProductCard) {
                        // Update quantity in the input field
                        const quantityInput = existingProductCard.querySelector(`#sidebar-quantity-${productVariantId}`);
                        quantityInput.value = newQty;
            
                        // Update total price text
                        const priceText = existingProductCard.querySelector(`#sidebar-price-text-${productVariantId}`);
                        priceText.innerText = `Rp. ${newPrice.toLocaleString('id-ID')}`;
            
                        // Update the sidebar_value_price attribute
                        const priceContainer = existingProductCard.querySelector(`#sidebar_price_product_${productVariantId}`);
                        if (priceContainer) {
                            priceContainer.setAttribute('sidebar_value_price', newPrice);
                        }
                    }

                    isExisting = true;
                    break;
                }
            }
            
            if (!isExisting) {
                // Add new product to sessionStorage
                sessionStorage.setItem(`product_variant_id_${productCardCount}`, productVariantId);
                sessionStorage.setItem(`productImageSrc_${productCardCount}`, productImage);
                sessionStorage.setItem(`product_price_text_${productCardCount}`, priceDisplay);
                sessionStorage.setItem(`product_varaint_quantity_${productCardCount}`, qty);
                sessionStorage.setItem(`product_variant_name_${productCardCount}`, productVariantName);
                sessionStorage.setItem(`product_variant_price_value_${productCardCount}`, price);
                sessionStorage.setItem(`product_variant_price_value_satuan_${productCardCount}`, pricesatuan);
                sessionStorage.setItem(`product_variant_item_count_${productCardCount}`,variantDetails.length);
                // Increment product_card_count
                productCardCount++;
                sessionStorage.setItem('product_card_count', productCardCount);

                // Add product card to the sidebar
                const listOrderContainer = document.querySelector('.list-order-item');
                const newProductCard = document.createElement('div');
                newProductCard.setAttribute('value', productVariantId);
                newProductCard.classList.add('sidebar-product-card', 'flex', 'items-start', 'justify-between', 'p-3', 'h-1/3', 'w-full', 'bg-[#F4F4F4]', 'rounded-md');

                newProductCard.innerHTML = `
                    <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
                    <div class="ml-3 space-y-1 flex-1">
                        <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id="${productVariantId}" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                            ${productVariantName}
                        </p>
                        <p class="text-[#707070] font-normal text-[12px]">Detail:</p>
                        <div id="detail-product-sidebar-${productVariantId}" class="sidebar-list-varaint-label space-y-1">
                            ${variantDetails.length > 0 ? variantDetails.map(detail => `
                            <p id="sidebar_label_variant_item_type_${productVariantId}_${detail.variant_item_type_id}" class="text-[12px] font-normal text-[#292929]" sidebar_variant_item_type_id="${detail.variant_item_type_id}">
                                ${detail.variant_item_type_name}:
                                <span id="sidebar_variant_item_${productVariantId}_${detail.variant_item_id}" sidebar_variant_item_id="${detail.variant_item_id}">
                                    ${detail.variant_item_name}
                                </span>
                            </p>
                            `).join('') : '<p class="text-[12px] font-normal text-[#707070]">Tidak ada varian</p>'}
                        </div>
                        <div id="sidebar_price_product_${productVariantId}" sidebar_value_price="${price}" sidebar_price_satuan="${pricesatuan}" class="bg-white w-5/6 p-1 rounded-md">
                            <p class="text-[12px] font-normal">Total Harga:
                                <span id="sidebar-price-text-${productVariantId}" class="text-[12px] font-semibold">${priceDisplay}</span>
                            </p>
                        </div>
                        <div class="flex pr-4 justify-between pt-2 w-full items-center mb-2">
                            <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                                <button id="sidebar-decrease-${productVariantId}" class="p-2 h-full text-gray-700 focus:outline-none">
                                    <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                                    </svg>
                                </button>
                                <input id="sidebar-quantity-${productVariantId}" type="text" disabled value="${qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');"/>
                                <button id="sidebar-increase-${productVariantId}" class="px-2 h-full text-gray-700 focus:outline-none">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="12.1514" y="4.71851" width="2.77002" height="11.8347" transform="rotate(90 12.1514 4.71851)" fill="white"/>
                                        <rect x="7.61914" y="12.0208" width="2.77002" height="11.8347" transform="rotate(-180 7.61914 12.0208)" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                            <button id="sidebar-product-deleted-${productVariantId}" class="px-2 inline-flex items-center bg-white text-white py-2 rounded focus:outline-none">
                                <img src="/storage/icons/sampah.svg" alt="sampah" class="h-4 w-4">
                                <span class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left"></span>
                            </button>
                        </div>
                    </div>
                `;

                listOrderContainer.appendChild(newProductCard);
            }

            

            updateTotalItemAndPrice();
        });

        // Fungsi untuk menghitung total harga dan jumlah item di sidebar
        function updateTotalItemAndPrice() {
            const priceElements = document.querySelectorAll('[id^="price-product-sidebar-"]');
            let totalPrice = 0;
            let totalItems = 0;

            priceElements.forEach(priceElement => {
                const priceValue = parseInt(priceElement.getAttribute('value-price-product-sidebar'));
                if (!isNaN(priceValue)) {
                    totalPrice += priceValue;
                    totalItems += 1;
                }
            });

            const totalItemElement = document.getElementById('totalitem');
            const totalPriceElement = document.getElementById('totalallprice');
            const jumlahItemElement = document.getElementById('jumlahitem');

            if (totalItemElement && totalPriceElement && jumlahItemElement) {
                totalItemElement.innerText = totalItems;
                totalPriceElement.innerText = ` ${totalPrice.toLocaleString('id-ID')}`;
                jumlahItemElement.classList.remove('hidden');
            } else {
                console.error('Elemen totalitem, totalprice, atau jumlahitem tidak ditemukan');
            }
        }


        setTimeout(() => {
            loadingSpinner.classList.add('hidden');
        }, 500);
    }, 1500);
});

document.addEventListener('DOMContentLoaded', () => {

});
