<section name="detail-product" class="py-0 mt-8 z-5">
    <div class="container mx-auto w-full h-full">
        <div class="flex flex-col pt-20 lg:flex-row justify-between space-y-3 lg:space-y-0 lg:space-x-3 max-w-[994px] mx-auto">
             <!-- Left Section (Image and Thumbnails) -->
             <div class="lg:w-3/4 flex flex-col lg:flex-row items-start space-x-3">
                <div class="w-full lg:w-1/3 flex flex-col z-10">
                    <img id="mainImage" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}"

                    alt="Main Product Image" class="w-full h-[241.5px] object-cover mb-2 rounded-lg shadow-lg">
                    <div id="list-image-product" class="flex space-x-2 mr-4 z-10 ">
                        <!-- Thumbnail Images -->
                    </div>
                </div>
                <div class="w-full h-auto lg:w-2/3">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                         <!-- Product Title and Price -->
                         <div class="mb-3">
                            <h1 id="productTitle" product-variant-id="" class="text-[28px] font-bold">Spandek – Spandeck Zincalume</h1>
                            <p id="productPrice" price-value-product="" class="text-[#E01535] text-xl font-semibold rounded-md p-1 bg-[#F4F4F4] mt-2">Rp. 7.000</p>
                        </div>

                        <div id="variantContainer"></div>

                        <!-- Product Description -->
                        <div>
                            <h2 class="text-[12px] font-semibold text-[#E01535] border-b-2 border-[#E01535] pb-1">Tentang Produk</h2>
                            <span id="productDescription" class="text-[#747474] text-[12px] leading-[16.06px] font-normal mt-2">
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section (Product Details) -->
            <div class="lg:w-1/4 flex flex-col space-y-3">
                <!-- Order Summary -->
                <div class="py-4 bg-white rounded-lg shadow-lg">
                    <h3 class="px-4 text-gray-800 text-[14px] font-semibold mb-2">Atur jumlah produk</h3>
                    <div class="px-4 flex items-center space-x-4 mb-4">
                        <img id="rightImage" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Product Thumbnail" class="border-2 border-gray-300 w-[75px] h-[75px] object-cover rounded-lg">
                        <div id="variantSideContainer">

                        </div>
                    </div>
                    <div class="flex px-4 justify-between border-t-[2px] pt-2 w-full items-center mb-2">
                        <div class=" flex items-center border rounded py-1">
                            <button id="decrease" class="p-2 h-full text-gray-700 focus:outline-none">
                                <svg width="13" height="1" viewBox="0 0 13 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="12.1143" y="0.0161133" width="0.943847" height="11.8347" transform="rotate(90 12.1143 0.0161133)" fill="#292929"/>
                                </svg>
                            </button>
                            <input id="quantity" type="text" value="1" class="w-7 text-center border-none focus:outline-none text-gray-800" />
                            <button id="increase" class="px-2 h-full text-gray-700 focus:outline-none">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="12.7861" y="6.01611" width="0.943847" height="11.8347" transform="rotate(90 12.7861 6.01611)" fill="#292929"/>
                                    <rect x="7.34033" y="12.4055" width="0.943847" height="11.8347" transform="rotate(-180 7.34033 12.4055)" fill="#292929"/>
                                </svg>
                            </button>
                        </div>
                        <button id="add" class="px-4 inline-flex items-center bg-[#E01535] text-white px-4 py-1 rounded focus:outline-none">
                            <img src="{{ asset('storage/icons/keranjang.svg') }}" alt="keranjang" class="h-4 w-4 mr-1.5">
                            <span class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left">Add</span>
                        </button>
                    </div>
                    <p class="px-4">Stock: <span id="productStock" class="text-gray-700 font-normal">60</span></p>
                </div>

                <!-- Note Section -->
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <p class="text-gray-800 font-semibold mb-2">Note:</p>
                    <ul class="list-disc list-inside font-normal text-[#747474] text-[12px] space-y-2">
                        <li class="leading-[13.72px]" style="text-indent: -17px; padding-left: 15px;">Harap tanyakan kepada kami mengenai ongkos pengiriman, waktu pengiriman, dan ketersediaan stok barang sebelum bertransaksi.</li>
                        <li class="leading-[13.72px]" style="text-indent: -17px; padding-left: 15px;">Pengiriman dengan armada perusahaan (L-300 / Engel / Double / Long Chassis).</li>
                        <li class="leading-[13.72px]" style="text-indent: -17px; padding-left: 15px;">Khusus pengiriman JABODETABEK, untuk customer luar kota bisa chat terlebih dahulu.</li>
                    </ul>
                    <p class="font-normal leading-[13.72px] text-[#747474] text-[12px] mt-3">
                        Harga sudah termasuk PPN<br>
                        Harga yang tertera adalah harga per batang.
                    </p>
                    <p class="font-normal leading-[13.72px] text-[#747474] text-[12px] mt-3 italic">
                        * Harga tidak mengikat<br>
                        * Tidak menerima retur
                    </p>
                </div>
            </div>
        </div>
    </div>
    <style>
        .gelombang-option.active,
        .tebal-option.active {
            border-color: #E01535;
            color: #E01535;
            background-color: #F9F5F6;
        }

    </style>
    <script>
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
                    console.log("Tombol Add diklik");

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

                    // Tambahkan log untuk memverifikasi elemen dan harga
                    console.log("Harga satuan:", pricesatuan);
                    console.log("Jumlah:", qty);
                    console.log("Harga total:", price);

                    // Generate HTML baru untuk product order list
                    const newProductCard = document.createElement('div');
                    newProductCard.classList.add('sidebar-product-card', 'flex', 'items-start', 'justify-between', 'p-3', 'h-1/3', 'w-full', 'bg-[#F4F4F4]', 'rounded-md');

                    newProductCard.innerHTML = `
                        <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
                        <div class="ml-3 space-y-1 flex-1">
                            <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id-${productVariantId}="" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                                ${productVariantName}
                            </p>
                            <p class="text-[#707070] font-normal text-[12px]">detail:</p>
                            <div id="detail-product-sidebar-${productVariantId}" class="space-y-1">
                                ${variants.map((variant, idx) => `
                                    <p id="sidebar-label-type-${idx + 1}" class="text-[12px] font-normal text-[#292929]">${variant.label}:
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
                                <button class="px-2 inline-flex items-center bg-white text-white py-2 rounded focus:outline-none">
                                    <img src="/storage/icons/sampah.svg" alt="sampah" class="h-4 w-4">
                                    <span id="sidebar-product-deleted-${productVariantId}" class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left"></span>
                                </button>
                            </div>
                        </div>
                    `;

                    // Tambahkan produk baru ke dalam list order container
                    listOrderContainer.appendChild(newProductCard);

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
                            console.log('Total item dan harga akan diperbarui');

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

                    console.log(`Data:`, {
                        productVariantId: productVariantId,
                        productVariantName: productVariantName,
                        productImage: productImage,
                        price: price,
                        priceDisplay: priceDisplay,
                        variants: variants,
                        qty: qty
                    });
                });

            }, 1000);
        });
    </script>
</section>
