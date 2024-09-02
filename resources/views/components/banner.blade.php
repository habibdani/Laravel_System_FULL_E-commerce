<section name="banner" class="py-0 mt-8">
    <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
        <div class="relative w-[994px] h-[206px] mt-20 shadow-custom bg-cover rounded-md bg-center p-4 text-center" id="banner-container" style="background-image: linear-gradient(180deg, #000000 -36.47%, rgba(28, 28, 28, 0.595) 35.86%, rgba(68, 68, 68, 0) 100%), url('{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}');">

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

            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <h2 class="font-roboto text-[22px] font-bold text-white mb-3">TOKO BESI TERLENGKAP</h2>
                <p class="font-roboto text-[12px] w-[320.39px] text-white mb-3">We offer competitive prices with the best quality, so you get maximum value for every purchase.</p>
            </div>
        </div>
    </div>

    <style>
        #banner-container {
            transition: opacity 0.5s ease-in-out;
            opacity: 1;
        }

        #banner-container.fade-out {
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const banner = document.getElementById('banner-container');
            const images = [
                "{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}",
                "{{ asset('storage/images/em9YuIaleCIngKzyqiVgvpJWiT514QZoKh1Xzxzr.jpg') }}",
                "{{ asset('storage/images/I5jwMQectdlYcOFz3EqJqhNzgcPzBWAnJHCW4FHn.jpg') }}",
            ];
            let currentIndex = 0;
            let autoSlideInterval;

            function setBackground(index) {
                banner.classList.add('fade-out');
                setTimeout(() => {
                    banner.style.backgroundImage = `linear-gradient(180deg, #000000 -36.47%, rgba(28, 28, 28, 0.595) 35.86%, rgba(68, 68, 68, 0) 100%), url(${images[index]})`;
                    banner.classList.remove('fade-out');
                }, 500); // Match this with the fade-out duration
            }

            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % images.length;
                    setBackground(currentIndex);
                }, 7000); // Change every 7 seconds
            }

            function stopAutoSlide() {
                clearInterval(autoSlideInterval);
            }

            document.getElementById('next-button').addEventListener('click', () => {
                stopAutoSlide();
                currentIndex = (currentIndex + 1) % images.length;
                setBackground(currentIndex);
                startAutoSlide(); // Restart auto slide
            });

            document.getElementById('prev-button').addEventListener('click', () => {
                stopAutoSlide();
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                setBackground(currentIndex);
                startAutoSlide(); // Restart auto slide
            });

            // Initialize
            setBackground(currentIndex);
            startAutoSlide();
        });
    </script>
</section>


