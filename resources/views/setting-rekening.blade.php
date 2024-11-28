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
                <!-- <button class="btn btn-success mb-3" onclick="addRekeningRow()">Add Rekening</button> -->
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
        let rekenings = []; // Data rekening

        // Fungsi untuk mengambil semua data rekening dari API
        async function fetchRekening() {
            try {
                const response = await fetch('/api/info-rekening');
                const data = await response.json();

                if (data.success) {
                    rekenings = data.data; // Simpan data rekening
                    renderTable(rekenings);
                } else {
                    alert(data.message || 'Failed to fetch rekening');
                }
            } catch (error) {
                console.error('Error fetching rekening:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
        }

        // Fungsi untuk menambahkan baris baru untuk rekening
        function addRekeningRow() {
            const tableBody = document.getElementById('rekeningTable');

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">New</td>
                <td><input type="text" class="form-control" id="newNama"></td>
                <td><input type="text" class="form-control" id="newNomorRekening"></td>
                <td><input type="text" class="form-control" id="newNamaBank"></td>
                <td class="text-center">
                    <button class="btn btn-success btn-sm" onclick="saveNewRekening()">Save</button>
                    <button class="btn btn-secondary btn-sm" onclick="fetchRekening()">Cancel</button>
                </td>
            `;
            tableBody.appendChild(row);
        }

        // Fungsi untuk menyimpan rekening baru
        async function saveNewRekening() {
            // Ambil nilai input
            const nama = document.getElementById('newNama').value.trim();
            const nomorRekening = document.getElementById('newNomorRekening').value.trim();
            const namaBank = document.getElementById('newNamaBank').value.trim();

            // Validasi input
            if (!nama) {
                alert('Nama tidak boleh kosong!');
                return;
            }

            if (!nomorRekening) {
                alert('Nomor rekening tidak boleh kosong!');
                return;
            }

            if (!/^\d+$/.test(nomorRekening)) {
                alert('Nomor rekening hanya boleh berisi angka!');
                return;
            }

            if (nomorRekening.length < 7 || nomorRekening.length > 20) {
                alert('Nomor rekening harus terdiri dari 7 hingga 20 karakter!');
                return;
            }

            if (!namaBank) {
                alert('Nama bank tidak boleh kosong!');
                return;
            }

            if (namaBank.length > 50) {
                alert('Nama bank tidak boleh lebih dari 50 karakter!');
                return;
            }

            // Buat payload jika validasi berhasil
            const payload = {
                nama,
                nomor_rekening: nomorRekening,
                nama_bank: namaBank,
            };

            try {
                const response = await fetch('/api/info-rekening', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });
                const data = await response.json();

                if (data.success) {
                    alert('Rekening berhasil dibuat.');
                    fetchRekening(); // Refresh tabel
                } else {
                    alert(data.message || 'Failed to create rekening');
                }
            } catch (error) {
                console.error('Error creating rekening:', error);
                alert('Terjadi kesalahan saat membuat rekening.');
            }
        }


        // Fungsi untuk menghapus rekening berdasarkan ID
        async function deleteRekening(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus rekening ini?')) return;

            try {
                const response = await fetch(`/api/info-rekening/${id}`, {
                    method: 'DELETE',
                });
                const data = await response.json();

                if (data.success) {
                    alert('Rekening berhasil dihapus.');
                    fetchRekening(); // Refresh tabel
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
            tableBody.innerHTML = ''; // Bersihkan data sebelumnya

            if (rekenings.length === 0) {
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
                    <td><input type="text" class="form-control" value="${rekening.nama}" id="editNama-${rekening.id}"></td>
                    <td><input type="text" class="form-control" value="${rekening.nomor_rekening}" id="editNomorRekening-${rekening.id}"></td>
                    <td><input type="text" class="form-control" value="${rekening.nama_bank}" id="editNamaBank-${rekening.id}"></td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm" onclick="saveUpdatedRekening(${rekening.id})">Save</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteRekening(${rekening.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Fungsi untuk menyimpan pembaruan rekening
        async function saveUpdatedRekening(id) {
            const payload = {
                nama: document.getElementById(`editNama-${id}`).value,
                nomor_rekening: document.getElementById(`editNomorRekening-${id}`).value,
                nama_bank: document.getElementById(`editNamaBank-${id}`).value,
            };

            console.log('check',payload);
            console.log('check',id);
            try {
                const response = await fetch(`/api/info-rekening/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });
                const data = await response.json();

                if (data.success) {
                    alert('Rekening berhasil diperbarui.');
                    fetchRekening(); // Refresh tabel
                } else {
                    alert(data.message || 'Failed to update rekening');
                }
            } catch (error) {
                console.error('Error updating rekening:', error);
                alert('Terjadi kesalahan saat memperbarui rekening.');
            }
        }

        // Panggil fungsi fetchRekening saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchRekening);
    </script>

<style>
    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }

    .btn-danger:hover {
        transform: scale(1.05);
    }

    td {
        padding: 8px 12px;
    }
</style>
@endsection
