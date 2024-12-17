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
                            <th class="py-3 px-6 text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="product-list" class="text-gray-600 text-sm font-light">
                        <!-- Rows will be populated dynamically using JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- <div class="bg-white shadow-md rounded-lg p-6 sidebar-product-card flex items-start justify-between h-1/3 w-full bg-[#F4F4F4] rounded-md">
                <img src="${productImage}" alt="Produk" class="w-[75px] h-[75px] object-cover rounded-md">
                <div class="ml-3 space-y-1 flex-1">
                    <p id="sidebar-product-id-${productVariantId}" value-sidebar-product-id="${productVariantId}" class="text-sm font-semibold truncate border-b-2 border-[#D9D9D9] pb-[1px]">
                        ${productVariantName}
                    </p>
                    <p class="text-[#707070] font-normal text-[12px]">Detail:</p>
                    <div id="detail-product-sidebar-${productVariantId}" class="sidebar-list-varaint-label space-y-1">
                        ${variantDetails.length > 0 ? variantDetails.map(detail => `
                        <p id="sidebar_label_variant_item_type_${productVariantId}_${detail.variant_item_type_id}" class="text-[12px] font-normal text-[#292929]" sidebar_variant_item_type_id="${detail.variant_item_type_id}">
                            ${detail.variant_item_type_name}:
                            <span id="sidebar_variant_item_${productVariantId}_${detail.variant_item_id}" sidebar_variant_item_id="${detail.variant_item_id}">
                                ${detail.variant_item_name}
                            </span>
                        </p>
                        `).join('') : '<p class="text-[12px] font-normal text-[#707070]">Tidak ada varian</p>'}
                    </div>
                    <div id="sidebar_price_product_${productVariantId}" sidebar_value_price="${price}" sidebar_price_satuan="${pricesatuan}" class="bg-white w-5/6 p-1 rounded-md">
                        <p class="text-[12px] font-normal">Total Harga:
                            <span id="sidebar-price-text-${productVariantId}" class="text-[12px] font-semibold">${priceDisplay}</span>
                        </p>
                    </div>
                    <div class="flex pr-4 justify-between pt-2 w-full items-center mb-2">
                        <div class=" flex items-center border bg-[#E01535] rounded-md py-1">
                            <button id="sidebar-decrease-${productVariantId}" class="p-2 h-full text-gray-700 focus:outline-none">
                                <svg width="13" height="4" viewBox="0 0 13 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="12.3574" y="0.718262" width="2.77002" height="11.8347" transform="rotate(90 12.3574 0.718262)" fill="white"/>
                                </svg>
                            </button>
                            <input id="sidebar-quantity-${productVariantId}" type="text" disabled value="${qty}" class="w-7 bg-[#E01535] text-center font-semibold border-none focus:outline-none text-white" min="1" oninput="this.value = this.value.replace(/[^0-9]/g, '');"/>
                            <button id="sidebar-increase-${productVariantId}" class="px-2 h-full text-gray-700 focus:outline-none">
                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="12.1514" y="4.71851" width="2.77002" height="11.8347" transform="rotate(90 12.1514 4.71851)" fill="white"/>
                                    <rect x="7.61914" y="12.0208" width="2.77002" height="11.8347" transform="rotate(-180 7.61914 12.0208)" fill="white"/>
                                </svg>
                            </button>
                        </div>
                        <button id="sidebar-product-deleted-${productVariantId}" class="px-2 inline-flex items-center bg-white text-white py-2 rounded focus:outline-none">
                            <img src="/storage/icons/sampah.svg" alt="sampah" class="h-4 w-4">
                            <span class="font-roboto text-[16px] font-semibold leading-4.5 tracking-wide text-left"></span>
                        </button>
                    </div>
                </div>
            </div> -->

        </div>
    </div>

    @vite('resources/js/orderDetail-script.js')
@endsection
