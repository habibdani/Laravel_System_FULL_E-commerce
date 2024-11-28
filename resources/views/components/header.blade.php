
<nav class="bg-[#FFF9F4] fixed top-0 w-full shadow-md pt-2 z-50">
    <!-- hidden Row -->
    <div class="w-[400px] mx-auto px-[10%] lg:px-8" id="rowhiddenheader">
        <div class="flex justify-between h-10 mx-auto">
            <!-- Left Section: Logo -->
            <div class="flex items-center logo-section">
                <a href="https://andalprima.hansmade.online/">
                    <img class="max-h-full w-auto h-8" src="{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}" alt="Logo">
                </a>
            </div>

            <!-- Right Section: Contact Information -->
            <div class="flex items-center contact-section">
                <a href="#" class="inline-flex items-center">
                    <img src="{{ asset('storage/icons/telfon.svg') }}" alt="telfon" class="h-4 w-4 mr-1.5">
                    <span class="font-roboto text-sm font-medium leading-4.5 tracking-wide text-left">(042) 883219</span>
                </a>
            </div>
        </div>
    </div>


    <!-- First Row -->
    <div class="max-w-[90%] mx-auto px-2 sm:px-6 lg:px-8 " id="fristrowheader">
        <div class="flex space-x-2.5 justify-center h-10 mx-auto" id="subfrstrowheader">
            <!-- Left Side (Logo and Company Name) -->
            <div class="flex items-center" id="firstrowlogo" >
                <a href="https://andalprima.hansmade.online/" class="ml-auto">
                    <img class="max-h-full w-auto h-10" src="https://andalprima.hansmade.online/storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png" alt="Logo">
                </a>
            </div>

            <!-- Cart Icon -->
            <div class="flex items-center" id="headerkeranjang" style="width: 5%">
                <a href="https://andalprima.hansmade.online/" class="inline-flex items-center justify-center bg-[#E01535] text-white px-3 py-1.5 rounded space-x-1 w-full">
                    <img src="{{ asset('storage/icons/keranjang.svg') }}" alt="keranjang" class="h-4 w-4">
                    <span id="keranjang" class="font-roboto text-sm font-normal leading-4.5 tracking-wide text-center">0</span>
                </a>
            </div>

            <!-- Search and Category -->
            <div class="relative flex items-center" id="headerpencarian" style="width: 60%">
                <button id="category" class="bg-[#FFFFFF] h-8 px-2 pr-3 rounded-l-md text-sm border border-gray-300 focus:outline-none flex items-center justify-center" style="width: 25%">
                    <img src="{{ asset('storage/icons/category.svg') }}" alt="category" class="h-4 w-4 mr-1.5">
                    <span class="font-roboto text-sm font-normal leading-4.5 tracking-wide text-left">Category</span>
                </button>
                <div class="relative w-full">
                    <img src="{{ asset('storage/icons/pencarian.svg') }}" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4" alt="Search Icon">
                    <input
                        type="text"
                        id="searchproduct"
                        class="bg-[#FFFFFF] w-full h-8 pl-10 pr-5 rounded-r-md text-sm border border-[#DADCE0] focus:outline-none"
                        placeholder="Search for products, types, and brands"
                    />
                </div>
            </div>

            <!-- Contact Info -->
            <div class="flex items-center" id="firstrownomor">
                <a href="#" class="inline-flex items-center w-full">
                    <img src="{{ asset('storage/icons/telfon.svg') }}" alt="telfon" class="h-4 w-4 mr-1.5">
                    <span class="font-roboto text-md font-medium leading-4.5 tracking-wide text-left">(042) 883219</span>
                </a>
            </div>
        </div>
    </div>


    <!-- Second Row -->
    <div id="secondrow" class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 ">
        <div id="dropdownOverlay2" class="hidden fixed inset-0 mt-12 h-10 bg-black bg-opacity-50" style="z-index: 41"></div>

        <div class="flex mx-auto justify-between h-10">
            <div class="flex justify-center h-10 mx-auto overflow-x-auto nanonano whitespace-nowrap scrollbar-hide">
                <!-- Navbar links -->
                <div class="space-x-1 sm:-my-px sm:ml-3 sm:flex mx-auto" id="nanonanolist">
                    <a href="https://andalprima.hansmade.online/" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/untuk-anda-gray.svg') }}" alt="Untuk Anda" class="h-5 w-5 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/untuk-anda-red.svg') }}" alt="Untuk Anda" class="h-5 w-5 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" id="untukanda" >Untuk Anda</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=2" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-hollow-gray.svg') }}" alt="Besi Hollow" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-hollow-red.svg') }}" alt="Besi Hollow" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="2">Besi Hollow dan Pipa Bulat</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=3" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-kawat-gray.svg') }}" alt="Besi Kawat" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-kawat-red.svg') }}" alt="Besi Kawat" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="3">Besi Kawat</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=5" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/plat-besi-gray.svg') }}" alt="Plat Besi" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/plat-besi-red.svg') }}" alt="Plat Besi" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="5" >Plat Besi</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=7" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-batang-gray.svg') }}" alt="Besi Batangan" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-batang-red.svg') }}" alt="Besi Batangan" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="7" >Besi Batangan</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=8" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/baja-ringan-gray.svg') }}" alt="Baja Ringan" class="h-5 w-5 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/baja-ringan-red.svg') }}" alt="Baja Ringan" class="h-5 w-5 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="8" >Baja Ringan</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=9" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/plat-gelombang-gray.svg') }}" alt="Plat Gelombang" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/plat-gelombang-red.svg') }}" alt="Plat Gelombang" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="9" >Plat Gelombang</span>
                    </a>
                    <a href="https://andalprima.hansmade.online/view-productid?product_id=10" class="group flex items-center text-gray-900 hover:text-[#E01535] px-2 py-0 rounded-md text-sm font-medium underline-hover">
                        <img src="{{ asset('storage/icons/besi-structural-gray.svg') }}" alt="Besi Profil Struktural" class="h-4 w-4 mr-1 group-hover:hidden">
                        <img src="{{ asset('storage/icons/besi-structural-red.svg') }}" alt="Besi Profil Struktural" class="h-4 w-4 mr-1 hidden group-hover:block">
                        <span class="font-roboto text-xs font-normal leading-4.5 tracking-wide text-left group-hover:text-[#E01535] text-[#747474]" value-product-id="10" >Besi Profil Struktural</span>
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

<style>
     .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;     /* Firefox */
    }

    @media (min-width: 450px){
        #rowhiddenheader{
            display: none;
        }
    }
    /* Style untuk layar di bawah 450px */
    @media (max-width: 450px) {
        #firstrowlogo, #firstrownomor{
            display: none;
        }
        #headerkeranjang {
            width: 10% !important;
        }
        #headerpencarian{
            width: 80% !important;
        }
        #nanonanolist {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            -ms-overflow-style: none;
            scrollbar-width: none;
            width: 80%;
        }
    }

    /* Responsive styling */
    /* @media (max-width: 1440px) {
        .nanonano {
            overflow-x: auto;
        }

    } */

    /* @media (min-width: 429px) { */
        /* Tampilkan elemen first-row dan sembunyikan hidden-row di layar besar */
        /* .first-row-logo, */
        /* .first-row-nomor { */
            /* display: flex; Tampilkan elemen first-row */
        /* } */

        /* .hidden-row, */
        /* .hidden-row-logo, */
        /* .hidden-row-nomor { */
            /* display: none; Sembunyikan elemen hidden-row */
        /* } */

    /* } */
    /* Responsive styling for screen width 428px or smaller */
    /* @media (max-width: 428px) { */
        /* .relative.flex.items-center { */
            /* width: 90%; Total width for container */
        /* } */

        /* Adjust button width to fit within 331px container */
        /* #category { */
            /* width: 80px; Adjusted width for smaller screens */
            /* padding: 0 0.5rem; */
            /* font-size: 0.75rem; Adjust font size if needed */
        /* } */

        /* Adjust search input width to fit within 331px container */
        /* #search-input { */
            /* width: 100%; Full width minus the button width */
            /* font-size: 0.75rem; Adjust font size if needed */
            /* padding-left: 2.5rem; Space for search icon */
            /* padding-right: 0.5rem; Reduced padding for smaller screens */
        /* } */

        /* .first-row-logo, */
        /* .first-row-nomor { */
            /* display: none; Sembunyikan elemen first-row */
        /* } */

        /* .hidden-row, */
        /* .hidden-row-logo, */
        /* .hidden-row-nomor { */
            /* display: flex; Tampilkan elemen hidden-row */
        /* } */


        /* Ensure each link item stays in one row */
        /* .space-x-1 > a { */
            /* flex-shrink: 0; Prevent items from shrinking */
        /* } */

         /* Container for horizontal scrolling */


        /* Hides scrollbar in WebKit browsers */
        /* .nanonanolist::-webkit-scrollbar { */
            /* display: none; */
        /* } */

        /* Adjust spacing between links */
        /* .nanonanolist .space-x-1 > a { */
            /* flex-shrink: 0; Prevent items from shrinking */
            /* margin-right: 8px; Space between items */
        /* } */
    /* } */
</style>
<!-- Call the header script with Vite -->
@vite('resources/js/header-script.js')

