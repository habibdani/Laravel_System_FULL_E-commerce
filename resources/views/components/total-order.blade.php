<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-semibold mb-2">Total Order</h3>
    <div class="text-xl font-bold text-red-500">Rp. 23,2 jt</div>
    <div class="text-xs text-green-500">+13.4%</div>
    <div class="mt-4">
        <canvas id="totalOrderChart" style="max-height: 80px;"></canvas> <!-- Ubah tinggi chart -->
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('totalOrderChart').getContext('2d');
    var totalOrderChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['', '', '', '', '', ''], // Labels dibiarkan kosong untuk tampilan minimalis
            datasets: [{
                data: [0, 20, 60, 40, 80, 100], // Data untuk grafik garis
                borderColor: 'rgba(220,53,69, 1)', // Warna merah untuk garis
                backgroundColor: 'rgba(220,53,69, 0.1)', // Warna fill di bawah garis
                fill: true,
                borderWidth: 2,
                tension: 0.4, // Untuk membuat garis melengkung halus
                pointRadius: 0, // Hilangkan titik
                pointHitRadius: 10 // Area klik diperbesar untuk UX lebih baik
            }]
        },
        options: {
            scales: {
                y: {
                    display: false // Sembunyikan sumbu Y
                },
                x: {
                    display: false // Sembunyikan sumbu X
                }
            },
            plugins: {
                legend: {
                    display: false // Sembunyikan legend
                }
            },
            maintainAspectRatio: false, // Buat chart lebih fleksibel dalam ukuran
            responsive: true
        }
    });
</script>
