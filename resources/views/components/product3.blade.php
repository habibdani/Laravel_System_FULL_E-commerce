<section name="product3" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="relative w-[994px] flex items-center justify-between">
            <!-- Bagian Kiri (Produk Spesial) -->
            <div id="special-product" class="relative z-0 shadow-custom w-[213.27px] h-[285.14px] bg-white rounded-md overflow-hidden">
                <div class="p-4">
                    <h2 id="special-product-name" class="text-[16px] mb-1 font-bold text-[#E01535] uppercase">HOLLOW BESI</h2>
                    <div class="p-1" style="background-image: url('{{ asset('storage/design/bingkaisulit.svg') }}');">
                        <p id="special-product-price" class="rounded-md p-2 w-[122.19px] leading-[28.13px] text-[24px] text-[#000] font-bold">
                            <span class="text-[16px] leading-[16.41px]">Rp.</span> 26.100 <span class="leading-[16.41px] text-[16px]">/meter</span>
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <img id="special-product-image" src="{{ asset('storage/images/e85ec02d42912480eefa75c5e42cf14a.jpeg') }}" alt="Hollow Besi" style="rotate: y -180deg;" class="rounded-b-md object-cover w-full h-[160px]">
                </div>
            </div>

            <!-- Kartu Produk -->
            <div id="product-list" class="absolute left-[230px] z-5 flex overflow-x-auto space-x-4 max-w-[764px]">
                <!-- Produk akan ditambahkan oleh JavaScript di sini -->
            </div>

            <!-- Link 'View All' -->
            <!-- Uncomment and use if needed -->
            <!-- <div class="flex items-center justify-end w-[100px]">
                <a href="#" class="text-[12px] font-bold text-[#4A4A4A] hover:underline">View all (3+)</a>
            </div> -->
        </div>
    </div>
</section>

<style>
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
