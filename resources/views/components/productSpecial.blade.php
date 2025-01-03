<section name="special-product" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="relative w-[994px] flex items-center justify-between">
            <!-- Bagian Kiri (Produk Spesial) -->
            <div id="special-product" class="relative z-0 shadow-custom w-full h-[285.14px] bg-white rounded-md overflow-hidden">
                <div class="p-5">
                    <h2 id="special-product-name" class="text-[22px] mb-2 font-bold text-black ">Special For You</h2>
                </div>
            </div>

            <!-- Kartu Produk -->
            <div id="special-product-list" class=" absolute mx-4 px-1 z-5 flex overflow-x-auto space-x-3 max-w-[97%]" style="top: 25%;">
                <!-- Produk akan ditambahkan oleh JavaScript di sini -->
            </div>

             <!-- Link 'View All' -->
             <div id="view-all-container" class="absolute top-[10%] right-5 flex items-center space-x-3">
                <a id="special-view-all-link" href="#" class="text-[12px] font-semibold text-[#4A4A4A] hover:underline flex items-center">
                    View all (0+)
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <!-- Tombol Prev -->
                <button id="prev-button-product-special" class="bg-[#E8E8E8] p-2 rounded-full shadow-custom ">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <!-- Tombol Next -->
                <button id="next-button-product-special" class="bg-[#E01535] p-2 rounded-full shadow-custom ">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<style>

    #special-view-all-link {
        display: flex;
    }

    @media (max-width: 428px) {
        #special-view-all-link {
            display: none;
        }
    }
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    #special-product-list {
        padding-bottom: 10px;  /* Adjust as needed */
        margin-bottom: 10px;  /* Adjust as needed */
        overflow-x: auto;  /* Still allows scrolling if necessary */
        -ms-overflow-style: none;  /* IE 10+ */
        scrollbar-width: none;  /* Firefox */
    }

    #special-product-list::-webkit-scrollbar {
        display: none;  /* Safari and Chrome */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const exploreProductList = document.getElementById('special-product-list');
        const prevButton = document.getElementById('prev-button-product-special');
        const nextButton = document.getElementById('next-button-product-special');

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
