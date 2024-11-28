<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-4">Total Sales</h3>
    <select class="mb-4 p-2 border rounded">
        <option>Januari</option>
        <!-- Tambahkan bulan lainnya jika diperlukan -->
    </select>
    <div class="w-full h-48">
        <canvas id="totalSalesChart" class="w-full h-full"></canvas>
    </div>
</div>

<script src="http://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('totalSalesChart').getContext('2d');
    var totalSalesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan 5', 'Jan 7', 'Jan 9', 'Jan 11', 'Jan 13', 'Jan 15'], // Labels sumbu X
            datasets: [{
                label: 'Total Sales',
                data: [60, 90, 80, 120, 60, 90], // Data untuk sumbu Y
                borderColor: 'rgba(220,53,69, 1)', // Warna merah untuk garis
                backgroundColor: 'rgba(220,53,69, 0.1)', // Warna fill di bawah garis
                fill: true, // Aktifkan fill di bawah garis
                borderWidth: 1.5, // Ketebalan garis lebih tipis
                tension: 0.05, // Sedikit lengkungan, tapi tidak terlalu halus
                pointBackgroundColor: 'rgba(220,53,69, 1)', // Warna titik data
                pointRadius: 3, // Ukuran titik data lebih kecil
                pointHoverRadius: 5 // Ukuran titik saat di-hover
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 30 // Skala Y dengan jarak 30
                    }
                },
                x: {
                    grid: {
                        display: false // Sembunyikan grid di sumbu X
                    }
                }
            },
            plugins: {
                legend: {
                    display: false // Sembunyikan legend untuk tampilan yang lebih bersih
                }
            },
            maintainAspectRatio: false, // Buat chart lebih fleksibel dalam ukuran
            responsive: true // Chart bersifat responsif
        }
    });
</script>
