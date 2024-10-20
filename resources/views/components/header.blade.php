
<nav class="bg-[#FFF9F4] fixed top-0 w-full shadow-md pt-2 z-50">
    <!-- First Row -->
        <div class="max-w-[90%] mx-auto px-2 sm:px-6 lg:px-8">
            <div class="flex space-x-2 justify-center h-10 mx-auto">
                <!-- Left Side (Logo and Company Name) -->
                <div class="flex items-center">
                    <a href="http://127.0.0.1:8001/">
                        <img class="max-h-full w-auto h-8" src="{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}" alt="Logo">
                    </a>
                </div>

                <div class="flex items-center">
                    <a herf="http://127.0.0.1:8001/" class="inline-flex items-center bg-[#E01535] text-white px-3 py-2 rounded">
                        <img src="{{ asset('storage/icons/keranjang.svg') }}" alt="keranjang" class="h-4 w-4 mr-1.5">
                        <span id="keranjang" class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left mr-3">0</span>
                    </a>
                </div>

                <div class="relative flex items-center">
                    <button id="category" class="bg-[#FFFFFF] w-[90.89px] h-8 px-2 pr-3 rounded-l-md text-sm border border-gray-300 focus:outline-none flex items-center justify-center">
                        <img src="{{ asset('storage/icons/category.svg') }}" alt="category" class="h-4 w-4 mr-1.5">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left">Category</span>
                    </button>
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
    <div id="secondrow" class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 ">
        <div id="dropdownOverlay2" class="hidden fixed inset-0 mt-12 h-10 bg-black bg-opacity-50" style="z-index: 41"></div>

        <div class="flex mx-auto justify-between h-10">
            <div class="flex justify-center h-10 mx-auto">
              <!-- Navbar links -->
                <div class="space-x-1 sm:-my-px sm:ml-3 sm:flex mx-auto">
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

<div class="relative">
    <!-- Full-screen overlay with semi-transparent background -->
    <div id="dropdownOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50" style="z-index: 41"></div>

    <!-- Dropdown Menu -->
    <div id="dropdownMenu" class="hidden mt-5 fixed z-50 bg-white shadow-lg rounded-b-md max-w-[906.44px] left-0 right-0 mx-auto">
        <!-- Dropdown Header -->
        <div class="bg-[#F4F4F4] space-x-3 h-[32px] flex px-4 border-b border-[#DADCE0]">
            <!-- Tab for Besi -->
            <a href="#" class="group flex items-center py-0 rounded-md text-sm font-medium">
                <span value="1" class="productType font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left text-[#292929] group-hover:text-[#E01535]">Besi</span>
            </a>
            <!-- Tab for Stainless Steel -->
            <a href="#" class="group flex items-center py-0 rounded-md text-sm font-medium">
                <span value="2" class="productType font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left text-[#292929] group-hover:text-[#E01535]">Stainless Steel</span>
            </a>
            <!-- Tab for Plastik -->
            <a href="#" class="group flex items-center py-0 rounded-md text-sm font-medium">
                <span value="3" class="productType font-roboto text-[14px] font-normal leading-4.5 tracking-wide text-left text-[#292929] group-hover:text-[#E01535]">Plastik</span>
            </a>
        </div>

        <!-- Dropdown Content -->
        <div class="grid listdropdown grid-cols-4 gap-4 p-4">
            <!-- Column for dynamic content -->
        </div>
    </div>
</div>

<!-- Call the header script with Vite -->
@vite('resources/js/header-script.js')

