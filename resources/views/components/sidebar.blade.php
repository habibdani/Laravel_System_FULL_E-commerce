
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
        #container-sidebar {
            width: 25%; /* Sesuai dengan kelas w-1/4 */
        }

        /* CSS untuk layar ponsel atau ukuran layar 428px ke bawah */
        @media (max-width: 428px) {
            #container-sidebar {
                width: 90%; /* Mengganti w-1/4 dengan w-[85%] */
            }
        }
    </style>

    <div class="flex fixed h-full w-1/4 left-0 sidebar-transition mt-[54px]" id="container-sidebar">
        <div id="sidebar" class="w-full p-5 transform sidebar-visible sidebar-transition bg-white shadow-custom flex flex-col justify-between">
            <!-- Grup Tombol di Bagian Atas -->

            <div class="p-1.5 flex items-center justify-center w-full h-[40.79px] shadow-inner rounded-md bg-gray-200 justify-around mb-2">
                <button id="btn-slide-2" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Shop</button>
                <button id="btn-slide-1" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] flex-grow font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Pilih Tujuan</button>
                <button id="btn-slide-3" class="custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
                w-1/3 h-[26.95px] font-roboto text-[14px] font-semibold text-[#9D9D9D] bg-transparent">Payment</button>
                <button id="btn-slide-4" class="hidden custom-clipath pl-3 pr-5 rounded-l-md flex items-center justify-center
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
                    <div hidden class="hidden" id="type-client" value="1"></div>
                    <div hidden class="hidden" id="pengiriman" value="2"></div>
                </div>

                <!-- Slide 2: Shop -->
                <div id="slide-2" class="hidden">
                    {{-- <h2 class="text-lg font-semibold">Shop</h2> --}}
                    <p class="text-sm">Item Anda:</p>

                    <!-- Wrapper untuk konten dengan scroll -->
                    <div id="list-order-container" class="list-order-item mt-1 space-y-2 max-h-[320px] overflow-y-auto scrollbar-hide">
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
                            <input type="text" disabled id="kota" name="kota" class="mt-1 block w-full h-[31.36px] px-3 py-2 border border-[#DADCE0] rounded-md shadow-sm focus:outline-none focus:ring-[#E01535] focus:border-[#E01535] sm:text-[12px]" placeholder="Jakarta Selatan">
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
                        <!-- <button class="bg-red-600 text-white w-full px-4 py-2 rounded-md font-semibold mb-4">Detail Pembayaran</button> -->

                        <!-- Informasi Pembayaran -->
                        <div class="border rounded-lg p-4 mb-6">
                            <div class="flex items-center space-x-2 mb-4">
                                <!-- <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m-4 4h8v-1a3 3 0 00-3-3h-1a3 3 0 00-3 3v1z" />
                                </svg> -->
                                <span class="text-sm text-gray-700">Kami mengirimkan detail pemesanan dan pembayaran Anda ke email yang sudah Anda daftarkan.</span>
                            </div>

                            <!-- Total Bayar -->
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/design/bca.svg') }}" alt="BCA Logo" class="mx-auto mb-2 w-20">
                                <p id="infototalbayar" class="font-semibold text-lg text-red-600">Total Bayar: Rp. 420.700</p>
                            </div>

                            <!-- Rekening Info -->
                            <div class="text-center mb-4">
                                <p class="font-semibold">Nomor Rekening: <span class="font-bold">32990329944</span> <span class="cursor-pointer"><svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="0.955078" y="3.65234" width="8.9043" height="10.2949" rx="1" stroke="#292929"/>
<path d="M3 1.39062H10.9961C11.5484 1.39062 11.9961 1.83834 11.9961 2.39062V11.6855" stroke="#292929" stroke-linecap="round"/>
</svg>
</span></p>
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
                                <p class="text-sm"><span class="font-bold">Tanggal Pemesanan: </span>
                                <span id="infowaktupemesanan"> 5 Mei 2024 - 21:44</span></p>
                                <!-- <p class="text-sm"><span class="font-bold">Jumlah Item:</span> 60 Item</p> -->
                            </div>

                            <!-- Item Pesanan -->
                            <!-- <div class="border rounded-lg p-4 mb-4">
                                <div class="flex space-x-4 mb-2">
                                    {{-- <img src="spandek.jpg" alt="Spandek" class="w-20 h-20 rounded-md"> --}}
                                    <div>
                                        <p class="font-bold">Spandek - Spandek Zincalume</p>
                                        <p class="text-sm">Tipe Gelombang: Tipe 1040</p>
                                        <p class="text-sm">Tebal: 0.25 mm</p>
                                        <p class="text-sm">Jumlah Item: 50</p>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="border rounded-lg p-4 mb-4">
                                <div class="flex space-x-4 mb-2">
                                    {{-- <img src="spandek.jpg" alt="Spandek" class="w-20 h-20 rounded-md"> --}}
                                    <div>
                                        <p class="font-bold">Spandek - Spandek Zincalume</p>
                                        <p class="text-sm">Tipe Gelombang: Tipe 950</p>
                                        <p class="text-sm">Tebal: 0.25 mm</p>
                                        <p class="text-sm">Jumlah Item: 10</p>
                                        <p class="font-bold text-right">Total Harga: Rp. 50.700</p>
                                    </div>
                                </div>
                            </div> -->

                            <!-- Total Item -->
                            <div class="bg-green-100 rounded-md p-2 text-center font-semibold text-green-600">
                                <span id="infocounttotalproduct"></span> Item Dibeli - <span id="infototalbayar">Rp.</span>
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

            <div id="buttom-sidebar" class="mt-auto">
                <hr>
                <div id="jumlahitem" class="font-roboto w-full px-3 h-[38px] bg-[#DA9818] text-white font-normal text-[14px] rounded-t-md transition duration-300 flex items-center justify-left">
                    <span id="totalitem" value="" class="mx-1">0</span> Item Dibeli: Rp. <span id="totalallprice" value="">0</span>
                </div>
                <div id="dataongkir" class="bg-white h-[40.56px] p-2 border border-[#DADCE0] shadow-md flex justify-between items-center">
                    <div class="text-center w-1/3">
                        <p class="text-gray-600 text-xs">Ongkos kirim:</p>
                        <div id="ongkir-display" location-value="" ongkir-value="" class="text-green-600 font-semibold text-[16px]">Rp.0</div>
                    </div>
                    <div class="text-center border-x w-1/3">
                        <p class="text-gray-600 text-xs">Jarak:</p>
                            <p id="jarak" jarak-value="" class="text-green-600 font-semibold text-[16px]">0 km</p>
                    </div>
                    <div class="text-center w-1/3">
                        <p class="text-gray-600 text-xs">Durasi:</p>
                            <p id="waktu" waktu-value="" class="text-green-600 font-semibold text-[16px]">0 mnt</p> <!-- Tambahkan id="waktu" -->
                    </div>
                </div>
                <div id="bottonpilihAlamat" class="bg-[#E01535] h-[40.56px] border border-[#E01535] rounded-b-md shadow-md flex justify-between items-center">
                    <form action="{{ url('/view-maps') }}" method="GET" class="w-full h-full">
                        <input type="hidden" name="client_type_id" value="1">
                        <button type="submit" id="pilihAlamatok" class="w-full h-full flex items-center justify-center text-white font-semibold text-[14px] rounded-md hover:bg-red-700 transition duration-300">
                            Pilih Alamat
                        </button>
                    </form>
                </div>
                <div id="bottonGoShop" class="bg-[#E01535] h-[40.56px] border border-[#E01535] rounded-b-md shadow-md flex justify-between items-center">
                    <form action="{{ url('/') }}" method="GET" class="w-full h-full">
                        {{-- <input type="hidden" name="client_type_id" value="1"> --}}
                        <button type="submit" id="saveAlamat" class="w-full h-full flex items-center justify-center text-white font-semibold text-[14px] rounded-md hover:bg-red-700 transition duration-300">
                            Pilih Produk Lain
                        </button>
                    </form>
                </div>

                <div class="divtotalbayar mt-2">
                    <button id="totalbayar" value="" class="h-[37.6px] w-full px-3 bg-[#F4F4F4] text-[#ADADAD] font-semibold font-[14px] rounded-md transition duration-300 hidden flex items-center justify-center">
                    </button>
                </div>
                <div class="divpayment mt-2">
                    <button id="payment" disabled value="" class="h-[37.6px] w-full px-3 bg-[#F4F4F4] text-[#ADADAD] font-semibold font-[14px] rounded-md transition duration-300 hidden flex items-center justify-center">
                    Payment</button>
                </div>
            </div>
        </div>

        <button id="toggle" name="tt" class="p-3 h-[32.09px] sidebar-transition absolute top-1/3 rounded-r-md bg-[#E01535] toggle-visible"
                data-visible-icon="{{ asset('storage/icons/vector.svg') }}"
                data-hidden-icon="{{ asset('storage/icons/vector-hidden.svg') }}">
            <img id="toggleimg" src="{{ asset('storage/icons/vector.svg') }}" alt="toggle">
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
                <button id="createorder" class="bg-[#E01535] text-white px-4 py-2 rounded-md">Konfirmasi</button>
                <button id="cancel-button" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md">Batal</button>
            </div>
        </div>
    </div>

    @vite('resources/js/sidebar-script.js')

</section>
