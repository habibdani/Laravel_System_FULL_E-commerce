<nav class="fixed top-0 w-full z-50">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex justify-between items-center">
            <!-- Left Section (Hamburger Menu and Logo) -->
            <div class="flex items-center space-x-4">
                <!-- Hamburger Menu Icon -->
                <button class="text-gray-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>


                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}" alt="Logo" class="h-8">
                </div>
            </div>

            <!-- Right Section (Circular Logo) -->
            <div class="flex items-center">
                <div class="bg-white shadow-lg rounded-full overflow-hidden p-2">
                    <img src="{{ asset('storage/images/42fae1c1b268b3fa7e2244d96f1b27d0.png') }}" alt="Notifications" class="object-left h-6 w-6 object-cover">
                </div>
            </div>
        </div>
    </div>
</nav>
