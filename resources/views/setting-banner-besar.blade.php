@extends('layouts.app')

@section('title', 'List Banner Besar')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">List Banner Besar</h1>
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Tittle</th>
                            <th>Description</th>
                            <th>Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bannerBesarTable">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengambil data banner besar dari API
        async function fetchBannerBesar() {
            try {
                const response = await fetch('/api/banner-besar'); // Pastikan endpoint API Anda benar
                const data = await response.json();

                if (data.success) {
                    renderTable(data.data); // Panggil fungsi renderTable dengan data dari API
                } else {
                    alert(data.message || 'Failed to fetch banners');
                }
            } catch (error) {
                console.error('Error fetching banners:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
        }

        // Fungsi untuk menghapus banner besar
        async function deleteBannerBesar(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus banner ini?')) return;

            try {
                const response = await fetch(`/api/banner-besar/${id}`, {
                    method: 'DELETE',
                });
                const result = await response.json();

                if (result.success) {
                    alert('Banner berhasil dihapus.');
                    fetchBannerBesar(); // Refresh data
                } else {
                    alert(result.message || 'Failed to delete banner');
                }
            } catch (error) {
                console.error('Error deleting banner:', error);
                alert('Terjadi kesalahan saat menghapus banner.');
            }
        }

        // Fungsi untuk merender data ke dalam tabel
        function renderTable(banners) {
            const tableBody = document.getElementById('bannerBesarTable');
            tableBody.innerHTML = ''; // Clear previous data

            if (banners.length === 0) {
                // Jika tidak ada data, tampilkan pesan kosong
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data banner besar.</td>
                    </tr>
                `;
                return;
            }

            banners.forEach((banner, index) => {
                // Hapus http://127.0.0.1:8000 dari URL gambar
                const imagePath = banner.image.replace('http://127.0.0.1:8000', '').trim();

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="text-center">${index + 1}</td>
                    <td >${banner.tittle || 'No Title'}</td>
                    <td>${banner.description || 'No Description'}</td>
                    <td>
                        <img src="${imagePath}" alt="${banner.tittle}" class="h-32 w-32 object-cover rounded-lg">
                    </td>
                    <td class="text-center">
                        <a href="/form-banner-besar?id=${banner.id}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteBannerBesar(${banner.id})">Delete</button>
                    </td>
                `;

                // Tambahkan row ke table body
                tableBody.appendChild(row);
            });
        }

        // Panggil fungsi fetchBannerBesar saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchBannerBesar);
    </script>

<style>
    /* Style untuk Tombol Edit */
.btn-warning {
    background-color: #ffc107; /* Warna kuning */
    border: none;
    color: #212529; /* Teks gelap */
    padding: 6px 12px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.btn-warning:hover {
    background-color: #e0a800; /* Warna hover kuning gelap */
    color: #fff; /* Teks putih */
    transform: scale(1.05); /* Efek zoom */
}

td {
    padding: 8px 12px; /* Padding vertikal dan horizontal */
}
/* Style untuk Tombol Delete */
.btn-danger {
    background-color: #dc3545; /* Warna merah */
    border: none;
    color: #fff;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease-in-out;
}

.btn-danger:hover {
    background-color: #c82333; /* Warna hover merah gelap */
    transform: scale(1.05); /* Efek zoom */
}

/* Tambahkan jarak antara tombol */
.table td .btn {
    margin-right: 5px;
}

</style>
@endsection
