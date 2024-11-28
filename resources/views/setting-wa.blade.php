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
        let waInfoData = {}; // Menyimpan data Info WA untuk edit dan save

        // Fungsi untuk mengambil data WA dari API
        async function fetchInfoWA() {
            try {
                const response = await fetch('/api/info-wa'); // Endpoint API untuk Info WA
                const data = await response.json();

                if (data.success) {
                    waInfoData = data.data; // Simpan data untuk pengeditan
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
        async function updateInfoWA() {
            try {
                const payload = {
                    nama: document.getElementById('editNama').value,
                    nomorwa: document.getElementById('editNomorWA').value,
                };

                const response = await fetch(`/api/info-wa`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
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
                <td>
                    <input type="text" id="editNama" value="${waInfo.nama}" class="form-control">
                </td>
                <td>
                    <input type="text" id="editNomorWA" value="${waInfo.nomorwa}" class="form-control">
                </td>
                <td class="text-center">
                    <button class="btn btn-success btn-sm" onclick="updateInfoWA()">Save</button>
                </td>
            `;

            // Tambahkan row ke table body
            tableBody.appendChild(row);
        }

        // Panggil fungsi fetchInfoWA saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchInfoWA);
    </script>

<style>
    /* Style untuk Tombol Save */
    .btn-success {
        background-color: #28a745; /* Warna hijau */
        border: none;
        color: #fff;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838; /* Warna hover hijau gelap */
        transform: scale(1.05); /* Efek zoom */
    }

    td {
        padding: 8px 12px; /* Padding vertikal dan horizontal */
    }

    input.form-control {
        width: 100%;
        padding: 6px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
    }
</style>
@endsection
