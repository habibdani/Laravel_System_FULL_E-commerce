<section name="product3" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="relative w-[994px] flex items-center justify-between">
            <!-- Bagian Kiri (Produk Spesial) -->
            <div id="special-product" class="relative z-0 shadow-custom w-[325.53px] h-[285.14px] bg-white rounded-md overflow-hidden">
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
            </div>

            <!-- Kartu Produk -->
            <div id="product-list" class=" absolute z-5 flex overflow-x-auto mx-4 px-1 z-5 space-x-3 max-w-[97%]" style="top: 22%;">
                <!-- Produk akan ditambahkan oleh JavaScript di sini -->
            </div>

             <!-- Link 'View All' -->
             <div id="view-all-container" class="absolute top-[7%] right-5 flex items-center">
                <a id="view-all-link" href="#" class="text-[12px] font-semibold text-[#4A4A4A] hover:underline flex items-center">
                    View all (0+)
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
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
        padding-bottom: 10px;  /* Adjust as needed */
        margin-bottom: 10px;  /* Adjust as needed */
        overflow-x: auto;  /* Still allows scrolling if necessary */
        -ms-overflow-style: none;  /* IE 10+ */
        scrollbar-width: none;  /* Firefox */
    }

    #product-list::-webkit-scrollbar {
        display: none;  /* Safari and Chrome */
    }
</style>
