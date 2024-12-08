<section name="partners" class="py-0 mt-8">
    <div class="parallax-appear">
        <div class="flex flex-col items-center justify-center mx-auto w-full h-full">
            <h2 class="font-roboto text-xm font-normal font-roboto text-center font-bold mb-5 text-[#292929]">Our Partner Products:</h2>
            <div class="flex items-center w-full space-x-[50px] lg:w-[90%]">
                <img width="110%" height="auto" src="{{ asset('storage\images\partners\dinamix.svg') }}" alt="Dynamix">
                <img width="70%" height="auto" src="{{ asset('storage\images\partners\pinguin.svg') }}" alt="Penguin">
                <img width="110%" height="auto" src="{{ asset('storage\images\partners\andalas.svg') }}" alt="Semen Andalas">
                <img width="110%" height="auto" src="{{ asset('storage\images\partners\alderon.svg') }}" alt="Alderon">
                <img width="110%" height="auto" src="{{ asset('storage\images\partners\power.svg') }}" alt="Power">
                <img width="110%" height="auto" src="{{ asset('storage\images\partners\pralon.svg') }}" alt="Pralon">
            </div>
        </div>
    </div>
</section>
<style>
    /* Default styling */
    section[name="partners"] .flex {
        overflow-x: hidden; /* Default tanpa scroll pada layar besar */
        justify-content: space-between;
    }

    @media (max-width: 428px) {
        /* Container styling */
        section[name="partners"] .flex {
            overflow-x: auto; /* Mengaktifkan scroll horizontal pada layar kecil */
            white-space: nowrap; /* Mencegah logo turun ke baris baru */
            justify-content: flex-start;
            gap: 20px;
        }

        /* Atur lebar elemen gambar untuk lebih responsif */
        section[name="partners"] img {
            width: 80px; /* Sesuaikan ukuran agar lebih kecil pada layar kecil */
            height: auto;
            display: inline-block; /* Agar tetap satu baris */
            margin-right: 10px; /* Jarak antar logo */
        }

        /* Sembunyikan spasi besar antar elemen di layar kecil */
        .space-x-\[101px\] {
            gap: 0px;
        }

        /* Atur ulang teks heading untuk layar kecil */
        h2.font-roboto.text-center.font-bold.mb-5 {
            font-size: 14px; /* Sesuaikan ukuran font */
            margin-bottom: 10px;
        }
    }
</style>
