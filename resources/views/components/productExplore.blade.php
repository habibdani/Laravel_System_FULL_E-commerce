<section name="explore-product" id="sessionproductexplore" class="py-0 mt-8">
        <div class="parallax-appear flex flex-col items-center justify-center mx-auto w-full h-full">
            <div id="subsessionproductexplore" class="relative w-[1300px] flex items-center justify-between">
                <!-- Bagian Kiri (Produk Explore) -->
                <div id="explore-product" class="relative z-0 shadow-custom w-full h-[306.83px] bg-white rounded-md overflow-hidden">
                    <div class="p-5">
                        <h2 id="explore-product-name" class="text-[22px] font-bold text-black">Explore Exclusive Deals Now</h2>
                        <span class="text-[12px] explore-description font-normal text-[#747474]">Bestselling products: curated favorites for style, function, and satisfaction</span>
                    </div>
                </div>

                <!-- Kartu Produk -->
                <div id="explore-product-list" class="absolute mx-4 px-1 z-5 flex overflow-x-auto space-x-3 max-w-[97%]" style="top: 30%;">
                    <!-- Produk akan ditambahkan oleh JavaScript di sini -->
                </div>

                <!-- Link 'View All' dan Tombol Navigasi -->
                <div id="view-all-container" class="absolute top-[13%] right-5 flex items-center space-x-3">
                    <!-- Link 'View All' -->
                    <!-- <a id="explore-view-all-link" href="#" class="text-[12px] font-semibold text-[#4A4A4A] hover:underline flex items-center">
                        View all (0+)
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4L10 8L6 12" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a> -->

                    <!-- Tombol Prev -->
                    <button id="prev-button-product-explore" class="bg-[#E8E8E8] p-2 rounded-full shadow-custom">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 12L6 8L10 4" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <!-- Tombol Next -->
                    <button id="next-button-product-explore" class="bg-[#E01535] p-2 rounded-full shadow-custom">
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

    #explore-product-list {
        padding-bottom: 10px;
        margin-bottom: 10px;
        overflow-x: auto;
        -ms-overflow-style: none; /* Hapus scrollbar default untuk Internet Explorer */
        scrollbar-width: thin; /* Scrollbar yang lebih tipis */
        scrollbar-color: #E01535 #f0f0f0; /* Warna scrollbar */
    }

    /* Scrollbar untuk Webkit (Chrome, Safari, Edge) */
    #explore-product-list::-webkit-scrollbar {
        height: 8px; /* Tinggi scrollbar horizontal */
    }

    #explore-product-list::-webkit-scrollbar-track {
        background: #f0f0f0; /* Warna latar track scrollbar */
        border-radius: 4px; /* Membuat track melengkung */
    }

    #explore-product-list::-webkit-scrollbar-thumb {
        background-color: #E01535; /* Warna scrollbar */
        border-radius: 4px; /* Membuat scrollbar melengkung */
        border: 2px solid #f0f0f0; /* Menambahkan margin di sekitar scrollbar */
    }

    #explore-product-list::-webkit-scrollbar-thumb:hover {
        background-color: #b3122a; /* Warna saat scrollbar di-hover */
    }

    button:focus {
        outline: none;
    }

    #explore-view-all-link,
    .explore-description {
        display: flex;
    }

    button#prev-button-product-explore:hover,
    button#next-button-product-explore:hover {
        background-color: #b3122a; /* Warna saat di-hover */
        transform: scale(1.1); /* Sedikit pembesaran */
        transition: all 0.3s ease-in-out; /* Transisi yang halus */
    }

    @media (max-width: 450px) {
        #explore-view-all-link,
        .explore-description {
            display: none;
        }
        #subsessionproductexplore {
            width: 80%; /* Ubah lebar menjadi 80% pada layar dengan lebar maksimum 450px */
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const exploreProductList = document.getElementById('explore-product-list');
        const prevButton = document.getElementById('prev-button-product-explore');
        const nextButton = document.getElementById('next-button-product-explore');

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
