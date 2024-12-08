<footer class=" py-0 mt-8 mx-9">
    <div class="parallax-appear">
        <div class="mx-auto p-2 bg-[#E01535] w-[1300px] text-white h-[121.86px] rounded-lg flex items-center justify-between">
            <!-- Left Section: Logo and Social Media Icons -->
            <div class="flex flex-col items-center lg:w-1/4 h-full justify-center">
                <img src="{{ asset('storage/icons/andal-white.svg') }}" alt="Logo" class="max-h-full w-auto h-[40px] mb-2">
                <div class="flex space-x-3 mt-2">
                    <img src="{{ asset('storage/icons/twitter.svg') }}" alt="twitter" class="max-h-full w-auto h-[15px]">
                    <img src="{{ asset('storage/icons/facebook.svg') }}" alt="facebook" class="max-h-full w-auto h-[15px]">
                    <img src="{{ asset('storage/icons/linkedin.svg') }}" alt="linkedin" class="max-h-full w-auto h-[15px]">
                    <img src="{{ asset('storage/icons/instagram.svg') }}" alt="instagram" class="max-h-full w-auto h-[15px]">
                    <img src="{{ asset('storage/icons/youtube.svg') }}" alt="youtube" class="max-h-full w-auto h-[15px]">
                </div>
            </div>

            <!-- Middle Section: Contact Information -->
            <div class="flex flex-col lg:items-start lg:w-1/3 h-full justify-center">
                <div class="flex items-center space-x-2 mb-2">
                    <img src="{{ asset('storage/icons/place.svg') }}" alt="place" class="max-h-full w-auto h-[30px]">
                    <span class="font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-justify">
                        Jl. Jombang Raya No.26, Pd. Aren, Kec. Pd. Aren, Kota Tangerang Selatan, Banten 15224</span>
                </div>
                <div class="flex items-center space-x-2 mb-2">
                    <img src="{{ asset('storage/icons/wa.svg') }}" alt="wa" class="max-h-full w-auto h-[20px]">
                    <span class="font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left">+62 878 8211 2000</span>
                </div>
            </div>

            <!-- Right Section: Additional Information -->
            <div class="flex flex-col lg:items-start lg:w-1/4 h-full justify-center">
                <div class="flex items-center space-x-2 mb-2">
                    <img src="{{ asset('storage/icons/clock.svg') }}" alt="clock" class="max-h-full w-auto h-[20px]">
                    <span class="font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left">Monday – Saturday <br class="responsive-br"> 07:30 – 16:30</span>
                </div>
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('storage/icons/email.svg') }}" alt="email" class="max-h-full w-auto h-[16px]">
                    <span class="font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left">team@andalprima.co.id</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-center items-center w-full h-full">
        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-center text-[#747474] py-3">
            © 2022-2024 PT. Andal Prima Adhitama Perkasa. All rights reserved. | Developed by Thriveworks
        </span>
    </div>
</footer>

<style>
    /* Default styling */
    footer .flex {
        flex-wrap: nowrap;
    }

    @media (min-width: 429px) {
        .responsive-br {
            display: inline; /* Tampilkan <br> */
        }
    }

    @media (max-width: 428px) {
        /* Susun bagian footer secara vertikal */
        .responsive-br {
            display: none; /* Sembunyikan <br> */
        }
        footer .mx-auto.p-2 {
            flex-direction: column; /* Mengatur elemen secara vertikal */
            align-items: center;
            text-align: center;
            width: 100%; /* Lebar penuh */
            padding: 1rem;
            height: auto; /* Sesuaikan tinggi otomatis */
        }

        /* Atur lebar masing-masing bagian menjadi penuh dan tata letak agar sesuai */
        footer .w-1/4, footer .w-1/3 {
            width: 100%; /* Lebar penuh untuk setiap bagian */
            margin-bottom: 15px; /* Menambahkan jarak antar bagian */
        }

        /* Mengatur ikon media sosial di tengah */
        footer .flex.space-x-3 {
            justify-content: center;
            gap: 10px; /* Jarak antar ikon media sosial */
        }

        /* Menyelaraskan item kontak */
        footer .flex.items-center.space-x-2 {
            justify-content: center; /* Pusatkan ikon dan teks kontak */
            margin: 5px 0; /* Menambahkan margin vertikal antar item */
        }

        /* Atur font dan ikon untuk layar kecil */
        footer span {
            font-size: 13px; /* Ukuran font lebih kecil */
            line-height: 1.5;
        }

        /* Teks hak cipta tetap di tengah */
        footer .text-center {
            font-size: 12px;
            padding: 10px 0;
            text-align: center;
            color: #747474;
        }
    }
</style>
