@extends('layouts.app')

@section('title', 'List Pengaturan')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">List Pengaturan</h1>
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th>Pengaturan</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting Banner Besar</td>
                            <td class="text-center">Kelola data untuk banner besar</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-banner-besar') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting Banner Kecil</td>
                            <td class="text-center">Kelola data untuk banner kecil</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-banner-kecil') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting No Rekening</td>
                            <td class="text-center">Kelola data rekening yang digunakan</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-rekening') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting No WA</td>
                            <td class="text-center">Kelola nomor WhatsApp yang digunakan</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-wa') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting Special Product </td>
                            <td class="text-center">Kelola image special product</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-specialproduct') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                        <tr class="align-middle" style="height: 60px !important">
                            <td class="text-center">Setting background kecil </td>
                            <td class="text-center">Kelola image background kecil</td>
                            <td class="text-center">
                                <a href="{{ url('/dashboard/setting/list-banner-kecil-2') }}" class="btn btn-gradient btn-rounded">Kelola</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


<style>
 /* Gaya untuk Judul */
    .text-primary {
        color: #d9534f; /* Warna branding */
        text-transform: uppercase;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    /* Tabel Styling */
    .table-hover tbody tr:hover {
        background-color: #f9f9f9; /* Warna hover lebih cerah */
    }

    .table-bordered {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #343a40; /* Header gelap */
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
    }

    .table tbody tr {
        margin-bottom: 10px;
    }

    /* Tombol */
    .btn-gradient {
        background: linear-gradient(45deg, #ff512f, #dd2476);
        color: #fff;
        border: none;
        padding: 8px 15px;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #dd2476, #ff512f);
        color: #fff;
        transform: scale(1.05);
    }

    .btn-rounded {
        border-radius: 50px; /* Membuat tombol bulat */
        box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
    }

    /* Tambahkan jarak antar baris */
    .table tbody tr {
        margin-bottom: 15px;
        border-spacing: 10px;
    }


</style>