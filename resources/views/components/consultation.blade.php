<section name="consult" class="py-0 mt-12">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="flex items-center justify-center w-[994px] space-x-[30px]">
            <!-- Left Section -->
            <div class="shadow-custom w-[720px] h-[223px] p-4 flex items-center rounded-md bg-white space-x-[70px]">
                <div class="ml-[10px]">
                    <h2 class="font-roboto text-[22px] font-bold mb-3">Consult your needs now</h2>
                    <p class="font-roboto text-[12px] text-[#6B6B6B]  mb-3">Get the best offer from us, contact us and we will immediately serve what you need.</p>
                    <a href="mailto:team@andalprima.co.id" class="flex items-center justify-center w-[95px] h-[28.5px] inline-block bg-[#E01535] font-roboto text-[14px] font-normal text-white rounded">Contact Us</a>
                </div>
                <img src="{{ asset('storage/design/message.svg') }}" alt="message" class="h-[123px] w-[118px]">
            </div>
            <!-- Right Section -->
            <div id="right-section" class="relative w-[245px] h-[223px] shadow-custom bg-cover rounded-md bg-center p-4 text-center" style="background-image: url('{{ asset('storage/images/em9YuIaleCIngKzyqiVgvpJWiT514QZoKh1Xzxzr.jpg') }}');">
                <!-- Left rectangle -->
                <div id="left-tangle" class="absolute left-0 top-1/2 transform -translate-y-1/2 h-[46px] w-[23px] bg-black bg-opacity-50 flex items-center justify-center cursor-pointer">
                    <img src="{{ asset('storage/icons/left.svg') }}" alt="icon-left" class="w-[6px] h-[11px]">
                </div>

                <!-- Right rectangle -->
                <div id="right-tangle" class="absolute right-0 top-1/2 transform -translate-y-1/2 h-[46px] w-[23px] bg-black bg-opacity-50 flex items-center justify-center cursor-pointer">
                    <img src="{{ asset('storage/icons/right.svg') }}" alt="icon-right" class="w-[6px] h-[11px]">
                </div>

                <h2 id="right-section-title" class="text-left text-[18px] font-poppins font-bold mb-2 text-[#292929] font-semibold">Dapatkan Penawaran Baru Dari Kami!</h2>
                <a id="right-section-button" class="inline-block font-poppins bg-white text-[16px] text-[#E01535] flex items-center justify-center h-[30px] w-auto rounded font-semibold">Total 75% Discount!</a>
            </div>
        </div>
    </div>
</section>

<style>
    .shadow-custom {
        box-shadow: 0px 4px 4px 0px #00000026;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rightSection = document.getElementById('right-section');
        const rightSectionTitle = document.getElementById('right-section-title');
        const rightSectionButton = document.getElementById('right-section-button');
        const leftTangle = document.getElementById('left-tangle');
        const rightTangle = document.getElementById('right-tangle');

        const slides = [
            {
                backgroundImage: "{{ asset('storage/images/em9YuIaleCIngKzyqiVgvpJWiT514QZoKh1Xzxzr.jpg') }}",
                title: "Dapatkan Penawaran Baru Dari Kami!",
                buttonText: "Total 75% Discount!",
            },
            {
                backgroundImage: "{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}", // ganti dengan gambar lain
                title: "Penawaran Spesial Bulan Ini!",
                buttonText: "Diskon Hingga 50%!",
            },
            {
                backgroundImage: "{{ asset('storage/images/em9YuIaleCIngKzyqiVgvpJWiT514QZoKh1Xzxzr.jpg') }}", // ganti dengan gambar lain
                title: "Promo Terbatas Minggu Ini!",
                buttonText: "Nikmati Potongan 30%!",
            }
            // Tambahkan lebih banyak slide jika diperlukan
        ];

        let currentIndex = 0;

        function updateSlide() {
            const slide = slides[currentIndex];
            rightSection.style.backgroundImage = `url(${slide.backgroundImage})`;
            rightSectionTitle.textContent = slide.title;
            rightSectionButton.textContent = slide.buttonText;

            // Perbarui warna teks berdasarkan warna latar belakang
            updateTextColor(rightSection, rightSectionTitle);
        }

        function updateTextColor(element, textElement) {
            const bgColor = window.getComputedStyle(element).backgroundImage;
            if (bgColor) {
                // Menghitung rata-rata kecerahan
                const rgb = bgColor.match(/\d+/g).map(Number);
                const brightness = (rgb[0] * 299 + rgb[1] * 587 + rgb[2] * 114) / 1000;

                // Atur warna teks berdasarkan kecerahan
                if (brightness > 35) {
                    textElement.style.color = '#292929'; // teks hitam untuk background terang
                } else {
                    textElement.style.color = '#ffffff'; // teks putih untuk background gelap
                }
            }
        }

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlide();
        }

        function showPreviousSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateSlide();
        }

        rightTangle.addEventListener('click', showNextSlide);
        leftTangle.addEventListener('click', showPreviousSlide);

        // Ganti slide setiap 7 detik
        setInterval(showNextSlide, 7000);

        // Panggil updateSlide pada awalnya untuk menginisialisasi warna teks
        updateSlide();
    });

</script>
