@extends('layouts.app')

@section('title', 'List Banner Kecil')

@section('content')
    @component('components.header-dashboard') @endcomponent

    <div class="max-w-[1200px] mx-auto mt-[54px] flex">
        <!-- Sidebar -->
        @component('components.sidebar-dashboard') @endcomponent

        <!-- Main Content -->
        <div class="w-full p-4">
            <div class="container mt-5">
                <h1 class="mb-4 text-center text-primary font-bold">Product Special</h1>
                <!-- <button class="btn btn-success mb-3" onclick="addBannerRow()">Add Banner</button> -->
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>TEXT</th>
                            <th>Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="imagespecial">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <script>
        const API_BASE_URL = 'http://127.0.0.1:8001';
        let banners = []; // Data banners

        // Fungsi untuk mengambil data banner kecil
        async function fetchBannerKecil() {
            try {
                const response = await fetch(`${API_BASE_URL}/api/product-special`);
                const data = await response.json();

                if (data.success) {
                    banners = data.data; // Simpan data banners
                    renderTable(banners);
                } else {
                    alert(data.message || 'Failed to fetch banners');
                }
            } catch (error) {
                console.error('Error fetching banners:', error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
        }

        // Fungsi untuk menambahkan baris baru
        // function addBannerRow() {
        //     const tableBody = document.getElementById('imagespecial');

        //     const row = document.createElement('tr');
        //     row.innerHTML = `
        //         <td class="text-center">New</td>
        //         <td><input type="text" class="form-control" id="newText" placeholder="Masukkan text"></td>
        //         <td>
        //             <input type="file" class="form-control" id="newImage" onchange="uploadImage(event, 'newImagePreview')">
        //             <img id="newImagePreview" class="h-32 w-32 object-cover rounded-lg mt-2 hidden">
        //         </td>
        //         <td class="text-center">
        //             <button class="btn btn-success btn-sm" onclick="saveimagespecial()">Save</button>
        //             <button class="btn btn-secondary btn-sm" onclick="fetchBannerKecil()">Cancel</button>
        //         </td>
        //     `;
        //     tableBody.appendChild(row);
        // }

        // Fungsi untuk menyimpan banner baru
        async function saveimagespecial() {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = `${API_BASE_URL}/login`;
                return;
            }

            const text = document.getElementById('newText').value.trim();
            const imagePreview = document.getElementById('newImagePreview');
            const imageUrl = imagePreview.src;

            if (!text || imagePreview.classList.contains('hidden')) {
                alert('Semua field harus diisi.');
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}/api/product-special`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                    body: JSON.stringify({ text, image: imageUrl }),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Banner berhasil dibuat.');
                    fetchBannerKecil(); // Refresh daftar banner
                } else {
                    alert(data.message || 'Gagal membuat banner.');
                }
            } catch (error) {
                console.error('Error creating banner:', error);
                alert('Terjadi kesalahan saat membuat banner.');
            }
        }

        // Fungsi untuk merender tabel
        function renderTable(banners) {
            const tableBody = document.getElementById('imagespecial');
            tableBody.innerHTML = '';

            if (banners.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="4" class="text-center">Tidak ada data banner kecil.</td></tr>`;
                return;
            }

            banners.forEach((banner, index) => {
                const imagePath = banner.image.replace('http://127.0.0.1:8001', '').trim();
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="text-center">${index + 1}</td>
                    <td><input type="text" class="form-control" value="${banner.text}" id="editText-${banner.id}"></td>
                    <td>
                        <input type="file" class="form-control" onchange="uploadImage(event, 'editImagePreview-${banner.id}')">
                        <img src="${imagePath}" id="editImagePreview-${banner.id}" class="h-32 w-32 object-cover rounded-lg mt-2">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm" onclick="saveUpdatedBanner(${banner.id})">Save</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteBannerKecil(${banner.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Fungsi untuk menghapus banner kecil
        async function deleteBannerKecil(id) {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = `${API_BASE_URL}/login`;
                return;
            }

            // Konfirmasi sebelum menghapus
            if (!confirm('Apakah Anda yakin ingin menghapus banner ini?')) return;

            try {
                const response = await fetch(`${API_BASE_URL}/api/banner-kecil/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                    },
                });

                const data = await response.json();

                if (data.success) {
                    alert('Banner berhasil dihapus.');
                    fetchBannerKecil(); // Refresh daftar banner kecil
                } else {
                    alert(data.message || 'Gagal menghapus banner.');
                }
            } catch (error) {
                console.error('Error deleting banner:', error);
                alert('Terjadi kesalahan saat menghapus banner.');
            }
        }

        // Fungsi untuk memperbarui banner kecil
        async function saveUpdatedBanner(id) {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = `${API_BASE_URL}/login`;
                return;
            }

            // Ambil nilai input dari tabel
            const text = document.getElementById(`editText-${id}`).value.trim();
            const imagePreview = document.getElementById(`editImagePreview-${id}`);
            const imageUrl = imagePreview.src;

            // Validasi input
            if (!text || !imageUrl || imagePreview.classList.contains('hidden')) {
                alert('Semua field harus diisi.');
                return;
            }

            try {
                const response = await fetch(`${API_BASE_URL}/api/banner-kecil/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                    body: JSON.stringify({ text, image: imageUrl }),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Banner berhasil diperbarui.');
                    fetchBannerKecil(); // Refresh data banner kecil
                } else {
                    alert(data.message || 'Gagal memperbarui banner.');
                }
            } catch (error) {
                console.error('Error updating banner:', error);
                alert('Terjadi kesalahan saat memperbarui banner.');
            }
        }

        // Fungsi untuk mengupload gambar
        async function uploadImage(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = `${API_BASE_URL}/login`;
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch(`${API_BASE_URL}/api/upload-image`, {
                    method: 'POST',
                    headers: { Authorization: `Bearer ${token}` },
                    body: formData,
                });

                const data = await response.json();
                if (data.success) {
                    const preview = document.getElementById(previewId);
                    preview.src = data.data.image_url.replace('http://127.0.0.1:8001', '').trim();
                    preview.classList.remove('hidden');
                } else {
                    alert(data.message || 'Failed to upload image');
                }
            } catch (error) {
                console.error('Error uploading image:', error);
                alert('Terjadi kesalahan saat mengupload gambar.');
            }
        }

        document.addEventListener('DOMContentLoaded', fetchBannerKecil);
    </script> -->

<style>
    /* Tombol Success */
    .btn-success {
        background-color: #28a745; /* Hijau */
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-success:hover {
        background-color: #218838; /* Hijau lebih gelap */
        transform: translateY(-2px); /* Efek hover naik */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Tombol Danger */
    .btn-danger {
        background-color: #dc3545; /* Merah */
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-danger:hover {
        background-color: #c82333; /* Merah lebih gelap */
        transform: translateY(-2px); /* Efek hover naik */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Tombol Secondary */
    .btn-secondary {
        background-color: #6c757d; /* Abu-abu */
        color: white;
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: #5a6268; /* Abu-abu lebih gelap */
        transform: translateY(-2px); /* Efek hover naik */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Tambahan Gaya Umum */
    .hidden {
        display: none;
    }

    .btn {
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }
</style>

@endsection
