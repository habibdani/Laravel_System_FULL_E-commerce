<section name="banner" class="py-0 mt-8">
    <div class="parallax-appear">

        <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
            <div id="subbanner" class="relative w-[1300px] h-[480px] mt-20 shadow-custom bg-cover rounded-md bg-center overflow-hidden" style="background-image: linear-gradient(180deg, #000000 -36.47%, rgba(28, 28, 28, 0.595) 35.86%, rgba(68, 68, 68, 0) 100%), url('{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}');">
                <!-- Tombol kiri -->
                <button class="absolute -left-10 top-1/2 transform -translate-y-1/2 bg-[#E8E8E8] hover:bg-opacity-50 text-white w-[26px] h-[26px] rounded-full flex items-center justify-center focus:outline-none" id="prev-button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Tombol kanan -->
                <button class="absolute -right-10 top-1/2 transform -translate-y-1/2 bg-[#E01535] hover:bg-opacity-50 text-white w-[26px] h-[26px] rounded-full flex items-center justify-center focus:outline-none" id="next-button">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <!-- Kontainer Teks -->
                <div class="absolute inset-0 flex flex-col items-center justify-center text-container">
                    <h2 class="font-roboto text-[30px] font-bold text-white mb-3 banner-title">TOKO BESI TERLENGKAP</h2>
                    <p class="font-roboto text-[16px] w-[50%] text-white mb-3 banner-description">
                        We offer competitive prices with the best quality, so you get maximum value for every purchase.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Subbanner (Default) */
    #subbanner {
        transition: transform 1s ease-in-out;
    }

    /* Kontainer Teks dan Gambar */
    .text-container,
    .image-container {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: transform 1s ease-in-out, opacity 1s ease-in-out;
        opacity: 1;
    }

    .fade-in {
        opacity: 1;
        transition: opacity 1s ease-in-out;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .scroll-in-right {
        transform: translateX(100%);
        opacity: 0;
        transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    }

    .scroll-in-left {
        transform: translateX(-100%);
        opacity: 0;
        transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    }

    .scroll-active {
        transform: translateX(0);
        opacity: 1;
        transition: transform 1s ease-in-out, opacity 1s ease-in-out;
    }

    /* Responsif */
    @media (max-width: 450px) {
        #subbanner {
            width: 80%;
            height: 180px;
        }

        .banner-title {
            font-size: 18px;
        }

        .banner-description {
            font-size: 10px;
            width: 250px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const API_BASE_URL = 'http://127.0.0.1:8001'; // Ganti sesuai URL API Anda
        const banner = document.getElementById('subbanner');
        const title = document.querySelector('.banner-title');
        const description = document.querySelector('.banner-description');
        const nextButton = document.getElementById('next-button');
        const prevButton = document.getElementById('prev-button');
        let banners = []; // Untuk menyimpan data dari API
        let currentIndex = 0;
        let autoSlideInterval;

        // Fungsi untuk memuat data dari API
        async function fetchBanners() {
            try {
                const response = await fetch(`${API_BASE_URL}/api/banner-besar`);
                const data = await response.json();

                if (data.success) {
                    banners = data.data.map(banner => ({
                        image: banner.image.replace('http://127.0.0.1:8001', '').trim(),
                        tittle: banner.tittle,
                        description: banner.description
                    }));

                    if (banners.length > 0) {
                        setBackground(currentIndex); // Set background pertama kali
                        startAutoSlide(); // Mulai carousel otomatis
                    } else {
                        console.warn('Tidak ada data banner untuk ditampilkan.');
                    }
                } else {
                    console.error('Failed to fetch banners:', data.message);
                    alert('Gagal memuat banner.');
                }
            } catch (error) {
                console.error('Error fetching banners:', error);
                alert('Terjadi kesalahan saat memuat data banner.');
            }
        }

        // Fungsi untuk mengubah background, title, dan description
        function setBackground(index) {
            if (!banners.length) return;

            const currentBanner = banners[index];

            // Simultaneous transition
            banner.style.transition = 'transform 1s ease-in-out'; // Transisi untuk keluar
            banner.style.transform = 'translateX(-100%)'; // Geser keluar layar ke kiri

            // Ganti gambar saat animasi keluar sedang berlangsung
            setTimeout(() => {
                // Ubah gambar dan teks di posisi kanan
                banner.style.transition = 'none'; // Nonaktifkan transisi sementara
                banner.style.transform = 'translateX(100%)'; // Pindahkan langsung ke kanan
                banner.style.backgroundImage = `url(${currentBanner.image})`;
                title.textContent = currentBanner.tittle || '';
                description.textContent = currentBanner.description || '';

                // Geser gambar masuk ke layar
                setTimeout(() => {
                    banner.style.transition = 'transform 0.5s ease-in-out'; // Tambahkan transisi masuk
                    banner.style.transform = 'translateX(0)'; // Geser ke posisi tengah
                }, 10); // Tunggu sedikit waktu untuk memastikan perubahan selesai
            }, 250); // Ganti gambar di tengah animasi keluar (0.25 detik)
        }


        // Fungsi untuk menjalankan carousel otomatis
        function startAutoSlide() {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % banners.length;
                setBackground(currentIndex);
            }, 7000); // Ganti setiap 7 detik
        }

        // Fungsi untuk tombol navigasi berikutnya
        nextButton.addEventListener('click', () => {
            clearInterval(autoSlideInterval); // Hentikan auto-slide sementara
            currentIndex = (currentIndex + 1) % banners.length;
            setBackground(currentIndex);
            startAutoSlide(); // Mulai ulang auto-slide
        });

        // Fungsi untuk tombol navigasi sebelumnya
        prevButton.addEventListener('click', () => {
            clearInterval(autoSlideInterval); // Hentikan auto-slide sementara
            currentIndex = (currentIndex - 1 + banners.length) % banners.length;
            setBackground(currentIndex);
            startAutoSlide(); // Mulai ulang auto-slide
        });

        // Initialize
        fetchBanners(); // Memuat data dari API
    });
</script>
