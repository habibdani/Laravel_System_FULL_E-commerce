<section name="detail-product" class="py-0 mt-8 z-5">
    <div class="parallax-appear">
        <div class="container mx-auto w-full h-full">
            <div class="flex flex-col pt-20 lg:flex-row justify-between space-y-3 lg:space-y-0 lg:space-x-3 w-[90%] mx-auto">
                <!-- Left Section (Image and Thumbnails) -->
                <div id="detailproductleft" class="lg:w-3/4 w-full flex image-and-thumbnails flex-col lg:flex-row items-start space-x-3">
                    <div class="w-full lg:w-1/3 flex flex-col z-10 responsive-main-image">
                        <img id="mainImage" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}"

                        alt="Main Product Image" class="w-full h-[241.5px] object-cover mb-2 rounded-lg shadow-lg">
                        <div id="list-image-product" class="flex space-x-2 mb-3 z-10 ">
                            <!-- Thumbnail Images -->
                        </div>
                    </div>
                    <div class="w-full h-auto lg:w-2/3">
                        <div class="bg-white p-4 rounded-lg shadow-lg main-detail-product">
                            <!-- Product Title and Price -->
                            <div class="mb-3">
                                <h1 id="productTitle" product-variant-id="" class="text-[28px] font-bold">...</h1>
                                <p id="productPrice" price-value-product="" class="text-[#E01535] text-xl font-semibold rounded-md p-1 bg-[#F4F4F4] mt-2">...</p>
                            </div>

                            <div id="variantContainer"></div>

                            <!-- Product Description -->
                            <div>
                                <h2 class="text-[12px] font-semibold text-[#E01535] border-b-2 border-[#E01535] pb-1">...</h2>
                                <span id="productDescription" class="text-[#747474] text-[12px] leading-[16.06px] font-normal mt-2">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section (Product Details) -->
                <div class="lg:w-1/4 flex flex-col space-y-3">
                    <!-- Order Summary -->
                    <div class="py-4 bg-white rounded-lg submain-detail-product shadow-lg">
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
                                <input id="quantity" type="number" value="1" min="1" class="w-7 text-center border-none focus:outline-none text-gray-800 no-arrows" />
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
                        <p class="px-4">Stock: <span id="productStock" class="text-gray-700 font-normal"></span></p>
                    </div>

                    <!-- Note Section -->
                    <div class="p-4 bg-white rounded-lg shadow-lg product-note">
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
    </div>
    <style>
        

        .gelombang-option.active,
        .tebal-option.active {
            border-color: #E01535;
            color: #E01535;
            background-color: #F9F5F6;
        }

        @media (max-width: 1023px) {
            .responsive-main-image {
                /* max-width: 90%; */
                width: 90%;
                margin: 0 auto; /* Center the div horizontally */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Sesuaikan juga ukuran gambar utama */
            #mainImage {
                /* max-width: 90%; Ensure image fits within 390px container */
                width: 90%;
                height: auto;
                object-fit: cover;
            }

            #detailproductleft > * {
                margin-right: 0 !important; /* Hilangkan efek space-x-3 (biasanya gap antar elemen) */
                gap: 0 !important; /* Jika menggunakan gap antar flex/grid item */
            }

            /* Thumbnail wrapper agar tidak melewati lebar kontainer */
            #list-image-product {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 8px;
                max-width: 90%;
            }

            .main-detail-product,
            .submain-detail-product {
                width: 90%; /* Atur lebar khusus pada layar kecil */
                margin: 0 auto; /* Center secara horizontal */
            }
            .image-and-thumbnails {
                gap: 0; /* Mengatur jarak horizontal antar-elemen anak ke 0 */
            }

            .product-note {
                width: 90%; /* Atur lebar khusus pada layar kecil */
                margin: 0 auto; /* Center secara horizontal */
            }

            input[type="number"].no-arrows::-webkit-inner-spin-button,
            input[type="number"].no-arrows::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Hilangkan spinner di Firefox */
            input[type="number"].no-arrows {
                -moz-appearance: textfield; /* Firefox */
                appearance: textfield; /* Browser modern lainnya */
            }
        }
    </style>

    <script> // script khusu responsive
        function handleResponsiveClasses() {
            const element = document.querySelector('.image-and-thumbnails');
            if (window.innerWidth <= 1023) {
                element.classList.remove('space-x-3');
            } else {
                element.classList.add('space-x-3');
            }
        }

        // Jalankan fungsi saat halaman dimuat dan ketika ukuran layar berubah
        window.addEventListener('load', handleResponsiveClasses);
        window.addEventListener('resize', handleResponsiveClasses);
    </script>
    @vite('resources/js/productDetails-script.js')
</section>
