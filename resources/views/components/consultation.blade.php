<section name="consult" class="py-0 mt-12">
    <div class="parallax-appear">
        <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
            <!-- Ubah kelas flex agar responsif -->
            <div id="subsessionconsule" class="flex flex-col lg:flex-row items-center justify-center w-full lg:w-[1200px] space-y-4 lg:space-y-0 lg:space-x-[30px]">
                <!-- Left Section -->
                <div class="shadow-custom w-full lg:w-[900px] h-[245px] p-4 flex items-center rounded-md bg-white space-x-[20px]">
                    <div class="ml-[10px]">
                        <h2 class="font-roboto text-[22px] font-bold mb-3">Consult your needs now</h2>
                        <p class="font-roboto text-[12px] text-[#6B6B6B] mb-3">Get the best offer from us, contact us and we will immediately serve what you need.</p>
                        <a href="mailto:team@andalprima.co.id" class="flex items-center justify-center w-[95px] h-[28.5px] inline-block bg-[#E01535] font-roboto text-[14px] font-normal text-white rounded">Contact Us</a>
                    </div>
                    <img src="{{ asset('storage/design/message.svg') }}" alt="message" class="h-[123px] w-[118px]">
                </div>
                <!-- Right Section -->
                <div id="right-section-consule" class="relative w-full lg:w-[245px] h-[245px] shadow-custom bg-cover z-[-10] rounded-md bg-center p-4 text-center"
                style="background-image: url('{{ asset('storage/images/istockphoto-870572906-612x612.jpg') }}');">
                    <!-- Left rectangle -->
                    <!-- <div id="left-tangle" class="absolute left-0 top-1/2 transform -translate-y-1/2 h-[46px] w-[23px] bg-black bg-opacity-50 flex items-center justify-center cursor-pointer">
                        <img src="{{ asset('storage/icons/left.svg') }}" alt="icon-left" class="w-[6px] h-[11px]">
                    </div> -->
                    <!-- Right rectangle -->
                    <!-- <div id="right-tangle" class="absolute right-0 top-1/2 transform -translate-y-1/2 h-[46px] w-[23px] bg-black bg-opacity-50 flex items-center justify-center cursor-pointer">
                        <img src="{{ asset('storage/icons/right.svg') }}" alt="icon-right" class="w-[6px] h-[11px]">
                    </div> -->
                    <h2 id="right-section-title" class="text-left lg:text-left text-[18px] font-poppins font-bold mb-2 text-[#292929] font-semibold">Dapatkan Penawaran Baru Dari Kami!</h2>
                    <a id="right-section-button" class="inline-block font-poppins bg-white bg-opacity-70  text-[16px] text-[#E01535] flex items-center justify-center h-auto w-auto rounded font-semibold">Total 75% Discount!</a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    #right-section-consule {
    transition: background-image 1s ease-in-out;
    }

    .fade-out {
        animation: fadeOut 1s forwards;
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    .fade-in {
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }

    @media (max-width: 450px) {
    /* Stack Right Section below Left Section */
    section[name="consult"] .flex.flex-col.lg\:flex-row {
        flex-direction: column;
        width: 100%;
    }

    /* Remove horizontal spacing and add vertical spacing for smaller screens */
    section[name="consult"] .space-y-4 {
        margin-bottom: 16px;
    }

    /* Set Left Section width to 331px for small screens */
    section[name="consult"] .w-full.lg\:w-\[720px\] {
        width: 331px;
    }

    /* Set Right Section width to 331px for small screens */
    section[name="consult"] .w-full.lg\:w-\[245px\] {
        width: 331px;
    }

    /* Adjust the position of navigation buttons */
    #left-tangle, #right-tangle {
        position: absolute;
        top: 50%; /* Center vertically */
        transform: translateY(-50%); /* Adjust for vertical centering */
        width: 30px;
        height: 30px;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        /* border-radius: 50%; */
    }

    /* Position left navigation button */
    #left-tangle {
        left: -15px; /* Offset to the left of the image boundary */
    }

    /* Position right navigation button */
    #right-tangle {
        right: -15px; /* Offset to the right of the image boundary */
    }

    /* Center align text and adjust width for smaller screens */
    #right-section-title {
        text-align: center;
        font-size: 16px;
    }

    #right-section-button {
        text-align: center;
        width: auto;
    }
    #subsessionconsule{
        width: 80%;
    }
}

</style>


<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const API_BASE_URL = 'http://127.0.0.1:8001'; // Ganti sesuai URL API Anda
        const rightSection = document.getElementById('right-section-consule');
        const rightSectionButton = document.getElementById('right-section-button');
        let banners = []; // Array untuk menyimpan data banner kecil
        let currentIndex = 0;

        // Fungsi untuk mengambil data dari API
        async function fetchBannerKecil() {
            try {
                const response = await fetch(`${API_BASE_URL}/api/banner-kecil`);
                const data = await response.json();

                if (data.success) {
                    banners = data.data.map(banner => ({
                        image: banner.image.replace('http://127.0.0.1:8001', '').trim(),
                        text: banner.text,
                    }));
                    changeBackground(); // Set gambar dan teks pertama kali
                } else {
                    console.error('Gagal memuat banner kecil:', data.message);
                    alert('Gagal memuat data banner kecil.');
                }
            } catch (error) {
                console.error('Error fetching banner kecil:', error);
                alert('Terjadi kesalahan saat memuat banner kecil.');
            }
        }

        // Fungsi untuk mengubah background dan teks
        function changeBackground() {
            if (!banners.length) return;

            // Tambahkan animasi fade-out
            rightSection.classList.add('fade-out');

            // Ganti gambar dan teks setelah animasi selesai
            setTimeout(() => {
                currentIndex = (currentIndex + 1) % banners.length; // Update index
                const currentBanner = banners[currentIndex];

                // Update background image
                rightSection.style.backgroundImage = `url('${currentBanner.image}')`;

                // Update teks tombol
                rightSectionButton.textContent = currentBanner.text || 'No Text';

                // Tambahkan animasi fade-in setelah mengganti gambar
                rightSection.classList.remove('fade-out');
                rightSection.classList.add('fade-in');

                // Hapus kelas fade-in setelah selesai
                setTimeout(() => {
                    rightSection.classList.remove('fade-in');
                }, 1000); // Durasi animasi fade-in
            }, 1000); // Durasi animasi fade-out
        }

        // Mulai carousel untuk mengganti banner kecil
        setInterval(changeBackground, 5000); // Ubah setiap 5 detik

        // Panggil fungsi untuk memuat data banner kecil
        await fetchBannerKecil();
    });
</script>
