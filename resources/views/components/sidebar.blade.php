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
            transition: all 0.3s ease;
        }
        .toggle-hidden {
            left: -30px; /* Posisi tombol ketika sidebar tersembunyi */
            transform: translateX(100%);
            transition: left 0.3s ease, transform 0.3s ease; /* Samakan durasi dan properti transisi dengan sidebar */
        }
        .toggle-visible {
            right: -30px; /* Tepat di sebelah kanan sidebar */
            transform: translateX(0);
            transition: left 0.3s ease, transform 0.3s ease; /* Samakan durasi dan properti transisi dengan sidebar */
        }
        #tipe-pembelian, #alamat {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: white;
            color: #292929;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DADCE0;
            width: 100%;
            font-family: Roboto, sans-serif;
            font-size: 12px;
        }
        .hidden {
            display: none;
        }
    </style>

    <div class="flex fixed h-full w-1/4 left-0 sidebar-transition mt-[54px]" id="container-sidebar">
        <div id="sidebar" class="w-full p-5 transform sidebar-visible sidebar-transition bg-white shadow-custom flex flex-col justify-between">
            <!-- Grup Tombol di Bagian Atas -->

            <div class="p-1.5 flex items-center justify-center w-full h-[40.79px] shadow-inner rounded-md bg-gray-200 justify-around mb-4">
                <button id="btn-slide-1" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] flex-grow font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Pilih Tujuan</button>
                <button id="btn-slide-2" disabled class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Shop</button>
                <button id="btn-slide-3" disabled class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Payment</button>
            </div>

            <div class="flex-grow">
                 <!-- Slide 1: Pilih Tujuan -->
                <div id="slide-1" class="">
                    <h2 class="text-[22px] font-roboto font-medium text-[#292929] mb-4">Pilih Tujuan</h2>

                    <div class="relative mb-4">
                        <label for="tipe-pembelian" class="font-roboto block text-[#747474] text-[12px] mb-2">Tipe Pembelian:</label>
                        <div class="relative">
                            <select id="tipe-pembelian" class="appearance-none h-[29.84px] w-full border border-[#DADCE0] rounded-[4px] px-2 focus:outline-none focus:ring-2 focus:ring-[#E01535]">
                                <!-- Option akan diisi dengan data dari API -->
                            </select>
                            <!-- ikon panah -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.892578 0.605103L4.54956 4.26207L8.20653 0.605103" stroke="#6D6D6D" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative mb-4">
                        <label for="alamat" class="font-roboto block text-[#747474] text-[12px] mb-2">Alamat:</label>
                        <div class="relative">
                            <select id="alamat" class="form-select select2 appearance-none h-[29.84px] w-full border border-[#DADCE0] rounded-[4px] px-2 focus:outline-none focus:ring-2 focus:ring-[#E01535]" style="width: 100%;">
                                <option value="0">Pilih Alamat</option>
                                <!-- Opsi akan ditambahkan oleh JavaScript -->
                            </select>
                            <!-- Tambahkan ikon panah -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.892578 0.605103L4.54956 4.26207L8.20653 0.605103" stroke="#6D6D6D" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
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
                </div>

                <!-- Slide 3: Payment -->
                <div id="slide-3" class="hidden">
                    <h2 class="text-lg font-semibold">Payment</h2>
                    {{-- <form class="mt-4">
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
                    </form> --}}
                </div>
            </div>

            <div id="buttom-sidebar" class="mt-auto mb-auto">
                <hr>
                <div id="jumlahitem" class="font-roboto w-full px-3 h-[38px] bg-[#DA9818] text-white font-normal font-[14px] rounded-t-md transition duration-300 flex items-center justify-left hidden">
                    0 Item Dibeli: Rp.
                </div>
                <div class="bg-white h-[40.56px] p-2 border border-[#DADCE0] rounded-b-md mb-4 shadow-md flex justify-between items-center">
                    <div class="text-center w-1/3">
                        <p class="text-gray-600 text-xs">Ongkos kirim:</p>
                        @isset($ongkir)
                            <p id="ongkir-display" location-value="" price-value="" class="text-green-600 font-semibold text-[16px]">{{ $ongkir }}</p>
                        @else
                            <p id="ongkir-display" location-value="" price-value="" class="text-green-600 font-semibold text-[16px]">Rp.0</p>
                        @endisset
                    </div>
                    <div class="text-center border-x w-1/3">
                        <p class="text-gray-600 text-xs">Jarak:</p>
                        @isset($jarak)
                            <p id="jarak" jarak-value="" class="text-green-600 font-semibold text-[16px]">{{ $jarak }}</p>
                        @else
                            <p id="jarak" jarak-value="" class="text-green-600 font-semibold text-[16px]">0 km</p>
                        @endisset
                    </div>
                    <div class="text-center w-1/3">
                        <p class="text-gray-600 text-xs">Durasi:</p>
                        @isset($waktu)
                            <p id="waktu" waktu-value="" class="text-green-600 font-semibold text-[16px]">{{ $waktu }}</p>
                        @else
                            <p id="waktu" waktu-value="" class="text-green-600 font-semibold text-[16px]">0 mnt</p> <!-- Tambahkan id="waktu" -->
                        @endisset
                    </div>
                </div>

                <button id="to-slide-2-and-shop" class="w-full h-[37.6px] flex items-center  justify-center bg-[#E01535] text-white font-semibold font-[16px] rounded-md hover:bg-red-700 transition duration-300">
                    Selanjutnya
                </button>
                <div id="totalbayar" class="h-[37.6px] w-full px-3 bg-[#F4F4F4] text-[#ADADAD] font-semibold font-[14px] rounded-md transition duration-300 hidden flex items-center justify-center">
                    Total Bayar : Rp.
                </div>
                <button id="to-slide-3" hidden class="w-full py-3 bg-[#E01535] text-white font-semibold font-[16px] rounded-md hover:bg-red-700 transition duration-300">
                    Selanjutnya
                </button>
            </div>
        </div>

        <button id="toggle" name="tt" class="p-3 h-[32.09px] sidebar-transition absolute top-1/3 rounded-r-md bg-[#E01535] toggle-visible">
            <img src="{{ asset('storage/icons/vector.svg') }}" alt="toggle">
        </button>
        {{-- @vite('resources/js/app.js') --}}
    </div>

    <script>
         document.addEventListener('DOMContentLoaded', function() {

            // Fungsi untuk menampilkan slide berdasarkan nomor
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

            document.getElementById('btn-slide-1').addEventListener('click', function() {
                showSlide(1);
            });

            document.getElementById('btn-slide-2').addEventListener('click', function() {
                showSlide(2);
            });

            document.getElementById('btn-slide-3').addEventListener('click', function() {
                showSlide(3);
            });

            document.getElementById('toggle').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                const toggleBtn = document.getElementById('toggle');
                const toggleIcon = toggleBtn.querySelector('img');
                const mapContainer = document.getElementById('map-container');
                const considebar = document.getElementById('container-sidebar')

                if (sidebar.classList.contains('sidebar-visible')) {
                    // Sembunyikan sidebar dan perbesar peta ke lebar penuh
                    sidebar.classList.remove('sidebar-visible');
                    sidebar.classList.add('sidebar-hidden');
                    considebar.classList.add('z-0');
                    considebar.classList.remove('z-20');
                    toggleBtn.classList.remove('toggle-visible');
                    toggleBtn.classList.add('toggle-hidden');
                    toggleIcon.src = "{{ asset('storage/icons/vector-hidden.svg') }}";
                   } else {
                    // Tampilkan sidebar dan kembalikan peta ke lebar 3/4
                    sidebar.classList.remove('sidebar-hidden');
                    sidebar.classList.add('sidebar-visible');
                    considebar.classList.add('z-20');
                    considebar.classList.remove('z-0');
                    toggleBtn.classList.remove('toggle-hidden');
                    toggleBtn.classList.add('toggle-visible');
                    toggleIcon.src = "{{ asset('storage/icons/vector.svg') }}";
                }
            });

            document.getElementById('to-slide-2-and-shop').addEventListener('click', function() {
                showSlide(2);

                // Mengambil elemen dan memeriksa apakah elemen tersebut ada
                const ongkirElement = document.getElementById('ongkir-display');
                const jarakElement = document.getElementById('jarak');
                const waktuElement = document.getElementById('waktu');

                if (!ongkirElement || !jarakElement || !waktuElement) {
                    console.error('One or more elements are missing');
                    return; // Menghentikan eksekusi jika elemen tidak ditemukan
                }

                // Mengambil nilai dari elemen yang ada
                const ongkirValue = ongkirElement.getAttribute('price-value');
                const jarakValue = jarakElement.getAttribute('jarak-value');
                const waktuValue = waktuElement.getAttribute('waktu-value');
                const locateValue = ongkirElement.getAttribute('location-value'); // JSON string

                // Membuat form secara dinamis
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/view-shop';

                // Menambahkan CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // console.log('rrrrrrrrrrr    ',csrfToken);
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Menambahkan input tersembunyi untuk setiap data
                const ongkirInput = document.createElement('input');
                ongkirInput.type = 'hidden';
                ongkirInput.name = 'ongkir';
                ongkirInput.value = ongkirValue;
                form.appendChild(ongkirInput);

                const jarakInput = document.createElement('input');
                jarakInput.type = 'hidden';
                jarakInput.name = 'jarak';
                jarakInput.value = jarakValue;
                form.appendChild(jarakInput);

                const waktuInput = document.createElement('input');
                waktuInput.type = 'hidden';
                waktuInput.name = 'waktu';
                waktuInput.value = waktuValue;
                form.appendChild(waktuInput);

                const locateInput = document.createElement('input');
                locateInput.type = 'hidden';
                locateInput.name = 'locate';
                locateInput.value = locateValue; // JSON string
                form.appendChild(locateInput);

                // Logging untuk memastikan form dibuat dengan benar
                console.log('Submitting form to /view-shop');

                // Menambahkan form ke body dan mengirimkannya
                document.body.appendChild(form);
                form.submit();
            });
         });

    </script>
</section>
