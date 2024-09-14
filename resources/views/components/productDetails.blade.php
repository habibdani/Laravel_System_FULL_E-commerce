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
    @vite('resources/js/productDetails-script.js')
</section>
