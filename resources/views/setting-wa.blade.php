@extends('layouts.app')

@section('title', 'Info WA')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">Info WA</h1>
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Nomor WA</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="infoWaTable">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengambil data WA dari API
        async function fetchInfoWA() {
            try {
                const response = await fetch('/api/info-wa'); // Endpoint API untuk Info WA
                const data = await response.json();

                if (data.success) {
                    renderTable(data.data); // Panggil fungsi renderTable dengan data dari API
                } else {
                    alert(data.message || 'Failed to fetch WA info');
                }
            } catch (error) {
                console.error('Error fetching WA info:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
        }

        // Fungsi untuk memperbarui data WA
        async function updateInfoWA(id, payload) {
            try {
                const response = await fetch(`/api/info-wa`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload), // Kirim data sebagai JSON
                });
                const data = await response.json();

                if (data.success) {
                    alert('Info WA berhasil diperbarui.');
                    fetchInfoWA(); // Refresh data
                } else {
                    alert(data.message || 'Failed to update WA info');
                }
            } catch (error) {
                console.error('Error updating WA info:', error);
                alert('Terjadi kesalahan saat memperbarui WA info.');
            }
        }

        // Fungsi untuk merender data ke dalam tabel
        function renderTable(waInfo) {
            const tableBody = document.getElementById('infoWaTable');
            tableBody.innerHTML = ''; // Clear previous data

            if (!waInfo) {
                // Jika tidak ada data, tampilkan pesan kosong
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data WA.</td>
                    </tr>
                `;
                return;
            }

            // Buat elemen row untuk Info WA
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">1</td>
                <td>${waInfo.nama || 'No Name'}</td>
                <td>${waInfo.nomorwa || 'No WA'}</td>
                <td class="text-center">
                    <a href="/form-info-wa?id=${waInfo.id}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            `;

            // Tambahkan row ke table body
            tableBody.appendChild(row);
        }

        // Panggil fungsi fetchInfoWA saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchInfoWA);
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
</style>
@endsection
