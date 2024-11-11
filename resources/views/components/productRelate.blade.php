<section name="relate-product" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="relative w-[994px] flex items-center justify-between">
            <!-- Bagian Kiri (Produk Spesial) -->
            <div id="relate-product" class="relative z-0 shadow-custom w-full h-[285.14px] bg-white rounded-md overflow-hidden">
                <div class="p-5">
                    <h2 id="relate-product-name" class="text-[22px] mb-2 font-bold text-black ">Relate Product</h2>
                </div>
            </div>

            <!-- Kartu Produk -->
            <div id="relate-product-list" class=" absolute mx-4 px-1 z-5 flex overflow-x-auto space-x-3 max-w-[97%]" style="top: 25%;">
                <!-- Produk akan ditambahkan oleh JavaScript di sini -->
            </div>

             <!-- Link 'View All' -->
             <div id="view-all-container" class="absolute top-[10%] right-5 flex items-center space-x-3">
                <a id="relate-view-all-link" href="#" class="text-[12px] font-semibold text-[#4A4A4A] hover:underline flex items-center">
                    View all (0+)
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <!-- Tombol Prev -->
                <button id="prev-button-product-relate" class="bg-[#E8E8E8] p-2 rounded-full shadow-custom">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Tombol Next -->
                <button id="next-button-product-relate" class="bg-[#E01535] p-2 rounded-full shadow-custom">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<style>

    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    #relate-view-all-link {
        padding-bottom: 10px;  /* Adjust as needed */
        margin-bottom: 10px;  /* Adjust as needed */
        overflow-x: auto;  /* Still allows scrolling if necessary */
        -ms-overflow-style: none;  /* IE 10+ */
        scrollbar-width: none;  /* Firefox */
    }

    #relate-view-all-link::-webkit-scrollbar {
        display: none;  /* Safari and Chrome */
    }
    #relate-view-all-link {
        display: flex;
    }

    @media (max-width: 428px) {
        #relate-view-all-link {
            display: none;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const exploreProductList = document.getElementById('relate-product-list');
        const prevButton = document.getElementById('prev-button-product-relate');
        const nextButton = document.getElementById('next-button-product-relate');

        function getCardWidth() {
            // Ambil elemen kartu produk pertama untuk menghitung lebar satu kartu, termasuk margin
            const firstCard = exploreProductList.querySelector('div');
            if (firstCard) {
                const cardStyle = getComputedStyle(firstCard);
                const cardWidth = firstCard.offsetWidth + parseFloat(cardStyle.marginRight);
                return cardWidth;
            }
            console.log('No card found');
            return 0;
        }

        prevButton.addEventListener('click', () => {
            const cardWidth = getCardWidth();
            if (cardWidth > 0) {
                exploreProductList.scrollBy({
                    left: -(cardWidth * 6),
                    behavior: 'smooth'
                });
            }
        });

        nextButton.addEventListener('click', () => {
            const cardWidth = getCardWidth();
            if (cardWidth > 0) {
                exploreProductList.scrollBy({
                    left: cardWidth * 6,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
