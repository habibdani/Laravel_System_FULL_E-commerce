<section name="detail-product" class="hidden py-0 mt-8">
    <div class="container mx-auto w-full h-full">
        <div class="flex flex-col lg:flex-row justify-between space-y-3 lg:space-y-0 lg:space-x-3 max-w-[994px] mx-auto">
            <!-- Left Section (Image and Thumbnails) -->
            <div class="lg:w-3/4 flex flex-col lg:flex-row items-start space-x-3">
                <div class="w-full lg:w-1/3 flex flex-col">
                    <img id="mainImage" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Main Product Image" class="w-full h-[241.5px] object-cover mb-2 rounded-lg shadow-lg">
                    <div class="flex space-x-2 mr-4 z-1">
                        <!-- Thumbnail Images -->
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 1" class="thumbnail w-[75px] h-[75px] object-cover border-2 border-gray-300 rounded-lg cursor-pointer">
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 2" class="thumbnail w-[75px] h-[75px] object-cover border-2 border-gray-300 rounded-lg cursor-pointer">
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 3" class="thumbnail w-[75px] h-[75px] object-cover border-2 border-gray-300 rounded-lg cursor-pointer">
                    </div>
                </div>
                <div class="w-full lg:w-2/3">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <!-- Product Title and Price -->
                        <div class="mb-3">
                            <h1 class="text-[28px] font-bold">Spandek – Spandeck Zincalume</h1>
                            <p class="text-[#E01535] text-xl font-semibold rounded-md p-1 bg-[#F4F4F4] mt-2" normal-price-product="7000">Rp. 7.000</p>
                        </div>

                        <!-- Product Options -->
                        <div class="mb-3">
                            <p id="gelombang-main" class="text-gray-600 text-[12px] font-semibold">Tipe Gelombang:</p>
                            <div class="flex space-x-2 mt-1">
                                <button price-tipe="1000" class="gelombang-option px-3 py-1 bg-white border-2 border-[#747474] text-[#747474] rounded hover:border-[#E01535] hover:text-[#E01535] hover:bg-[#F9F5F6]">Tipe 1040</button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <p id="tebal-main" class="text-gray-600 text-[12px] font-semibold">Tebal:</p>
                            <div class="flex space-x-2 mt-1">
                                <button price-variant-tipe="200" class="tebal-option px-3 py-1 bg-white border-2 border-[#747474] text-[#747474] rounded hover:border-[#E01535] hover:text-[#E01535] hover:bg-[#F9F5F6]">0.20mm</button>
                                <button price-variant-tipe="300" class="tebal-option px-3 py-1 bg-white border-2 border-[#747474] text-[#747474] rounded hover:border-[#E01535] hover:text-[#E01535] hover:bg-[#F9F5F6]">0.25mm</button>
                                <button price-variant-tipe="400" class="tebal-option px-3 py-1 bg-white border-2 border-[#747474] text-[#747474] rounded hover:border-[#E01535] hover:text-[#E01535] hover:bg-[#F9F5F6]">0.30mm</button>
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div>
                            <h2 class="text-[12px] font-semibold text-[#E01535] border-b-2 border-[#E01535] pb-1">Tentang Produk</h2>
                            <p class="text-[#747474] text-[12px] leading-[16.06px] font-normal mt-2">
                                Pipa Besi 1” <br>
                                Panjang: 6 Meter (Toleransi tebal +- 0.2mm) <br>
                                untuk pipa asli toleransi +- 10% <br>
                                light sni 2.6mm <br>
                                med sni 3.2mm <br>
                                welded sch40 3.4mm <br>
                                seamless sch40 3.4mm
                            </p>
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
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Product Thumbnail" class="border-2 border-gray-300 w-[75px] h-[75px] object-cover rounded-lg">
                        <div>
                            <p id="gelombang-label" class="text-gray-600 text-[12px]"></p>
                            <p id="gelombang-value" class="text-gray-800 font-semibold mb-2 text-[12px]">-</p>
                            <p id="tebal-label" class="text-gray-600 text-[12px]"></p>
                            <p id="tebal-value" class="text-gray-800 font-semibold text-[12px]">-</p>
                        </div>
                    </div>
                    <div class="flex px-4 justify-between border-t-[2px] pt-2 w-full items-center mb-2">
                        <div class=" flex items-center border rounded py-1">
                            <button id="decrease" class="px-2 text-gray-700 focus:outline-none"><svg width="13" height="1" viewBox="0 0 13 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="12.1143" y="0.0161133" width="0.943847" height="11.8347" transform="rotate(90 12.1143 0.0161133)" fill="#292929"/>
                                </svg>
                                </button>
                            <input id="quantity" type="text" value="1" class="w-7 text-center border-none focus:outline-none text-gray-800" />
                            <button id="increase" class="px-2 text-gray-700 focus:outline-none"><svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="12.7861" y="6.01611" width="0.943847" height="11.8347" transform="rotate(90 12.7861 6.01611)" fill="#292929"/>
                                <rect x="7.34033" y="12.4055" width="0.943847" height="11.8347" transform="rotate(-180 7.34033 12.4055)" fill="#292929"/>
                                </svg>
                                </button>
                        </div>
                        <a class="px-4 inline-flex items-center bg-[#E01535] text-white px-4 py-1 rounded focus:outline-none">
                            <img src="{{ asset('storage/icons/keranjang.svg') }}" alt="keranjang" class="h-4 w-4 mr-1.5">
                            <span id="add" class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left">Add</span>
                        </a>
                    </div>
                    <p class="px-4 text-[12px] font-normal text-gray-600">Stok: <span class="text-gray-700 font-normal" id="stock">60</span></p>
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
            const quantityInput = document.getElementById('quantity');
            const decreaseButton = document.getElementById('decrease');
            const increaseButton = document.getElementById('increase');
            const addButton = document.getElementById('add');
            const stock = parseInt(document.getElementById('stock').innerText);
            const gelombangValueMain = document.getElementById('gelombang-main');
            const gelombangValueSide = document.getElementById('gelombang-value');
            const gelombangValueLabel = document.getElementById('gelombang-label');
            const tebalValueMain = document.getElementById('tebal-main');
            const tebalValueSide = document.getElementById('tebal-value');
            const tebalValueLabel = document.getElementById('tebal-label');
            const mainImage = document.getElementById('mainImage');
            const priceElement = document.querySelector('[normal-price-product]');
            let basePrice = parseInt(priceElement.getAttribute('normal-price-product'));

            let selectedGelombangPrice = 0;
            let selectedTebalPrice = 0;

            // Function to update the displayed price
            function updatePrice() {
                const totalPrice = basePrice + selectedGelombangPrice + selectedTebalPrice;
                priceElement.textContent = `Rp. ${totalPrice.toLocaleString()}`;
            }

            // Sinkronisasi teks Tipe Gelombang dan Tebal dari kartu utama ke bagian Atur jumlah produk
            if (gelombangValueMain && gelombangValueLabel) {
                gelombangValueLabel.textContent = gelombangValueMain.textContent;
            }

            if (tebalValueMain && tebalValueLabel) {
                tebalValueLabel.textContent = tebalValueMain.textContent;
            }

            // Event listeners for Gelombang buttons
            const gelombangButtons = document.querySelectorAll('.gelombang-option');
            gelombangButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Hapus kelas aktif dari semua tombol
                    gelombangButtons.forEach(btn => btn.classList.remove('active'));

                    // Tambahkan kelas aktif ke tombol yang diklik
                    button.classList.add('active');

                    // Ganti teks Tipe Gelombang di bagian Atur jumlah produk
                    gelombangValueSide.textContent = button.textContent;

                    // Update harga berdasarkan tipe gelombang yang dipilih
                    selectedGelombangPrice = parseInt(button.getAttribute('price-tipe')) || 0;

                    // Update harga total
                    updatePrice();
                });
            });

            // Event listeners for Tebal buttons
            const tebalButtons = document.querySelectorAll('.tebal-option');
            tebalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Hapus kelas aktif dari semua tombol
                    tebalButtons.forEach(btn => btn.classList.remove('active'));

                    // Tambahkan kelas aktif ke tombol yang diklik
                    button.classList.add('active');

                    // Ganti teks Tebal di bagian Atur jumlah produk
                    tebalValueSide.textContent = button.textContent;

                    // Update harga berdasarkan varian tebal yang dipilih
                    selectedTebalPrice = parseInt(button.getAttribute('price-variant-tipe')) || 0;

                    // Update harga total
                    updatePrice();
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
                const quantity = parseInt(quantityInput.value);
                alert(`You have added ${quantity} items to your cart.`);
            });
        });
    </script>
</section>
