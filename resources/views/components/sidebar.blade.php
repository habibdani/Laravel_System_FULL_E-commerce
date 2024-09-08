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
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Untuk Firefox */
        .scrollbar-hide {
            scrollbar-width: none; /* Hides the scrollbar in Firefox */
        }
    </style>

    <div class="flex fixed h-full w-1/4 left-0 sidebar-transition mt-[54px]" id="container-sidebar">
        <div id="sidebar" class="w-full p-5 transform sidebar-visible sidebar-transition bg-white shadow-custom flex flex-col justify-between">
            <!-- Grup Tombol di Bagian Atas -->

            <div class="p-1.5 flex items-center justify-center w-full h-[40.79px] shadow-inner rounded-md bg-gray-200 justify-around mb-4">
                <button id="btn-slide-1" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] flex-grow font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Pilih Tujuan</button>
                <button id="btn-slide-2" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Shop</button>
                <button id="btn-slide-3" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
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
                    <p class="text-sm">Item Anda:</p>

                    <!-- Wrapper untuk konten dengan scroll -->
                    <div class="list-order-item mt-2 space-y-4 max-h-[340px] overflow-y-auto scrollbar-hide">
                    </div>
                </div>

                <!-- Slide 3: Payment -->
                <div id="slide-3" class="hidden">
                    <h2 class="text-lg font-semibold mb-4">Payment</h2>
                    <form class="space-y-2 max-h-[330px] overflow-y-auto scrollbar-hide">
                        <!-- Nama Penerima -->
                        <div>
                            <label for="nama-user" class="block text-[12px] font-normal text-[#292929]">Nama Penerima</label>
                            <input type="text" id="nama-user" name="nama-user" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="Budi">
                        </div>

                        <!-- Alamat Lengkap -->
                        <div>
                            <label for="alamat-lengkap" class="block text-[12px] font-normal text-[#292929]">Alamat Lengkap</label>
                            <input type="text" id="alamat-lengkap" name="alamat-lengkap" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="Jl. Kesehatan, No.25, Karang Ranji">
                        </div>

                        <!-- Kota -->
                        <div>
                            <label for="kota" class="block text-[12px] font-normal text-[#292929]">Kota</label>
                            <input type="text" id="kota" name="kota" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="Jakarta Selatan">
                        </div>

                        <!-- Kode Pos -->
                        <div>
                            <label for="kode-pos" class="block text-[12px] font-normal text-[#292929]">Kode Pos</label>
                            <input type="text" id="kode-pos" name="kode-pos" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="44327">
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="nomor-telp" class="block text-[12px] font-normal text-[#292929]">Nomor Telp.</label>
                            <input type="text" id="nomor-telp" name="nomor-telp" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="0867321773">
                        </div>

                        <!-- Alamat Email -->
                        <div>
                            <label for="email" class="block text-[12px] font-normal text-[#292929]">Alamat Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="budisetiawan@gmail.com">
                        </div>

                        <!-- Catatan -->
                        <div class="bg-gray-100 p-3 rounded-md text-sm text-gray-700 flex items-start">
                            <svg class="w-6 h-6 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10c0 4.418-3.582 8-8 8S2 14.418 2 10 5.582 2 10 2s8 3.582 8 8zm-8 3a1 1 0 100-2 1 1 0 000 2zm1-8a1 1 0 10-2 0v4a1 1 0 102 0V5z" clip-rule="evenodd"/></svg>
                            <p class="text-[12px] font-normal text-[#292929]">Isi data pribadi Anda dengan benar, kami akan mengirimkan paket Anda ke alamat tersebut dan konfirmasi ke alamat Email Anda.</p>
                        </div>
                    </form>
                </div>

                <!-- Slide 4: detail pembayaran -->
                <div id="slide-4" class="hidden">
                    <div class=" max-h-[370px] overflow-y-auto scrollbar-hide">
                        <h2 class="text-lg font-semibold text-center mb-4">Detail Pembayaran</h2>

                        <!-- Detail Pembayaran Button -->
                        <button class="bg-red-600 text-white w-full px-4 py-2 rounded-md font-semibold mb-4">Detail Pembayaran</button>

                        <!-- Informasi Pembayaran -->
                        <div class="border rounded-lg p-4 mb-6">
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m-4 4h8v-1a3 3 0 00-3-3h-1a3 3 0 00-3 3v1z" />
                                </svg>
                                <span class="text-sm text-gray-700">Kami mengirimkan detail pemesanan dan pembayaran Anda ke email yang sudah Anda daftarkan.</span>
                            </div>

                            <!-- Total Bayar -->
                            <div class="text-center mb-4">
                                <img src="bca-logo.png" alt="BCA Logo" class="mx-auto mb-2 w-20">
                                <p class="font-semibold text-lg text-red-600">Total Bayar: Rp. 420.700</p>
                            </div>

                            <!-- Rekening Info -->
                            <div class="text-center mb-4">
                                <p class="font-semibold">Nomor Rekening: <span class="font-bold">32990329944</span> <span class="cursor-pointer">📋</span></p>
                                <p>a/n <span class="font-bold">BUDIONO NUGROHO</span></p>
                            </div>

                            <!-- Note Pembayaran -->
                            <div class="bg-gray-100 rounded-lg p-4 text-sm text-gray-700 mb-6">
                                <p>Note: kirim bukti pembayaran ke nomor WA kami, kami akan melakukan pelayanan setelah Anda mengirimkan bukti. Terima kasih.</p>
                                <p class="font-bold text-green-600 mt-2 flex items-center">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v4m0 4h.01m-.01-4h0V9h0m0 6h.01m-.01-6V5l-1-1m1-1V4m0 6h0V5h-2m0 6h0v2l1 1m-1 1h0m0-6h1l1-1v4h0M3 8v4h8V8H3z" />
                                    </svg>
                                    08257742883
                                </p>
                            </div>

                            <!-- Detail Pesanan -->
                            <div class="mb-4">
                                <p class="text-sm"><span class="font-bold">Tanggal Pemesanan:</span> 5 Mei 2024 - 21:44</p>
                                <p class="text-sm"><span class="font-bold">Jumlah Item:</span> 60 Item</p>
                            </div>

                            <!-- Item Pesanan -->
                            <div class="border rounded-lg p-4 mb-4">
                                <div class="flex space-x-4 mb-2">
                                    <img src="spandek.jpg" alt="Spandek" class="w-20 h-20 rounded-md">
                                    <div>
                                        <p class="font-bold">Spandek - Spandek Zincalume</p>
                                        <p class="text-sm">Tipe Gelombang: Tipe 1040</p>
                                        <p class="text-sm">Tebal: 0.25 mm</p>
                                        <p class="text-sm">Jumlah Item: 50</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border rounded-lg p-4 mb-4">
                                <div class="flex space-x-4 mb-2">
                                    <img src="spandek.jpg" alt="Spandek" class="w-20 h-20 rounded-md">
                                    <div>
                                        <p class="font-bold">Spandek - Spandek Zincalume</p>
                                        <p class="text-sm">Tipe Gelombang: Tipe 950</p>
                                        <p class="text-sm">Tebal: 0.25 mm</p>
                                        <p class="text-sm">Jumlah Item: 10</p>
                                        <p class="font-bold text-right">Total Harga: Rp. 50.700</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Item -->
                            <div class="bg-green-100 rounded-md p-2 text-center font-semibold text-green-600">
                                60 Item Dibeli - Rp. 350.700
                            </div>

                            <!-- Detail Pengiriman -->
                            <div class="mt-6">
                                <h3 class="text-sm font-semibold mb-2">Dikirim ke:</h3>
                                <div class="border rounded-lg p-4">
                                    <p class="text-sm"><span class="font-bold">Nama Depan:</span> Budi</p>
                                    <p class="text-sm"><span class="font-bold">Nama Belakang:</span> Setiawan</p>
                                    <p class="text-sm"><span class="font-bold">Alamat Lengkap:</span> Jl. Kesehatan, No.25, Karang Ranji</p>
                                    <p class="text-sm"><span class="font-bold">Kota:</span> Jakarta Selatan</p>
                                    <p class="text-sm"><span class="font-bold">Kode Pos:</span> 44327</p>
                                    <p class="text-sm"><span class="font-bold">Nomor Telp:</span> 0867321773</p>
                                    <p class="text-sm"><span class="font-bold">Alamat Email:</span> budisetiawan@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div id="buttom-sidebar" class="mt-auto mb-auto">
                <hr>
                <div id="jumlahitem" class="font-roboto w-full px-3 h-[38px] bg-[#DA9818] text-white font-normal text-[14px] rounded-t-md transition duration-300 flex items-center justify-left hidden">
                    <span id="totalitem" value="" class="mx-1">0</span> Item Dibeli: Rp. <span id="totalprice" value="">0</span>
                </div>
                <div class="bg-white h-[40.56px] p-2 border border-[#DADCE0] rounded-b-md mb-4 shadow-md flex justify-between items-center">
                    <div class="text-center w-1/3">
                        <p class="text-gray-600 text-xs">Ongkos kirim:</p>
                        <div id="ongkir-display" value="2000" class="text-green-600 font-semibold text-[16px]">Rp.0</div>
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
                <button id="totalbayar" disabled value="" class="h-[37.6px] w-full px-3 bg-[#F4F4F4] text-[#ADADAD] font-semibold font-[14px] rounded-md transition duration-300 hidden flex items-center justify-center">
                </button>

            </div>
        </div>

        <button id="toggle" name="tt" class="p-3 h-[32.09px] sidebar-transition absolute top-1/3 rounded-r-md bg-[#E01535] toggle-visible">
            <img src="{{ asset('storage/icons/vector.svg') }}" alt="toggle">
        </button>
        {{-- @vite('resources/js/app.js') --}}
    </div>
<div id="overlay-sidebar" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-19"></div>

<!-- Overlay dan Popup -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Pembayaran</h2>
        <p class="text-sm text-gray-700 mb-2">Pastikan alamat dan data Anda sudah benar,<br>Anda akan membayar sebesar</p>
        <p id="popup-price" class="text-2xl font-bold text-[#E01535] mb-6"></p>
        <div class="flex justify-center space-x-4">
            <button id="confirm-button" class="bg-[#E01535] text-white px-4 py-2 rounded-md">Konfirmasi</button>
            <button id="cancel-button" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md">Batal</button>
        </div>
    </div>
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
                const totalBayarElement = document.getElementById('totalbayar');
                if (totalBayarElement) {
                    totalBayarElement.setAttribute('disabled', 'disabled'); // Tambahkan atribut disabled
                    totalBayarElement.classList.remove('bg-[#E01535]', 'text-white');
                    totalBayarElement.classList.add('bg-[#F4F4F4]', 'text-[#ADADAD]');
                }
            });

            document.getElementById('btn-slide-3').addEventListener('click', function() {
                showSlide(3);

                // Mengubah warna tombol total bayar menjadi merah saat slide 3 ditampilkan
                const totalBayarElement = document.getElementById('totalbayar');

                if (totalBayarElement) {
                    totalBayarElement.removeAttribute('disabled'); // Hapus atribut disabled
                    totalBayarElement.classList.remove('bg-[#F4F4F4]', 'text-[#ADADAD]'); // Hapus class abu-abu
                    totalBayarElement.classList.add('bg-[#E01535]', 'text-white'); // Tambahkan class merah
                }
            });

            document.getElementById('confirm-button').addEventListener('click', function() {
                showSlide4(4);
                document.getElementById('overlay').classList.add('hidden');
            })

            function showSlide4(slideNumber) {
                document.querySelectorAll('[id^="slide-"]').forEach(slide => slide.classList.add('hidden'));
                document.getElementById('slide-' + slideNumber).classList.remove('hidden');

                document.querySelectorAll('[id^="btn-slide-"]').forEach(btn => {
                    btn.classList.remove('text-white', 'bg-[#E01535]');
                    btn.classList.add('text-[#9D9D9D]', 'bg-transparent');
                });
                document.getElementById('overlay-sidebar').classList.remove('hidden');
            }

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
                form.method = 'GET';
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

            // Fungsi untuk menangani perubahan quantity
            function handleQuantityChange(productVariantId) {
                const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
                const decreaseButton = document.getElementById(`sidebar-decrease-${productVariantId}`);
                const increaseButton = document.getElementById(`sidebar-increase-${productVariantId}`);

                // Tambahkan event listener untuk tombol decrease
                decreaseButton.addEventListener('click', () => {
                    let currentQty = parseInt(qtyInput.value);
                    if (currentQty > 1) { // Jangan kurang dari 1
                        qtyInput.value = currentQty - 1;
                    }
                    updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
                });

                // Tambahkan event listener untuk tombol increase
                increaseButton.addEventListener('click', () => {
                    let currentQty = parseInt(qtyInput.value);
                    qtyInput.value = currentQty + 1;
                    updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
                });

                // Tambahkan event listener untuk perubahan langsung di input field
                qtyInput.addEventListener('input', () => {
                    let currentQty = parseInt(qtyInput.value);
                    if (isNaN(currentQty) || currentQty < 1) {
                        qtyInput.value = 1; // Set minimal 1 jika input tidak valid
                    }
                    updateTotalPrice(productVariantId); // Memanggil fungsi untuk mengupdate total harga
                });
            }

            // Fungsi untuk mengupdate total harga (sesuaikan dengan perhitungan harga Anda)
            function updateTotalPrice(productVariantId) {
                const qtyInput = document.getElementById(`sidebar-quantity-${productVariantId}`);
                const qty = parseInt(qtyInput.value);

                const priceElement = document.getElementById(`price-product-sidebar-${productVariantId}`);
                const price = parseInt(priceElement.getAttribute('value-price-product-sidebar'));

                const totalPrice = qty * price; // Hitung total harga berdasarkan qty
                priceElement.innerText = `Rp. ${totalPrice.toLocaleString()}`; // Update display harga
            }

            // Panggil fungsi untuk setiap produk yang dihasilkan
            handleQuantityChange(productVariantId);

         });

         document.addEventListener('DOMContentLoaded', function() {

            // Fungsi untuk menghitung total item dan total harga
            function updateCartSummary() {
                const itemList = document.querySelectorAll('.list-order-item .sidebar-product-card');
                const totalItemElement = document.getElementById('totalitem');
                const totalPriceElement = document.getElementById('totalprice');
                const jumlahItemDiv = document.getElementById('jumlahitem');
                const ongkirElement = document.getElementById('ongkir-display');
                const totalBayarElement = document.getElementById('totalbayar');

                let totalItem = 0;
                let totalPrice = 0;

                // Loop untuk menghitung total item dan harga
                itemList.forEach(item => {
                    const qtyInput = item.querySelector('input[type="number"]');
                    const qty = qtyInput ? parseInt(qtyInput.value) : 1;

                    // Cari span harga berdasarkan ID dan ambil attribute value-price-product-sidebar-XX
                    const priceElement = item.querySelector('span[id^="price-product-sidebar-"]');
                    const price = priceElement ? parseInt(priceElement.getAttribute('value-price-product-sidebar-' + priceElement.id.split('-').pop())) : 0;

                    totalItem += qty;
                    totalPrice += qty * price;
                });

                // Update jumlah item dan total harga
                totalItemElement.innerText = totalItem;
                totalPriceElement.innerText = ` ${totalPrice.toLocaleString()}`;

                // Update juga attribute 'value' untuk totalitem dan totalprice
                totalItemElement.setAttribute('value', totalItem);
                totalPriceElement.setAttribute('value', totalPrice);

                // Ambil ongkir dari elemen #ongkir-display
                const ongkir = ongkirElement ? parseInt(ongkirElement.getAttribute('value')) || 0 : 0;

                // Hitung total bayar (totalPrice + ongkir)
                const totalBayar = totalPrice + ongkir;

                // Update teks dan atribut value dari totalBayarElement
                totalBayarElement.innerText = `Total Bayar : Rp. ${totalBayar.toLocaleString()}`;
                totalBayarElement.innerHTML = `
                    <span class="mx-auto">Total Bayar : Rp. ${totalBayar.toLocaleString()}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
                    </svg>
                `;
                totalBayarElement.setAttribute('value', totalBayar);

                // Tampilkan atau sembunyikan div jumlah item
                if (totalItem > 0) {
                    jumlahItemDiv.classList.remove('hidden');
                    totalBayarElement.classList.remove('hidden');
                } else {
                    jumlahItemDiv.classList.add('hidden');
                    totalBayarElement.classList.add('hidden');
                }
            }

            // Setiap kali ada perubahan di dalam list-order-item, jalankan updateCartSummary
            const listOrderItem = document.querySelector('.list-order-item');
            const observer = new MutationObserver(updateCartSummary);

            // Mengamati perubahan pada child elements di dalam list-order-item
            observer.observe(listOrderItem, { childList: true });

            // Jalankan fungsi sekali saat pertama kali halaman dimuat
            updateCartSummary();
        });

        document.getElementById('totalbayar').addEventListener('click', function() {
            // Ambil nilai dari tombol #totalbayar
            const totalBayarValue = document.getElementById('totalbayar').getAttribute('value');

            // Format harga ke dalam format Rupiah
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(totalBayarValue);

            // Masukkan nilai harga ke dalam popup
            document.getElementById('popup-price').innerText = formattedPrice;

            // Tampilkan overlay dan popup
            document.getElementById('overlay').classList.remove('hidden');
        })

        document.getElementById('cancel-button').addEventListener('click', function() {
            // Sembunyikan overlay dan popup
            document.getElementById('overlay').classList.add('hidden');
        });

    </script>
</section>
