
<style>
    .underline-hover {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .underline-hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: transparent; /* Default color */
        transition: background-color 0.3s ease;
        z-index: 1;
    }

    .underline-hover:hover::after {
        background-color: #E01535;
        /* background-color: #00AA5B; */
    }

</style>

<nav class="bg-[#FFF9F4] fixed top-0 w-full shadow-md pt-2 z-50">
    <!-- First Row -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-4 justify-between h-10 mx-auto">
                <!-- Left Side (Logo and Company Name) -->
                <div class="flex items-center">
                    <img class="max-h-full w-auto h-8" src="{{ asset('storage//icons/tokopedia.svg') }}" alt="Logo">
                    {{-- <img class="max-h-full w-auto h-8" src="{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}" alt="Logo"> --}}
                </div>

                <div class="flex items-center">
                    <a class="inline-flex items-center bg-[#E01535] text-white px-3 py-2 rounded">
                        <img src="{{ asset('storage/icons/keranjang.svg') }}" alt="keranjang" class="h-4 w-4 mr-1.5">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left">0</span>
                    </a>
                </div>

                <div class="relative flex items-center">
                    <a type="text" class="bg-[#FFFFFF] w-[90.89px] h-8 px-2 pr-3 rounded-l-md text-sm border border-gray-300 focus:outline-none flex items-center justify-center">
                        <img src="{{ asset('storage/icons/category.svg') }}" alt="category" class="h-4 w-4 mr-1.5">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left">Category</span>
                    </a>
                    <a class="relative w-[815px]">
                        <img src="{{ asset('storage/icons/pencarian.svg') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4" alt="Search Icon">
                        <input type="text" id="search-input" class="bg-[#FFFFFF] w-full h-8 pl-10 pr-5 rounded-r-md text-sm border border-[#DADCE0] focus:outline-none" placeholder="Search for products, types, and brands">
                    </a>
                </div>

                <!-- Right Side (Contact Info or Other Icons) -->
                <div class="flex items-center">
                    <a href="#" class="inline-flex items-center">
                        <img src="{{ asset('storage/icons/telfon.svg') }}" alt="telfon" class="h-4 w-4 mr-1.5">
                        <span class="font-roboto text-sm font-medium leading-4.5 tracking-wide text-left">(042) 883219</span>
                    </a>
                </div>
            </div>
        </div>

    <!-- Second Row -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex mx-auto justify-between h-10">
            <div class="flex justify-between h-10 mx-auto">
              <!-- Navbar links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-3 sm:flex mx-auto">
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/untuk-anda-gray.svg') }}" alt="Untuk Anda" class="h-5 w-5 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/untuk-anda-red.svg') }}" alt="Untuk Anda" class="h-5 w-5 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Untuk Anda</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-hollow-gray.svg') }}" alt="Besi Hollow" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-hollow-red.svg') }}" alt="Besi Hollow" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Besi Hollow dan Pipa Bulat</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-kawat-gray.svg') }}" alt="Besi Kawat" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-kawat-red.svg') }}" alt="Besi Kawat" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Besi Kawat</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/plat-besi-gray.svg') }}" alt="Plat Besi" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/plat-besi-red.svg') }}" alt="Plat Besi" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Plat Besi</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-batang-gray.svg') }}" alt="Besi Batangan" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-batang-red.svg') }}" alt="Besi Batangan" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Besi Batangan</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/baja-ringan-gray.svg') }}" alt="Baja Ringan" class="h-5 w-5 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/baja-ringan-red.svg') }}" alt="Baja Ringan" class="h-5 w-5 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Baja Ringan</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/plat-gelombang-gray.svg') }}" alt="Plat Gelombang" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/plat-gelombang-red.svg') }}" alt="Plat Gelombang" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Plat Gelombang</span>
                    </a>
                    <a href="#" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-structural-gray.svg') }}" alt="Besi Profil Struktural" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-structural-red.svg') }}" alt="Besi Profil Struktural" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]">Besi Profil Struktural</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
