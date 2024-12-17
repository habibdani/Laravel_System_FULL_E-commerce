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
                <h1 class="mb-4 text-center text-primary font-bold">image procut special</h1>
                <table class="table w-full table-hover table-bordered shadow">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th>tittle</th>
                            <th>text</th>
                            <th>Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bannerBestProductTable">
                        <!-- Data akan diisi secara dinamis -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        let banners = []; // Data banners

        // Fungsi untuk mengambil data banner besar
        async function fetchBannerBestProduct() {
            try {
                const response = await fetch('/api/banner-best-product');
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

        // Fungsi untuk memvalidasi URL
        function isValidURL(url) {
            const pattern = new RegExp('^(http?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i'); // fragment locator
            return !!pattern.test(url);
        }

        // Fungsi untuk mengupload gambar
        async function uploadImage(event, previewId) {
            const file = event.target.files[0];
            if (!file) return;

            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = 'http://127.0.0.1:8001/login';
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const response = await fetch('http://127.0.0.1:8001/api/upload-image', {
                    method: 'POST',
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
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


        // Fungsi untuk merender tabel
        function renderTable(banners) {
            const tableBody = document.getElementById('bannerBestProductTable');
            tableBody.innerHTML = '';

            if (banners.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5" class="text-center">Tidak ada data banner.</td></tr>`;
                return;
            }

            banners.forEach((banner, index) => {
                const imagePath = banner.image.replace('http://127.0.0.1:8000', '').trim();
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="text-center">${index + 1}</td>
                    <td><input type="text" class="form-control" value="${banner.tittle}" id="editTitle-${banner.id}"></td>
                    <td><input type="text" class="form-control" value="${banner.text}" id="editText-${banner.id}"></td>
                    <td>
                        <input type="file" class="form-control" onchange="uploadImage(event, 'editImagePreview-${banner.id}')">
                        <img src="${imagePath}" id="editImagePreview-${banner.id}" class="h-32 w-32 object-cover rounded-lg mt-2">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success btn-sm" onclick="saveUpdatedBanner(${banner.id})">Save</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Fungsi untuk memperbarui banner
        async function saveUpdatedBanner(id) {
            const token = sessionStorage.getItem('authToken');
            if (!token) {
                alert('Token is missing, please log in again.');
                window.location.href = 'http://127.0.0.1:8001/login';
                return;
            }

            // Ambil nilai dari input dan preview image
            const tittleElement = document.getElementById(`editTitle-${id}`);
            const textElement = document.getElementById(`editText-${id}`);
            const imageUrl = document.getElementById(`editImagePreview-${id}`).src;

            const tittle = tittleElement && tittleElement.value.trim() ? tittleElement.value.trim() : null;
            const text = textElement && textElement.value.trim() ? textElement.value.trim() : null;

            // Debugging log untuk memverifikasi data
            console.log('Payload:', { tittle, text, image: imageUrl });

            try {
                // Request untuk memperbarui data banner
                const response = await fetch(`/api/banner-best-product/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                    body: JSON.stringify({
                        tittle, // Menggunakan variabel tittle yang benar
                        text,
                        image: imageUrl,
                    }),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Banner best product berhasil diperbarui.');
                    fetchBannerBestProduct(); // Refresh data banner
                } else {
                    alert(data.message || 'Gagal memperbarui banner.');
                }
            } catch (error) {
                console.error('Error updating banner:', error);
                alert('Terjadi kesalahan saat memperbarui banner.');
            }
        }

        document.addEventListener('DOMContentLoaded', fetchBannerBestProduct);
    </script>

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
