<section class="sidebar">
    <style>
        .shadow-custom {
            box-shadow: 4px 4px 10px 0px #0000001A;
        }
        .shadow-inner {
            box-shadow: 0px 0px 4px 6px #0000001A inset;
        }
        .custom-clipath {
            position: relative;
            width: 100%;
            height: 100%;
            clip-path: polygon(0% 0%, 85% 0%, 100% 50%, 85% 100%, 0% 100%);
            overflow: hidden;
            white-space: nowrap;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .sidebar-visible {
            transform: translateX(0);
        }
        .sidebar-transition {
            transition: transform 0.3s ease;
        }
         /* Style untuk tombol toggle */
        .toggle-hidden {
            left: 0; /* Posisi tombol ketika sidebar tersembunyi */
            transform: translateX(0);
        }
        .toggle-visible {
            left: 320px; /* Posisi tombol ketika sidebar terlihat */
            transform: translateX(0);
        }
        .button-default {
            background-color: #F4F4F4; /* Default background color */
            color: #9D9D9D; /* Default text color */
        }

        .button-active {
            background-color: #E01535; /* Active background color */
            color: white; /* Active text color */
        }
    </style>
    <div class="flex fixed h-full w-1/4 left-0 sidebar-transition mt-[54px]">
        <div id="sidebar" class="p-5 transform sidebar-visible sidebar-transition bg-white shadow-custom">
            <!-- Grup Tombol di Bagian Atas -->
            <div class="p-[6px] flex items-center justify-center w-full h-[40.79px] shadow-inner rounded-md bg-[#F4F4F4] justify-around mb-4">
                <button id="btn-slide-1" class="px-3 pr-5 rounded-l-md rounded-r-full flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] custom-clipath">Pilih Tujuan</button>
                <button id="btn-slide-2" class="px-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] custom-clipath">Shop</button>
                <button id="btn-slide-3" class="px-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] custom-clipath">Payment</button>
            </div>

            <!-- Slide 1: Pilih Tujuan -->
            <div id="slide-1">
                <h2 class="text-lg font-semibold">Pilih Tujuan</h2>
                <label class="block mt-4">
                    <span class="text-gray-700">Tipe Pembelian:</span>
                    <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option>Dikirim</option>
                        <!-- Tambahkan opsi lainnya jika perlu -->
                    </select>
                </label>
                <label class="block mt-4">
                    <span class="text-gray-700">Alamat:</span>
                    <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option>Pondok Pinang - Jakarta Selatan</option>
                        <!-- Tambahkan opsi lainnya jika perlu -->
                    </select>
                </label>
                <div class="mt-4">
                    <p class="text-sm">Ongkos kirim: <strong>Rp.70.000</strong></p>
                    <p class="text-sm">Jarak: <strong>20 km</strong></p>
                    <p class="text-sm">Durasi: <strong>47m</strong></p>
                </div>
                <button id="to-slide-2" class="mt-4 w-full py-2 bg-red-500 text-white rounded-md">Selanjutnya</button>
            </div>

            <!-- Slide 2: Shop -->
            <div id="slide-2" class="hidden">
                <h2 class="text-lg font-semibold">Shop</h2>
                <div class="mt-4">
                    <!-- Ulangi blok ini untuk setiap item -->
                    <div class="flex items-center justify-between p-2 border-b border-gray-200">
                        <div>
                            <p class="text-sm font-semibold">Spandek - Spandeck Zincalu...</p>
                            <p class="text-xs text-gray-600">Tipe Gelombang: Tipe 1040</p>
                            <p class="text-xs text-gray-600">Tebal: 0.25 mm</p>
                            <p class="text-sm">Total Harga: <strong>Rp. 300.000</strong></p>
                        </div>
                        <div class="flex items-center">
                            <button class="px-2 py-1 text-white bg-red-500 rounded-md">-</button>
                            <span class="mx-2">50</span>
                            <button class="px-2 py-1 text-white bg-red-500 rounded-md">+</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-sm">Ongkos kirim: <strong>Rp.70.000</strong></p>
                    <p class="text-sm">Jarak: <strong>20 km</strong></p>
                    <p class="text-sm">Durasi: <strong>47m</strong></p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-lg font-bold">Total: Rp. 420.700</span>
                    <button id="to-slide-3" class="py-2 px-4 bg-red-500 text-white rounded-md">Bayar</button>
                </div>
            </div>

            <!-- Slide 3: Payment -->
            <div id="slide-3" class="hidden">
                <h2 class="text-lg font-semibold">Payment</h2>
                <form class="mt-4">
                    <label class="block">
                        <span class="text-gray-700">Nama Depan:</span>
                        <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Budi">
                    </label>
                    <label class="block mt-4">
                        <span class="text-gray-700">Nama Belakang:</span>
                        <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Setiawan">
                    </label>
                    <label class="block mt-4">
                        <span class="text-gray-700">Alamat Lengkap:</span>
                        <input type="text" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="Jl. Kesehatan, No.25, Karang Ranji">
                    </label>
                    <!-- Tambahkan field lainnya jika perlu -->
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-lg font-bold">Total: Rp. 420.700</span>
                        <button type="submit" class="py-2 px-4 bg-red-500 text-white rounded-md">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
        <button id="toggle" class="p-3 h-[32.09px] sidebar-transition absolute top-1/3 rounded-r-md bg-[#E01535] toggle-visible">
            <img src="{{ asset('storage/icons/vector.svg') }}" alt="toggle">
        </button>    </div>
        <script>
            // Fungsi untuk menampilkan slide berdasarkan nomor
            function showSlide(slideNumber) {
                // Sembunyikan semua slide
                document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));

                // Tampilkan slide yang dipilih
                document.getElementById('slide-' + slideNumber).classList.remove('hidden');

                // Reset semua tombol ke gaya default
                document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
                    btn.classList.remove('button-active');
                    btn.classList.add('button-default');
                });

                // Ubah gaya tombol yang dipilih
                document.getElementById('btn-slide-' + slideNumber).classList.add('button-active');
                document.getElementById('btn-slide-' + slideNumber).classList.remove('button-default');
            }

            // Event listener untuk tombol-tombol slide
            document.getElementById('btn-slide-1').addEventListener('click', function() {
                showSlide(1);
            });

            document.getElementById('btn-slide-2').addEventListener('click', function() {
                showSlide(2);
            });

            document.getElementById('btn-slide-3').addEventListener('click', function() {
                showSlide(3);
            });

            // Fungsi untuk toggle sidebar
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.getElementById('toggle');

                if (sidebar.classList.contains('sidebar-hidden')) {
                    sidebar.classList.remove('sidebar-hidden');
                    sidebar.classList.add('sidebar-visible');
                    toggleBtn.classList.remove('toggle-hidden');
                    toggleBtn.classList.add('toggle-visible');
                } else {
                    sidebar.classList.remove('sidebar-visible');
                    sidebar.classList.add('sidebar-hidden');
                    toggleBtn.classList.remove('toggle-visible');
                    toggleBtn.classList.add('toggle-hidden');
                }
            }

            // Event listener untuk tombol toggle sidebar
            document.getElementById('toggle').addEventListener('click', toggleSidebar);

            // Tampilkan slide pertama dan sidebar secara default saat halaman dimuat
            window.addEventListener('load', function() {
                showSlide(1);
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.remove('sidebar-hidden');
                sidebar.classList.add('sidebar-visible');
                const toggleBtn = document.getElementById('toggle');
                toggleBtn.classList.remove('toggle-hidden');
                toggleBtn.classList.add('toggle-visible');
            });
        </script>
</section>
