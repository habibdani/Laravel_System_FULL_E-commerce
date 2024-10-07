<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-2">Weekly Sales</h3>
    <div class="text-xl font-bold text-green-500">Rp. 500.000</div>
    <div class="text-xs text-green-500">+3.5%</div>
    <div class="mt-4">
        <canvas id="minimalSalesChart" style="max-height: 80px;"></canvas> <!-- Ubah tinggi chart -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('minimalSalesChart').getContext('2d');
    var minimalSalesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['', '', '', '', '', '', ''], // Labels dibiarkan kosong untuk tampilan minimalis
            datasets: [
                {
                    label: 'Current Sales',
                    data: [60, 70, 30, 80, 50, 60, 90], // Data penjualan saat ini
                    backgroundColor: 'rgba(220,53,69, 0.8)', // Warna merah
                    borderColor: 'rgba(220,53,69, 1)',
                    borderWidth: 1,
                    borderRadius: 5, // Buat bagian atas rounded
                    barPercentage: 0.7, // Lebar batang lebih ramping
                    categoryPercentage: 0.6 // Jarak antar batang
                },
                {
                    label: 'Remaining Capacity',
                    data: [40, 30, 70, 20, 50, 40, 10], // Sisa kapasitas
                    backgroundColor: 'rgba(211, 211, 211, 0.8)', // Warna abu-abu
                    borderColor: 'rgba(211, 211, 211, 1)',
                    borderWidth: 1,
                    borderRadius: 5, // Rounded juga di bagian atas
                    barPercentage: 0.7, // Lebar batang abu-abu lebih ramping
                    categoryPercentage: 0.6 // Jarak antar batang
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    display: false, // Sembunyikan label angka di sumbu Y
                    grid: {
                        color: '#ffffff', // Ubah warna grid menjadi putih
                        drawBorder: false // Hilangkan garis tepi sumbu Y
                    },
                    ticks: {
                        display: false // Hilangkan angka di sumbu Y
                    }
                },
                x: {
                    display: false, // Sembunyikan label di sumbu X
                    stacked: true, // Tumpuk dataset merah dan abu-abu
                    grid: {
                        color: '#ffffff', // Ubah warna grid menjadi putih
                        drawBorder: false // Hilangkan garis tepi sumbu X
                    },
                    ticks: {
                        display: false // Hilangkan garis kecil di sumbu X
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Sembunyikan legend untuk tampilan yang lebih bersih
                }
            },
            maintainAspectRatio: false, // Buat chart lebih fleksibel dalam ukuran
            responsive: true,
            scales: {
                x: {
                    stacked: true // Menumpuk batang di sumbu X
                },
                y: {
                    stacked: true, // Menumpuk batang di sumbu Y
                    grid: {
                        display: true, // Pastikan grid ditampilkan
                        color: '#ffffff', // Ubah warna garis grid menjadi putih
                        drawBorder: false // Hilangkan garis tepi pada sumbu Y
                    },
                    ticks: {
                        display: false // Hilangkan angka dan garis kecil
                    }
                }
            }
        }
    });
</script>

