@extends('layouts.app')

@section('title', 'List Rekening')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">List Rekening</h1>
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Bank</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="rekeningTable">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    // Fungsi untuk mengambil semua data rekening dari API
    async function fetchRekening() {
        try {
            const response = await fetch('/api/info-rekening'); // Endpoint Read All
            const data = await response.json();

            if (data.success) {
                renderTable(data.data); // Panggil fungsi renderTable dengan data dari API
            } else {
                alert(data.message || 'Failed to fetch rekening');
            }
        } catch (error) {
            console.error('Error fetching rekening:', error);
            alert('Terjadi kesalahan saat mengambil data.');
        }
    }

    // Fungsi untuk mengambil data rekening berdasarkan ID
    async function fetchRekeningById(id) {
        try {
            const response = await fetch(`/api/info-rekening/${id}`); // Endpoint Read Single
            const data = await response.json();

            if (data.success) {
                return data.data; // Kembalikan data rekening berdasarkan ID
            } else {
                alert(data.message || 'Failed to fetch rekening details');
                return null;
            }
        } catch (error) {
            console.error('Error fetching rekening by ID:', error);
            alert('Terjadi kesalahan saat mengambil detail rekening.');
            return null;
        }
    }

    // Fungsi untuk membuat data rekening baru
    async function createRekening(payload) {
        try {
            const response = await fetch('/api/info-rekening', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload), // Kirim data sebagai JSON
            });
            const data = await response.json();

            if (data.success) {
                alert('Rekening berhasil dibuat.');
                fetchRekening(); // Refresh data
            } else {
                alert(data.message || 'Failed to create rekening');
            }
        } catch (error) {
            console.error('Error creating rekening:', error);
            alert('Terjadi kesalahan saat membuat rekening.');
        }
    }

    // Fungsi untuk memperbarui data rekening berdasarkan ID
    async function updateRekening(id, payload) {
        try {
            const response = await fetch(`/api/info-rekening/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload), // Kirim data sebagai JSON
            });
            const data = await response.json();

            if (data.success) {
                alert('Rekening berhasil diperbarui.');
                fetchRekening(); // Refresh data
            } else {
                alert(data.message || 'Failed to update rekening');
            }
        } catch (error) {
            console.error('Error updating rekening:', error);
            alert('Terjadi kesalahan saat memperbarui rekening.');
        }
    }

    // Fungsi untuk menghapus data rekening berdasarkan ID
    async function deleteRekening(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus rekening ini?')) return;

        try {
            const response = await fetch(`/api/info-rekening/${id}`, {
                method: 'DELETE',
            });
            const data = await response.json();

            if (data.success) {
                alert('Rekening berhasil dihapus.');
                fetchRekening(); // Refresh data
            } else {
                alert(data.message || 'Failed to delete rekening');
            }
        } catch (error) {
            console.error('Error deleting rekening:', error);
            alert('Terjadi kesalahan saat menghapus rekening.');
        }
    }

    // Fungsi untuk merender data ke dalam tabel
    function renderTable(rekenings) {
        const tableBody = document.getElementById('rekeningTable');
        tableBody.innerHTML = ''; // Clear previous data

        if (rekenings.length === 0) {
            // Jika tidak ada data, tampilkan pesan kosong
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data rekening.</td>
                </tr>
            `;
            return;
        }

        rekenings.forEach((rekening, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">${index + 1}</td>
                <td>${rekening.nama || 'No Name'}</td>
                <td>${rekening.nomor_rekeneing || 'No Rekening'}</td>
                <td>${rekening.nama_bank || 'No Bank'}</td>
                <td class="text-center">
                    <a href="/form-rekening?id=${rekening.id}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="deleteRekening(${rekening.id})">Delete</button>
                </td>
            `;

            // Tambahkan row ke table body
            tableBody.appendChild(row);
        });
    }

    // Panggil fungsi fetchRekening saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchRekening);
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
