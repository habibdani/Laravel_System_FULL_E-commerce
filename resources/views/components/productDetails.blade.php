<section name="detail-product" class="py-0 mt-8">
    <div class="container mx-auto w-full h-full">
        <div class="flex flex-col lg:flex-row justify-between space-y-3 lg:space-y-0 lg:space-x-3 max-w-[994px] mx-auto">
            <!-- Left Section (Image and Thumbnails) -->
            <div class="lg:w-3/4 flex flex-col lg:flex-row items-start space-x-3">
                <div class="w-full lg:w-1/3 flex flex-col">
                    <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Main Product Image" class="w-full h-[241.5px] object-cover mb-2 rounded-lg shadow-lg">
                    <div class="flex space-x-2 mr-4">
                        <!-- Thumbnail Images -->
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 1" class="w-1/3 h-[75px] object-cover border-2 border-red-500 rounded-lg cursor-pointer">
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 2" class="w-1/3 h-[75px] object-cover border-2 border-gray-300 rounded-lg cursor-pointer">
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Thumbnail 3" class="w-1/3 h-[75px] object-cover border-2 border-gray-300 rounded-lg cursor-pointer">
                    </div>
                </div>
                <div class="w-full lg:w-2/3">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <!-- Product Title and Price -->
                        <div>
                            <h1 class="text-2xl font-bold">Spandek – Spandeck Zincalume</h1>
                            <p class="text-red-500 text-xl font-semibold mt-2">Rp. 7.000</p>
                        </div>

                        <!-- Product Options -->
                        <div>
                            <p class="text-gray-600 font-semibold">Tipe Gelombang</p>
                            <p class="text-white bg-red-500 px-2 py-1 rounded inline-block mt-1">Tipe 1040</p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Tebal</p>
                            <div class="flex space-x-2 mt-2">
                                <!-- Options with different thickness -->
                                <button class="px-3 py-1 bg-white border-2 border-gray-300 rounded hover:bg-red-500 hover:text-white">0.20mm</button>
                                <button class="px-3 py-1 bg-white border-2 border-gray-300 rounded hover:bg-red-500 hover:text-white">0.25mm</button>
                                <button class="px-3 py-1 bg-white border-2 border-gray-300 rounded hover:bg-red-500 hover:text-white">0.30mm</button>
                            </div>
                        </div>

                        <!-- Product Description -->
                        <div>
                            <h2 class="text-xl font-semibold text-red-500 border-b-2 border-red-500 pb-1">Tentang Produk</h2>
                            <p class="text-gray-700 mt-2">
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
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <h3 class="text-gray-800 font-semibold mb-2">Atur jumlah produk</h3>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Product Thumbnail" class="border-2 border-gray-300 w-16 h-16 object-cover rounded-lg">
                        <div>
                            <p class="text-gray-600">Tipe Gelombang:</p>
                            <p class="text-gray-800 font-semibold">Tipe 1040</p>
                            <p class="text-gray-600">Tebal:</p>
                            <p class="text-gray-800 font-semibold">0.20 mm</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 mb-4">
                        <button class="px-2 py-1 bg-gray-300 rounded">-</button>
                        <input type="text" value="50" class="w-12 text-center border rounded" />
                        <button class="px-2 py-1 bg-gray-300 rounded">+</button>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p>Stok: <span class="text-gray-700">60</span></p>
                        <button class="px-4 py-2 bg-red-500 text-white rounded">Add</button>
                    </div>
                </div>

                <!-- Note Section -->
                <div class="p-4 bg-white rounded-lg shadow-lg">
                    <p class="text-gray-800 font-semibold mb-2">Note:</p>
                    <ul class="list-disc list-inside font-normal text-[#747474] text-[12px] space-y-2">
                        <li>Harap Tanyakan ke Kami Mengenai Ongkos Pengiriman, Waktu Pengiriman, dan Ketersediaan Stock Barang Sebelum Bertransaksi.</li>
                        <li>Pengiriman Dengan Armada Perusahaan (L-300 / Engel / Double / Long Chassis).</li>
                        <li>Khusus Pengiriman JABODETABEK, Untuk Customer Luar Kota bisa Chat dulu.</li>
                    </ul>
                    <p class="text-gray-600 text-sm mt-4">
                        Harga Sudah Termasuk PPN<br>
                        Harga Yang Tertera adalah Harga per Batang
                    </p>
                    <p class="text-gray-600 text-sm mt-4 italic">
                        * Harga Tidak Mengikat<br>
                        * Tidak Menerima Retur
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
