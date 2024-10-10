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
                        <!-- List order akan dirender di sini melalui JavaScript -->
                    </tbody>
                </table>

                <div class="p-4 flex justify-between items-center">
                    <button id="prev-page" class="bg-gray-300 text-gray-700 px-4 py-2 rounded" disabled>Previous</button>
                    <div class="pagination-container">Menampilkan halaman 1 dari 10</div>
                    <button id="next-page" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Next</button>
                </div>
            </div>
        </div>
    </div>

    @vite('resources/js/orderDashboard-script.js')
@endsection
