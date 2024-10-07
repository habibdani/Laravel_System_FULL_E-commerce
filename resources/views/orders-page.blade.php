@extends('layouts.app')

@section('title', 'Orders')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Dashboard Content -->
        <div class="flex-1 p-4">
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    <img src="{{ asset('storage/icons/Keranjang-black.svg') }}" alt="Orders" class="h-5 w-5 mr-2">
                    <span class="font-roboto text-[20px] font-semibold leading-4.5 tracking-wide text-left text-black">Orders</span>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" placeholder="Cari email, nama, alamat" class="w-full border rounded-md p-2 text-sm">
            </div>

            <!-- Orders Table -->
            <div class="bg-white shadow-md rounded-lg">
                <table class="min-w-full text-left text-sm text-gray-500">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                <input type="checkbox" class="h-4 w-4">
                            </th>
                            <th scope="col" class="px-6 py-3">Order</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">Ship To</th>
                            <th scope="col" class="px-6 py-3">Update Terakhir</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Amount</th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Order Row 1 -->
                        <tr class="border-b">
                            <td class="p-4">
                                <input type="checkbox" class="h-4 w-4">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">#2 by Budi</div>
                                <div class="text-sm text-blue-500">budisetiawan@gmail.com</div>
                            </td>
                            <td class="px-6 py-4">5 Mei 2024 - 21:44</td>
                            <td class="px-6 py-4">
                                Jl. Kesehatan, No.25, Karang Ranji, Jakarta Selatan, 43327
                            </td>
                            <td class="px-6 py-4">5 Mei 2024 - 21:44</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                            </td>
                            <td class="px-6 py-4">Rp. 350.700</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12l4-4m0 8l4-4" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <!-- Example Order Row 2 -->
                        <tr class="border-b">
                            <td class="p-4">
                                <input type="checkbox" class="h-4 w-4">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">#1 by Putri</div>
                                <div class="text-sm text-blue-500">putrimawar@gmail.com</div>
                            </td>
                            <td class="px-6 py-4">3 Mei 2024 - 17:00</td>
                            <td class="px-6 py-4">
                                Jl. Kunciran, No.25, Gunung Mawar, Jakarta Utara, 23034
                            </td>
                            <td class="px-6 py-4">3 Mei 2024 - 17:00</td>
                            <td class="px-6 py-4">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>
                            </td>
                            <td class="px-6 py-4">Rp. 200.000</td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-600 hover:text-gray-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12l4-4m0 8l4-4" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-4">
                    <nav class="flex justify-center">
                        <a href="#" class="px-3 py-1 border rounded-md">1</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your JS -->
    {{-- @vite('resources/js/ordersDashboard-script.js') --}}
@endsection
