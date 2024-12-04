<section name="filproductid-product" id="sessionproductfilproductid" class="py-0 mt-8">
    <div class="parallax-appear">
        <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
            <div id="subsessionproductfilproductid" class="relative w-[1200px] mt-[100px] flex items-center justify-between">
                <!-- Bagian Kiri (Produk filproductid) -->
                <div id="filproductid-product" class="relative z-0 shadow-custom w-full h-[306.83px] bg-white rounded-md overflow-hidden">
                    <div class="p-5">
                        <h2 id="filproductidProductName" class="text-[22px] font-bold text-black"></h2>
                        <span class="text-[12px] filproductid-description font-normal text-[#747474]">Bestproduct products for u</span>
                    </div>
                </div>

                <!-- Kartu Produk -->
                <div id="filproductid-product-list" class="absolute mx-4 px-1 z-5 flex overflow-x-auto space-x-3 max-w-[97%]" style="top: 30%;">
                    <!-- Produk akan ditambahkan oleh JavaScript di sini -->
                </div>

                <!-- Link 'View All' dan Tombol Navigasi -->
                <div id="view-all-container" class="absolute top-[13%] right-5 flex items-center space-x-3">
                    <!-- Link 'View All' -->

                    <!-- Tombol Prev -->
                    <button id="prev-button-product-filproductid" class="bg-[#E8E8E8] p-2 rounded-full shadow-custom">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 12L6 8L10 4" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <!-- Tombol Next -->
                    <button id="next-button-product-filproductid" class="bg-[#E01535] p-2 rounded-full shadow-custom">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    #filproductid-product-list {
        padding-bottom: 10px;
        margin-bottom: 10px;
        overflow-x: auto;
        -ms-overflow-style: none; /* Hapus scrollbar default untuk Internet Explorer */
        scrollbar-width: thin; /* Scrollbar yang lebih tipis */
        scrollbar-color: #E01535 #f0f0f0; /* Warna scrollbar */
    }

    /* Scrollbar untuk Webkit (Chrome, Safari, Edge) */
    #filproductid-product-list::-webkit-scrollbar {
        height: 8px; /* Tinggi scrollbar horizontal */
    }

    #filproductid-product-list::-webkit-scrollbar-track {
        background: #f0f0f0; /* Warna latar track scrollbar */
        border-radius: 4px; /* Membuat track melengkung */
    }

    #filproductid-product-list::-webkit-scrollbar-thumb {
        background-color: #E01535; /* Warna scrollbar */
        border-radius: 4px; /* Membuat scrollbar melengkung */
        border: 2px solid #f0f0f0; /* Menambahkan margin di sekitar scrollbar */
    }

    #filproductid-product-list::-webkit-scrollbar-thumb:hover {
        background-color: #b3122a; /* Warna saat scrollbar di-hover */
    }

    button:focus {
        outline: none;
    }

    #filproductid-view-all-link,
    .filproductid-description {
        display: flex;
    }

    button#prev-button-product-filproductid:hover,
    button#next-button-product-filproductid:hover {
        background-color: #b3122a; /* Warna saat di-hover */
        transform: scale(1.1); /* Sedikit pembesaran */
        transition: all 0.3s ease-in-out; /* Transisi yang halus */
    }

    @media (max-width: 450px) {
        #filproductid-view-all-link,
        .filproductid-description {
            display: none;
        }
        #subsessionproductfilproductid {
            width: 80%; /* Ubah lebar menjadi 80% pada layar dengan lebar maksimum 450px */
        }
    }
</style>
<script>

    function showSlide(slideNumber) {
        document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
        document.getElementById('slide-' + slideNumber).classList.remove('hidden');

        document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
            btn.classList.remove('text-white', 'bg-[#E01535]');
            btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
        });

        document.getElementById('btn-slide-' + slideNumber).classList.add('text-white', 'bg-[#E01535]');
        document.getElementById('btn-slide-' + slideNumber).classList.remove('text-[#9D9D9D]', 'bg-transparent');
    }

    window.addEventListener('load', function() {
        showSlide(2);
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.add('sidebar-hidden');
        sidebar.classList.remove('sidebar-visible');

        const toggleBtn = document.getElementById('toggle');
        toggleBtn.classList.add('toggle-hidden');
        toggleBtn.classList.remove('toggle-visible');

        const toggleIcon = toggleBtn.querySelector('img');
        const hiddenIcon = toggleBtn.getAttribute('data-hidden-icon');
        toggleIcon.src = hiddenIcon; // Mengganti src dengan gambar tersembunyi

        const btnSlide2 = document.getElementById('btn-slide-2');
        btnSlide2.classList.add('text-white', 'bg-[#E01535]');
        btnSlide2.classList.remove('text-[#9D9D9D]', 'bg-transparent');

        const considebar = document.getElementById('container-sidebar')
        considebar.classList.add('z-20');
        considebar.classList.remove('z-20');

        const button2 = document.getElementById('btn-slide-2');
        button2.removeAttribute('disabled');

        const jumlahitem = document.getElementById('jumlahitem');
        jumlahitem.classList.remove('hidden');

        // const toslide2andshop = document.getElementById('to-slide-2-and-shop');
        // toslide2andshop.classList.add('hidden');

        const totalbayar = document.getElementById('totalbayar');
        totalbayar.classList.remove('hidden');

    });

    document.addEventListener('DOMContentLoaded', () => {
        const filproductidProductList = document.getElementById('filproductid-product-list');
        const prevButton = document.getElementById('prev-button-product-filproductid');
        const nextButton = document.getElementById('next-button-product-filproductid');

        // Event Listener Tombol Navigasi
        function addNavigationListeners() {
            const cardWidth = getCardWidth();

            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    if (cardWidth > 0) {
                        filproductidProductList.scrollBy({
                            left: -(cardWidth * 6),
                            behavior: 'smooth',
                        });
                    }
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    if (cardWidth > 0) {
                        filproductidProductList.scrollBy({
                            left: cardWidth * 6,
                            behavior: 'smooth',
                        });
                    }
                });
            }
        }

        // Ambil lebar kartu
        function getCardWidth() {
            const firstCard = filproductidProductList.querySelector('.product-card');
            if (firstCard) {
                const cardStyle = getComputedStyle(firstCard);
                return firstCard.offsetWidth + parseFloat(cardStyle.marginRight);
            }
            return 0;
        }

        // Fetch Data Produk dari API
        async function fetchfillterbyproductid(productId) {
            try {
                const response = await fetch(`/api/list-products?Product_id=${encodeURIComponent(productId)}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const result = await response.json();
                return result.data.original;
            } catch (error) {
                console.error('Error fetching products:', error);
                throw error;
            }
        }

        // Render Produk ke Halaman
        async function renderFilterProducts(productId) {
            try {
                const products = await fetchfillterbyproductid(productId);

                if (!products || products.length === 0) {
                    console.warn('No products found for the specified Product ID.');
                    return;
                }

                const productList = filproductidProductList;
                productList.innerHTML = ''; // Bersihkan daftar produk sebelumnya

                products.forEach((product) => {
                    const productCard = createProductCard(product);
                    productList.appendChild(productCard);
                });

                console.log('Products rendered successfully:', products);
            } catch (error) {
                console.error('Error rendering products:', error);
            }
        }

        // Membuat Kartu Produk
        function createProductCard(product) {
            const productCard = document.createElement('div');

            productCard.setAttribute('data-product-id', product.product_id);
            productCard.setAttribute('product-type-id', product.product_type_id);
            productCard.setAttribute('product-variant-id', product.product_variant_id);

            const form = document.createElement('form');
            form.method = 'GET';
            form.action = `/view-product`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;

            const productVariantInput = document.createElement('input');
            productVariantInput.type = 'hidden';
            productVariantInput.name = 'product_variant_id';
            productVariantInput.value = product.product_variant_id;

            const productTypeInput = document.createElement('input');
            productTypeInput.type = 'hidden';
            productTypeInput.name = 'product_type_id';
            productTypeInput.value = product.product_type_id;

            form.appendChild(csrfInput);
            form.appendChild(productVariantInput);
            form.appendChild(productTypeInput);

            productCard.classList.add(
                'product-card',
                'shadow-custom',
                'h-[186.83px]',
                'bg-white',
                'rounded-md',
                'flex',
                'flex-col',
                'justify-between',
                'overflow-hidden'
            );
            productCard.style.width = '149.74px';
            productCard.style.flexShrink = '0';
            productCard.style.position = 'relative';

            // Gambar Produk
            const productImageContainer = document.createElement('div');
            productImageContainer.classList.add(
                'relative', 
                'w-full', 
                'h-[100px]', 
                'mb-2', 
                'rounded-t-md', 
                'overflow-hidden'
            );

            const productImage = document.createElement('img');
            productImage.src = `${window.location.origin}/storage/${product.variant_image}`;
            productImage.alt = product.variant_name;
            productImage.classList.add('object-cover', 'w-full', 'h-full');
            productImageContainer.appendChild(productImage);

            if (product.preorder) {
                const preorderLabel = document.createElement('span');
                preorderLabel.textContent = 'Preorder';
                preorderLabel.classList.add(
                    'bg-black',
                    'text-white',
                    'font-poppins',
                    'text-[10px]',
                    'font-normal',
                    'px-2',
                    'py-1',
                    'rounded',
                    'absolute',
                    'bottom-2',
                    'left-2'
                );
                preorderLabel.style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
                productImageContainer.appendChild(preorderLabel);
            }

            // Nama Produk
            const productName = document.createElement('p');
            productName.textContent = product.variant_name;
            productName.classList.add('font-normal', 'text-[#747474]', 'text-left', 'truncate', 'text-[10px]', 'mx-2');
            productName.style.width = '100%';
            productName.style.whiteSpace = 'nowrap';
            productName.style.overflow = 'hidden';
            productName.style.textOverflow = 'ellipsis';

            // Harga Produk
            const productPrice = document.createElement('p');
            productPrice.textContent = `Rp. ${new Intl.NumberFormat('id-ID').format(product.variant_price)}`;
            productPrice.classList.add('text-[14px]', 'text-left', 'font-semibold', 'text-[#292929]', 'm-2');
            productPrice.style.width = '100%';
            productPrice.style.whiteSpace = 'nowrap';
            productPrice.style.overflow = 'hidden';
            productPrice.style.textOverflow = 'ellipsis';

            // Rangkai Card
            productCard.appendChild(productImageContainer);
            productCard.appendChild(productName);
            productCard.appendChild(productPrice);

            form.appendChild(productCard);

            document.body.appendChild(form);

            // Event listener for product card click
            productCard.addEventListener('click', async () => {
                try {
                    form.submit();

                } catch (error) {
                    console.error('Error fetching product details:', error);
                }
            });

            return form;
        }

        // Render Produk Berdasarkan Product ID
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }
        
        // Ambil parameter product_id dari URL
        const productId = getQueryParam('product_id');

        // Panggil fungsi renderFilterProducts jika product_id tersedia
        if (productId) {
            const filltittleproduct = document.getElementById('filproductidProductName');
            
            renderFilterProducts(productId);
        } else {
            console.error("Parameter 'product_id' tidak ditemukan di URL.");
        }

        // Fungsi renderFilterProducts (placeholder, pastikan fungsi ini didefinisikan)
        renderFilterProducts(productId);

        // Tambahkan Navigasi
        addNavigationListeners();
    });

</script>
