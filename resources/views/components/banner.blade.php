<section name="banner" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div id="subbanner" class="relative w-[1200px] h-[256px] mt-20 shadow-custom bg-cover rounded-md bg-center overflow-hidden" style="background-image: linear-gradient(180deg, #000000 -36.47%, rgba(28, 28, 28, 0.595) 35.86%, rgba(68, 68, 68, 0) 100%), url('{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}');">
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
                <h2 class="font-roboto text-[22px] font-bold text-white mb-3 banner-title">TOKO BESI TERLENGKAP</h2>
                <p class="font-roboto text-[12px] w-[320.39px] text-white mb-3 banner-description">
                    We offer competitive prices with the best quality, so you get maximum value for every purchase.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    /* Subbanner (Default) */
    #subbanner {
        position: relative;
        overflow: hidden;
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

    /* Saat Pergantian */
    .fade-out {
        transform: translateX(-100%);
        opacity: 0;
    }

    .fade-in {
        transform: translateX(0);
        opacity: 1;
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
        const banner = document.getElementById('subbanner');
        const title = document.querySelector('.banner-title');
        const description = document.querySelector('.banner-description');
        const images = [
            "{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}",
            "{{ asset('storage/images/em9YuIaleCIngKzyqiVgvpJWiT514QZoKh1Xzxzr.jpg') }}",
            "{{ asset('storage/images/istockphoto-1288462556-612x612.jpg') }}"
        ];
        const titles = [
            "TOKO BESI TERLENGKAP",
            "PROMO BULANAN HEBAT",
            "HARGA TERBAIK UNTUK ANDA"
        ];
        const descriptions = [
            "We offer competitive prices with the best quality, so you get maximum value for every purchase.",
            "Enjoy great deals every month, only at our store.",
            "Quality products at the most affordable prices."
        ];
        let currentIndex = 0;

        function setBackground(index) {
            // Fade out
            banner.classList.add('fade-out');
            title.classList.add('fade-out');
            description.classList.add('fade-out');

            setTimeout(() => {
                // Ganti gambar dan teks
                banner.style.backgroundImage = `linear-gradient(180deg, #000000 -36.47%, rgba(28, 28, 28, 0.595) 35.86%, rgba(68, 68, 68, 0) 100%), url(${images[index]})`;
                title.textContent = titles[index];
                description.textContent = descriptions[index];

                // Fade in
                banner.classList.remove('fade-out');
                title.classList.remove('fade-out');
                description.classList.remove('fade-out');
                banner.classList.add('fade-in');
                title.classList.add('fade-in');
                description.classList.add('fade-in');
            }, 1000); // Durasi animasi keluar
        }

        function startAutoSlide() {
            setInterval(() => {
                currentIndex = (currentIndex + 1) % images.length;
                setBackground(currentIndex);
            }, 7000); // Ganti setiap 7 detik
        }

        // Tombol navigasi
        document.getElementById('next-button').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            setBackground(currentIndex);
        });

        document.getElementById('prev-button').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            setBackground(currentIndex);
        });

        // Initialize
        setBackground(currentIndex);
        startAutoSlide();
    });

</script>