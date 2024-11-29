<div class="w-64 h-screen p-4 text-gray-600">
    <ul>
        <!-- Dashboard Section -->
        <li class="mb-6">
            <a href="#" class="flex items-center px-3 py-2">
                <img src="{{ secure_asset('storage/icons/diagram.svg') }}" alt="diagram" class="h-5 w-5 mr-3">
                <span class="font-roboto text-sm font-bold leading-5 tracking-wide text-left text-[#E01535]">Dashboard</span>
            </a>
        </li>

        <!-- App Section -->
        <div class="flex items-center mb-2">
            <span class="text-xs font-semibold text-[#999999] uppercase">App</span>
            <hr class="ml-2 flex-grow border-t border-gray-300">
        </div>

        <!-- E-Commerce Dropdown -->
        <li class="mb-4">
            <a href="javascript:void(0)" class="flex items-center px-3 py-2 justify-between" id="ecommerceToggle">
                <div class="flex items-center">
                    <img src="{{ secure_asset('storage/icons/keranjang-gray.svg') }}" alt="ecommerce" class="h-5 w-5 mr-3">
                    <span class="font-roboto text-sm font-normal leading-5 tracking-wide text-left text-[#999999]">E Commerce</span>
                </div>
                <svg id="dropdownArrow" class="transition-transform duration-300" width="8" height="5" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.12891 1.10229L3.90118 4.32983L0.673645 1.10229" stroke="#ADADAD" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <!-- Product and Orders links - initially hidden -->
            <ul id="ecommerceMenu" class="ml-8 mt-2 space-y-2 hidden transition-all duration-300 ease-in-out">
                <li>
                    <a href="{{ route('dashboard.product') }}" class="text-sm font-roboto text-[#999999]">Product</a>
                </li>
                <li>
                    <a href="{{route('dashboard.orders')}}" class="text-sm font-roboto text-[#999999]">Orders</a>
                </li>
                <li>
                    <a href="{{route('dashboard.setting')}}" class="text-sm font-roboto text-[#999999]">Setting</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.getElementById("ecommerceToggle");
        const dropdownMenu = document.getElementById("ecommerceMenu");
        const dropdownArrow = document.getElementById("dropdownArrow");

        toggleButton.addEventListener("click", function () {
            // Toggle the visibility of the dropdown menu
            dropdownMenu.classList.toggle("hidden");

            // Add animation: rotate the arrow
            dropdownArrow.classList.toggle("rotate-180");

            // Optionally animate the dropdown height (smooth expand/collapse)
            if (!dropdownMenu.classList.contains("hidden")) {
                dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + "px";
            } else {
                dropdownMenu.style.maxHeight = 0;
            }
        });
    });
</script>
