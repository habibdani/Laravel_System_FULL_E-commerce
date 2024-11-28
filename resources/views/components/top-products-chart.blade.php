<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Top Products</h3>
    <div class="w-full h-48">
        <canvas id="topProductsChart" class="w-full h-full"></canvas>
    </div>
</div>

<script src="http://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('topProductsChart').getContext('2d');
    var topProductsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Spandek', 'List H', 'List U', 'List Omega', 'Atap Spandek', 'Pipa L', 'Asbes 24'], // Labels produk
            datasets: [
                {
                    label: 'Current Sales',
                    data: [40, 80, 30, 60, 50, 70, 90], // Data penjualan saat ini
                    backgroundColor: 'rgba(220,53,69, 0.8)', // Warna merah
                    borderColor: 'rgba(220,53,69, 1)',
                    borderWidth: 1,
                    borderRadius: 5, // Buat rounded top pada batang
                    categoryPercentage: 0.6, // Lebar batang lebih ramping
                    barPercentage: 0.8 // Lebar bar dalam kategori
                },
                {
                    label: 'Previous Sales',
                    data: [70, 90, 60, 80, 60, 50, 80], // Data penjualan sebelumnya
                    backgroundColor: 'rgba(211, 211, 211, 0.8)', // Warna abu-abu
                    borderColor: 'rgba(211, 211, 211, 1)',
                    borderWidth: 1,
                    borderRadius: 5, // Buat rounded top pada batang
                    categoryPercentage: 0.6, // Lebar batang lebih ramping
                    barPercentage: 0.8 // Lebar bar dalam kategori
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20 // Langkah skala di sumbu Y
                    }
                },
                x: {
                    grid: {
                        display: false // Hilangkan grid di sumbu X
                    },
                    ticks: {
                        maxRotation: 0, // Hilangkan rotasi label
                        minRotation: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Sembunyikan legend
                }
            },
            maintainAspectRatio: false, // Membuat chart lebih fleksibel dalam ukuran
            responsive: true
        }
    });
</script>
