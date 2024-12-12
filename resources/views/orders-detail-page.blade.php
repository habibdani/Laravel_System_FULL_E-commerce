@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Dashboard Content -->
        <div class="flex-1 p-4">

            <!-- Order Details Section -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 id="order-id" class="text-xl font-semibold">Order Details: #1</h2>
                    <p id="order-date" class="text-sm text-gray-500">22 August 2024 - 15:47</p>
                </div>
                <div class="flex items-center">
                    <span>Status: </span>
                    <span id="order-status" class="ml-2 bg-green-100 text-white text-xs font-medium px-2.5 py-1 rounded">Delivered</span>
                </div>
            </div>

            <!-- Shipping Address Section -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Shipping Address</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Name:</strong> <span id="client-name">John Doe</span></p>
                        <p><strong>Address:</strong> <span id="client-address">123 Main St</span></p>
                        <p><strong>City:</strong> <span id="client-city">Jakarta Utara</span></p>
                    </div>
                    <div>
                        <p><strong>Kode Pos:</strong> <span id="client-code-pos">12345</span></p>
                        <p><strong>Phone:</strong> <span id="client-phone">123456789</span></p>
                        <p><strong>Email:</strong> <span id="client-email">john@example.com</span></p>
                    </div>
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Product Details</h3>
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="w-full bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Product</th>
                            <th class="py-3 px-6 text-left">Variant Detail</th>
                            <th class="py-3 px-6 text-center">Quantity</th>
                            <th class="py-3 px-6 text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="product-list" class="text-gray-600 text-sm font-light">
                        <!-- Rows will be populated dynamically using JavaScript -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @vite('resources/js/orderDetail-script.js')
@endsection
