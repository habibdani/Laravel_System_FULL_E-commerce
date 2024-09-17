document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const quantityInput = document.getElementById('quantity');
        const decreaseButton = document.getElementById('decrease');
        const increaseButton = document.getElementById('increase');
        const addButton = document.getElementById('add');
        const stock = parseInt(document.getElementById('productStock').innerText);
        const priceElement = document.getElementById('productPrice');
        let basePrice = parseFloat(priceElement.getAttribute('price-value-product')) || 0;

        const mainImage = document.getElementById('mainImage');

        // Menyimpan harga tambahan yang dipilih
        let selectedPrices = {};

        // Function to update the displayed price
        function updatePrice() {
            let totalPrice = basePrice;

            // Tambahkan semua harga varian yang dipilih
            Object.values(selectedPrices).forEach(price => {
                totalPrice += price;
            });

            // Perbarui atribut 'price-value-product' dengan nilai total baru
            priceElement.setAttribute('price-value-product', totalPrice);
            priceElement.textContent = `Rp. ${totalPrice.toLocaleString()}`;
        }

        const variantTypes = document.querySelectorAll('[id^=type-]'); // Ambil semua elemen tipe berdasarkan ID yang di-generate (type-1, type-2, dst.)
        const variantSideLabels = document.querySelectorAll('[id^=type-label-]');
        const variantSideValues = document.querySelectorAll('[id^=type-value-]');

        variantTypes.forEach((variantType, index) => {
            const variantSideLabel = variantSideLabels[index];
            const variantSideValue = variantSideValues[index];

            // Masukkan nama tipe varian ke label samping
            if (variantType && variantSideLabel) {
                variantSideLabel.textContent = variantType.textContent; // Pastikan label diisi
            }

            // Cari tombol opsi varian untuk setiap tipe (misalnya, variant-option-1, variant-option-2, dll.)
            const variantButtons = document.querySelectorAll(`#Option-type-${index + 1} .variant-option`);
            // console.log(`Tombol varian untuk tipe ${index + 1}:`, variantButtons);

            variantButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Hapus kelas aktif dari semua tombol
                    variantButtons.forEach(btn => btn.classList.remove('active'));

                    // Tambahkan kelas aktif ke tombol yang diklik
                    button.classList.add('active');

                    // Sinkronkan dengan tampilan samping (variantSide)
                    variantSideValue.textContent = button.textContent;
                    const vii = button.getAttribute('variant_item_id');
                    variantSideValue.setAttribute('variant_item_id', vii);
                    // Ambil harga tambahan dari tombol yang dipilih
                    const additionalPrice = parseFloat(button.getAttribute('add_price')) || 0; // Ambil add_price

                    // Simpan harga tambahan dalam objek selectedPrices berdasarkan tipe varian (index)
                    selectedPrices[index] = additionalPrice;

                    // Update harga total
                    updatePrice();
                });
            });
        });

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
            if (currentValue > 1) { // Minimum quantity is 1
                quantityInput.value = currentValue - 1;
            }
        });

        increaseButton.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < stock) { // Maximum quantity is the available stock
                quantityInput.value = currentValue + 1;
            }
        });

        addButton.addEventListener('click', () => {

            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle');
            const considebar = document.getElementById('container-sidebar');

            sidebar.classList.remove('sidebar-hidden');
            sidebar.classList.add('sidebar-visible');
            considebar.classList.add('z-20');
            considebar.classList.remove('z-0');
            toggleBtn.classList.remove('toggle-hidden');
            toggleBtn.classList.add('toggle-visible');
            const toggleIcon = toggleBtn.querySelector('img');
            const visibleIcon = toggleBtn.getAttribute('data-visible-icon');
            toggleIcon.src = visibleIcon; // Mengganti src dengan gambar tersembunyi

            const priceElement = document.getElementById('productPrice');
            if (!priceElement) {
                console.error('Elemen priceElement tidak ditemukan.');
                return;
            }
            const pricesatuan = priceElement.getAttribute('price-value-product');

            const productElement = document.getElementById('productTitle');
            if (!productElement) {
                console.error('Elemen productTitle tidak ditemukan.');
                return;
            }
            const productVariantId = productElement.getAttribute('product-variant-id');
            const productVariantName = productElement.innerText;

            const imageElement = document.getElementById('rightImage');
            if (!imageElement) {
                console.error('Elemen rightImage tidak ditemukan.');
                return;
            }
            const productImage = imageElement.getAttribute('src');

            const variantSideLabels = document.querySelectorAll('[id^=type-label-]');
            const variantSideValues = document.querySelectorAll('[id^=type-value-]');

            if (variantSideLabels.length === 0 || variantSideValues.length === 0) {
                console.error('Elemen label atau value varian tidak ditemukan.');
                return;
            }

            let variants = [];

            variantSideValues.forEach((variantSideValue, index) => {
                const variantLabel = variantSideLabels[index];
                const variantValueText = variantSideValue.innerText;
                let variantItemId = null;

                if (variantSideValue.hasAttribute('variant_item_id')) {
                    variantItemId = variantSideValue.getAttribute('variant_item_id');
                }

                variants.push({
                    label: variantLabel.innerText,
                    value: variantValueText,
                    variantItemId: variantItemId
                });
            });

            const qtyElement = document.getElementById('quantity');
            if (!qtyElement) {
                console.error('Elemen quantity tidak ditemukan.');
                return;
            }
            const qty = qtyElement.value;

            function formatRupiah(price) {
                return `Rp. ${price.toLocaleString('id-ID')}`;
            }

            const price = pricesatuan * qty;
            const priceDisplay = formatRupiah(Math.round(price));

            const listOrderContainer = document.querySelector('.list-order-item');
            if (!listOrderContainer) {
                console.error('Error: Element with class "list-order-item" not found.');
                return;
            }

            // Generate HTML baru untuk product order list
            const newProductCard = document.createElement('div');
            newProductCard.setAttribute('value', productVariantId); // Menambahkan data attribute
            newProductCard.classList.add('sidebar-product-card', 'flex', 'items-start', 'justify-between', 'p-3', 'h-1/3', 'w-full', 'bg-[#F4F4F4]', 'rounded-md');

            newProductCard.innerHTML = `
                <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
                <div class="ml-3 space-y-1 flex-1">
                    <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id-${productVariantId}="${productVariantId}" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                        ${productVariantName}
                    </p>
                    <p class="text-[#707070] font-normal text-[12px]">detail:</p>
                    <div id="detail-product-sidebar-${productVariantId}" class="sidebar-list-varaint-label space-y-1">
                        ${variants.map((variant, idx) => `
                            <p id="sidebar-label-type-${idx + 1}" class="sidebar-variant-label text-[12px] font-normal text-[#292929]">${variant.label}:
                                <span id="sidebar-option-type-${idx + 1}" value-sidebar-option-type-${idx + 1}="${variant.variantItemId}">${variant.value}</span>
                            </p>
                        `).join('')}
                    </div>
                    <div class="bg-white w-5/6 p-1 rounded-md">
                        <p class="text-[12px] font-normal ">Total Harga:
                            <span id="price-product-sidebar-${productVariantId}" value-price-product-sidebar-${productVariantId}="${price}" class="text-[12px] font-semibold">${priceDisplay}</span>
                        </p>
                    </div>
                    <div class="flex pr-4 justify-between pt-2 w-full items-center mb-2">
                        <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                            <button id="sidebar-decrease-${productVariantId}" class="p-2 h-full text-gray-700 focus:outline-none">
                                <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                                </svg>
                            </button>
                            <input id="sidebar-quantity-${productVariantId}" type="text" value="${qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" />
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

            // Tambahkan produk baru ke dalam list order container
            listOrderContainer.appendChild(newProductCard);

            // Trigger custom event untuk produk baru
            const event = new CustomEvent('productAdded', {
                detail: {
                    productVariantId: uniqueProductId // Mengirimkan ID unik produk
                }
            });
            document.dispatchEvent(event);

            // Fungsi untuk menghitung total harga dan jumlah item di sidebar
            function updateTotalItemAndPrice() {
                const priceElements = document.querySelectorAll('[id^="price-product-sidebar-"]');
                let totalPrice = 0;
                let totalItems = 0;

                // Hitung total harga dan jumlah item
                priceElements.forEach(priceElement => {
                    const priceValue = parseInt(priceElement.getAttribute('value-price-product-sidebar'));
                    if (!isNaN(priceValue)) {
                        totalPrice += priceValue;
                        totalItems += 1;
                    }
                });

                const totalItemElement = document.getElementById('totalitem');
                const totalPriceElement = document.getElementById('totalprice');
                const jumlahItemElement = document.getElementById('jumlahitem');

                // Pastikan elemen totalitem, totalprice, dan jumlahitem ditemukan
                if (totalItemElement && totalPriceElement && jumlahItemElement) {

                    // Update jumlah item dan total harga
                    totalItemElement.innerText = totalItems; // Update jumlah item
                    totalPriceElement.innerText = totalPrice.toLocaleString('id-ID'); // Update total harga

                    // Hapus kelas hidden jika ada
                    jumlahItemElement.classList.remove('hidden');
                } else {
                    console.error('Elemen totalitem, totalprice, atau jumlahitem tidak ditemukan');
                }
            }

            // Panggil fungsi untuk memperbarui total harga dan jumlah item
            updateTotalItemAndPrice();

            saveDataToSessionStorage();
        });

    }, 1000);
});
