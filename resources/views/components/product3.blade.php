<section name="product3" class="py-0 mt-8">
    <div class="parallax-appear">
        <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
            <div id="subproduct3" class="relative w-[1200px] flex items-center justify-between">
                <!-- Bagian Kiri (Produk Spesial) -->
                <div id="special-product" class="relative z-0 shadow-custom w-[325.53px] h-[285.14px] bg-white rounded-md overflow-hidden">
                    <div id="special-product-image"
                        class="absolute inset-0 bg-cover bg-center" 
                        style="background-image: url('{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}');">
                    </div>
                    <div class="relative z-10 p-5">
                        <h2 id="special-product-name" class="text-[16px] mb-2 font-bold text-white uppercase">HOLLOW BESI</h2>
                        <div class="pt-2 special-product-background">
                            <p id="special-product-price" class="rounded-md p-2 w-[122.19px] leading-[28.13px] text-[24px] text-white font-bold">
                                <span class="text-[16px] text-white leading-[16.41px]">Rp.</span > 26.100 <span class="leading-[16.41px] text-[16px] text-white">/meter</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- <div id="special-product" class="relative z-0 shadow-custom w-[325.53px] h-[285.14px] bg-white rounded-md overflow-hidden">
                    <div class="p-5">
                        <h2 id="special-product-name" class="text-[16px] mb-2 font-bold text-[#E01535] uppercase">HOLLOW BESI</h2>
                        <div class="pt-2 special-product-background">
                            <p id="special-product-price" class="rounded-md p-2 w-[122.19px] leading-[28.13px] text-[24px] text-[#000] font-bold">
                                <span class="text-[16px] leading-[16.41px]">Rp.</span> 26.100 <span class="leading-[16.41px] text-[16px]">/meter</span>
                            </p>
                        </div>
                    </div>
                    <div class="-mt-2">
                        <img id="special-product-image" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Hollow Besi" style="rotate: y -180deg;" class="rounded-b-md object-cover w-[213.27px] h-[160px]">
                    </div>
                </div> -->

                <!-- Kartu Produk -->
                <div id="product-list" class=" absolute z-5 flex overflow-x-auto mx-4 px-1 z-5 space-x-3 max-w-[97%]" style="top: 22%;">
                    <!-- Produk akan ditambahkan oleh JavaScript di sini -->
                </div>

                <!-- Link 'View All' -->
                <!-- <div id="view-all-container" class="absolute top-[7%] right-5 flex items-center">
                    <a id="view-all-link" href="#" class="text-[12px] font-semibold text-[#4A4A4A] hover:underline flex items-center">
                        View all (0+)
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div> -->

            </div>
        </div>
    </div>
</section>

<style>
    .special-product-background {
        background-image: url('{{ asset('storage/design/bingkaisulit.svg') }}');
        background-repeat: no-repeat;
    }
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    #product-list {
        padding-bottom: 10px;
        margin-bottom: 10px;
        overflow-x: auto;
        -ms-overflow-style: none; /* Hapus scrollbar default untuk Internet r */
        scrollbar-width: thin; /* Scrollbar yang lebih tipis */
        scrollbar-color: #E01535 #f0f0f0; /* Warna scrollbar */
    }

    /* Scrollbar untuk Webkit (Chrome, Safari, Edge) */
    #product-list::-webkit-scrollbar {
        height: 8px; /* Tinggi scrollbar horizontal */
        z-index: -100;
    }

    #product-list::-webkit-scrollbar-track {
        background: #f0f0f0; /* Warna latar track scrollbar */
        border-radius: 4px; /* Membuat track melengkung */
        z-index: -100;
    }

    #product-list::-webkit-scrollbar-thumb {
        background-color: #E01535; /* Warna scrollbar */
        border-radius: 4px; /* Membuat scrollbar melengkung */
        border: 2px solid #f0f0f0; /* Menambahkan margin di sekitar scrollbar */
    }

    #product-list::-webkit-scrollbar-thumb:hover {
        background-color: #b3122a; /* Warna saat scrollbar di-hover */
    }

    button:focus {
        outline: none;
    }

    #view-all-link,
    .description {
        display: flex;
    }

    button#prev-button-product:hover,
    button#next-button-product:hover {
        background-color: #b3122a; /* Warna saat di-hover */
        transform: scale(1.1); /* Sedikit pembesaran */
        transition: all 0.3s ease-in-out; /* Transisi yang halus */
    }

    @media (max-width: 450px) {
        #view-all-link,
        .description {
            display: none;
        }
        #subproduct3{
            width: 80%;
        }
    }
</style>
